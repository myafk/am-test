<?php

namespace app\components\services\History;

use app\components\services\history\interfaces\ObjectInterface;
use app\models\History;
use yii\base\BaseObject;
use yii\db\ActiveRecordInterface;

/**
 * @property ActiveRecordInterface $record
 */
abstract class HistoryObjectDecorator extends BaseObject implements ObjectInterface
{
    /**
     * @var History
     */
    protected $history;
    /**
     * @var ActiveRecordInterface
     */
    protected $_record;

    public function __construct(History $history, ActiveRecordInterface $record, $config = [])
    {
        $this->history = $history;
        $this->_record = $record;
        
        parent::__construct($config);
    }
    
    public function getRecord(): ActiveRecordInterface
    {
        return $this->_record;
    }
}