<?php

namespace app\components\services\History\Export;

use yii\base\BaseObject;
use yii\queue\JobInterface;

class HistoryExportJob extends BaseObject implements JobInterface
{
    public $fileName;
    public $queryParams;
    
    public function execute($queue) {
        HistoryExport::saveFile($this->fileName, $this->queryParams);
    }
}