<?php

namespace app\components\services\History\widgets\HistoryList;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class HistoryListAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets';
    
    public $publishOptions = [
        'forceCopy' => YII_ENV === 'dev',
    ];
    
    public $js = [
        'js/export.js',
    ];
    
    public $depends = [
        JqueryAsset::class
    ];
    
}