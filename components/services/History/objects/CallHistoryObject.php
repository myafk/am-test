<?php

namespace app\components\services\History\objects;

use app\components\services\History\HistoryObjectDecorator;
use app\models\Call;

/**
 * @property Call $record
 */
class CallHistoryObject extends HistoryObjectDecorator
{
    public function getBody(): string
    {
        $call = $this->record;
        return ($call ? $call->totalStatusText . ($call->getTotalDisposition(false) ? " <span class='text-grey'>" . $call->getTotalDisposition(false) . "</span>" : "") : '<i>Deleted</i> ');
    }
    
    public function getWidgetRender(): array
    {
        $model = $this->history;
        $call = $this->record;
        $answered = $call->status == Call::STATUS_ANSWERED;
        return [
            '_item_common', [
                'user' => $this->record->user,
                'content' => $call->comment ?? '',
                'body' => $this->getBody(),
                'footerDatetime' => $model->ins_ts,
                'footer' => isset($call->applicant) ? "Called <span>{$call->applicant->name}</span>" : null,
                'iconClass' => $answered ? 'md-phone bg-green' : 'md-phone-missed bg-red',
                'iconIncome' => $answered && $call->direction == Call::DIRECTION_INCOMING
            ],
        ];
    }
}