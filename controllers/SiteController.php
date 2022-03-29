<?php

namespace app\controllers;

use app\components\services\History\Export\HistoryExport;
use app\models\search\HistorySearch;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'export' => ['POST'],
                ],
            ],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionExport(): \yii\web\Response
    {
        $fileName = HistoryExport::addJob();
        return $this->asJson([
            'fileName' => $fileName,
            'url' => str_replace('@app/web', Url::base(), HistoryExport::FOLDER) . '/' . $fileName,
        ]);
    }
    
    public function actionCheckExport(): \yii\web\Response
    {
        $fileName = Yii::$app->request->getQueryParam('fileName');
        if ($fileName && file_exists(Yii::getAlias(HistoryExport::FOLDER) . DIRECTORY_SEPARATOR . $fileName)) {
            return $this->asJson(true);
        }
        
        return $this->asJson(false);
    }
}
