<?php

namespace app\components\services\History\objects;

use app\components\services\History\HistoryObjectDecorator;
use app\models\Sms;
use Yii;

/**
 * @property Sms $record
 */

class SmsHistoryObject extends HistoryObjectDecorator
{
    public function getBody(): string
    {
        return $this->record->message ?? '';
    }
    
    public function getWidgetRender(): array
    {
        $model = $this->history;
        $sms = $this->record;
        return [
            '_item_common', [
                'user' => $model->user,
                'body' => $this->getBody(),
                'footer' => $sms->direction == Sms::DIRECTION_INCOMING ?
                    Yii::t('app', 'Incoming message from {number}', [
                        'number' => $sms->phone_from ?? ''
                    ]) : Yii::t('app', 'Sent message to {number}', [
                        'number' => $sms->phone_to ?? ''
                    ]),
                'iconIncome' => $sms->direction == Sms::DIRECTION_INCOMING,
                'footerDatetime' => $model->ins_ts,
                'iconClass' => 'icon-sms bg-dark-blue'
            ],
        ];
    }
}