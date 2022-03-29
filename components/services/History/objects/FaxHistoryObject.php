<?php

namespace app\components\services\History\objects;

use app\components\services\History\HistoryObjectDecorator;
use app\models\Fax;
use Yii;
use yii\helpers\Html;

/**
 * @property Fax $record
 */
class FaxHistoryObject extends HistoryObjectDecorator
{
    public function getBody(): string
    {
        return $this->history->eventText;
    }
    
    public function getWidgetRender(): array
    {
        $model = $this->history;
        $fax = $this->record;
        return [
            '_item_common', [
                'user' => $model->user,
                'body' => $this->getBody(),
                'footer' => Yii::t('app', '{type} was sent to {group}', [
                    'type' => $fax ? $fax->getTypeText() : 'Fax',
                    'group' => isset($fax->user) ? Html::a($fax->user->email, ['creditors/groups'], ['data-pjax' => 0]) : ''
                ]),
                'footerDatetime' => $model->ins_ts,
                'iconClass' => 'fa-fax bg-green'
            ]
        ];
    }
}