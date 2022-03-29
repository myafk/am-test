<?php

use app\models\search\HistorySearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider ActiveDataProvider */
/* @var $model HistorySearch */
/* @var $linkExport string */

?>

<?php
Pjax::begin(['id' => 'grid-pjax', 'formSelector' => false]); ?>

<div class="panel panel-primary panel-small m-b-0">
    <div class="panel-body panel-body-selected">

        <div class="pull-sm-right export-wrapper">
            <?php
            if (!empty($linkExport)) {
                echo Html::a(Yii::t('app', 'CSV'), $linkExport,
                    [
                        'class'     => 'btn btn-success export',
                        'data-pjax' => 0,
                    ]
                );
            } ?>
            <div class="loading" style="display: none">Wait file...</div>
            <div class="download-file" data-link="<?= \yii\helpers\Url::toRoute('check-export'); ?>" style="display: none">
                <?= Html::a(Yii::t('app', 'Download file'), '', [
                    'class' => 'btn btn-primary',
                    'target' => '_blank',
                    'data-pjax' => 0
                ]); ?>
            </div>
        </div>

    </div>
</div>

<?php
echo ListView::widget([
    'dataProvider'     => $dataProvider,
    'itemView'         => '_item',
    'options'          => [
        'tag'   => 'ul',
        'class' => 'list-group',
    ],
    'itemOptions'      => [
        'tag'   => 'li',
        'class' => 'list-group-item',
    ],
    'emptyTextOptions' => ['class' => 'empty p-20'],
    'layout'           => '{items}{pager}',
]); ?>

<?php
Pjax::end(); ?>
