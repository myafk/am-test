<?php

namespace app\components\services\History\objects;

use app\components\services\History\HistoryObjectDecorator;
use app\models\Customer;
use app\models\History;

/**
 * @property Customer $record
 */
class CustomerHistoryObject extends HistoryObjectDecorator
{
    public function getBody(): string
    {
        $model = $this->history;
        switch ($model->event) {
            case History::EVENT_CUSTOMER_CHANGE_TYPE:
                return "$model->eventText " .
                    (Customer::getTypeTextByType($model->getDetailOldValue('type')) ?? "not set") . ' to ' .
                    (Customer::getTypeTextByType($model->getDetailNewValue('type')) ?? "not set");
            case History::EVENT_CUSTOMER_CHANGE_QUALITY:
                return "$model->eventText " .
                    (Customer::getQualityTextByQuality($model->getDetailOldValue('quality')) ?? "not set") . ' to ' .
                    (Customer::getQualityTextByQuality($model->getDetailNewValue('quality')) ?? "not set");
        }
    }
    
    public function getWidgetRender(): array
    {
        $model = $this->history;
        switch ($model->event) {
            case History::EVENT_CUSTOMER_CHANGE_TYPE:
                return [
                    '_item_statuses_change', [
                        'model'    => $model,
                        'oldValue' => Customer::getTypeTextByType($model->getDetailOldValue('type')),
                        'newValue' => Customer::getTypeTextByType($model->getDetailNewValue('type'))
                    ],
                ];
            case History::EVENT_CUSTOMER_CHANGE_QUALITY:
                return [
                    '_item_statuses_change', [
                        'model' => $model,
                        'oldValue' => Customer::getQualityTextByQuality($model->getDetailOldValue('quality')),
                        'newValue' => Customer::getQualityTextByQuality($model->getDetailNewValue('quality')),
                    ]
                ];
        }
    }
}