<?php

namespace app\components\services\History\objects;

use app\components\services\History\HistoryObjectDecorator;
use app\models\Task;

/**
 * @property Task $record
 */
class TaskHistoryObject extends HistoryObjectDecorator
{
    public function getBody(): string
    {
        return "{$this->history->eventText}: " . ($this->record->title ?? '');
    }
    
    public function getWidgetRender(): array
    {
        $model = $this->history;
        $task = $this->record;
        return [
            '_item_common', [
                'user'           => $model->user,
                'body'           => $this->getBody(),
                'iconClass'      => 'fa-check-square bg-yellow',
                'footerDatetime' => $model->ins_ts,
                'footer'         => isset($task->customer->name) ? "Creditor: " . $task->customer->name : '',
            ],
        ];
    }
}