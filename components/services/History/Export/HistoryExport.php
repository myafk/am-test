<?php

namespace app\components\services\History\Export;

use app\models\search\HistorySearch;
use yii\data\Pagination;
use Yii;
use yii\queue\Queue;

class HistoryExport
{
    const FOLDER = '@app/web/export';
    
    public static function addJob(): string
    {
        $queue = Yii::$app->queue;
        /* @var Queue $queue */
        
        $postfix = microtime(true);
        $fileName = 'history_' . $postfix . '.csv';
        
        $queue->push(
            new HistoryExportJob([
                'queryParams' => Yii::$app->request->queryParams,
                'fileName'    => $fileName,
            ])
        );
        
        return $fileName;
    }
    
    public static function saveFile($fileName, array $params = [])
    {
        $data = self::getData($params);
        
        $csv = fopen(Yii::getAlias(self::FOLDER) . DIRECTORY_SEPARATOR . $fileName, 'w');
        fputcsv($csv, ['ins_ts', 'user', 'type', 'event', 'message'], ';');
        
        foreach ($data as $model) {
            /* @var \app\models\History $model */
            fputcsv($csv, [
                $model->ins_ts,
                isset($model->user) ? $model->user->username : Yii::t('app', 'System'),
                $model->object,
                $model->eventText,
                $model->relatedObject ? strip_tags($model->relatedObject->getBody()) : '',
            ], ';');
        }
    }
    
    protected static function getData(array $params = []): array
    {
        $dataProvider = (new HistorySearch())->search($params);
        
        $dataProvider->setPagination(
            new Pagination([
                'pageSize' => 0,
            ])
        );
        
        return $dataProvider->getModels();
    }
    
}