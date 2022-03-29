<?php

use app\models\search\HistorySearch;

/**
 * @var HistorySearch $model
 */

echo $this->render('../_item_common', [
    'user'           => $model->user,
    'body'           => $model->relatedObject->getBody(),
    'iconClass'      => 'fa-check-square bg-yellow',
    'footerDatetime' => $model->ins_ts,
    'footer'         => isset($model->relatedObject->customer->name) ? "Creditor: " . $model->relatedObject->customer->name : '',
]);