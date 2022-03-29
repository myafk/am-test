<?php
use app\models\search\HistorySearch;

/**
 * @var HistorySearch $model
 * @var \yii\web\View $this
 */

if ($model->relatedObject) {
    $renderOptions = $model->relatedObject->getWidgetRender();
    echo $this->render($renderOptions[0], $renderOptions[1]);
}