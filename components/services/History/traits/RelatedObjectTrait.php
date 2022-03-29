<?php

namespace app\components\services\History\traits;

use app\components\services\History\HistoryObjectStaticFactory;
use app\components\services\history\interfaces\ObjectInterface;
use app\models\Call;
use app\models\Customer;
use app\models\Fax;
use app\models\Sms;
use app\models\Task;

/**
 * @property ObjectInterface $relatedObject
 */
trait RelatedObjectTrait
{
    public static $classes = [
        'sms' => Sms::class,
        'task' => Task::class,
        'call' => Call::class,
        'fax' => Fax::class,
        'lead' => Customer::class,
    ];
    
    protected $_relatedObject = null;

    /**
     * @param $name
     * @param bool $throwException
     *
     * @return \yii\db\ActiveQuery|\yii\db\ActiveQueryInterface|null
     */
    public function getRelation($name, $throwException = true)
    {
        $getter = 'get' . $name;
        $class = self::$classes[$name] ?? null;

        if (!method_exists($this, $getter) && $class) {
            return $this->hasOne($class, ['id' => 'object_id']);
        }

        return parent::getRelation($name, $throwException);
    }
    
    public function populateRelation($name, $records)
    {
        if (isset(HistoryObjectStaticFactory::$map[$name]) && $records) {
            $records = HistoryObjectStaticFactory::factory($name, $this, $records);
        }
        
        parent::populateRelation($name, $records);
    }
    
    public function getRelatedObject()
    {
        if ($this->_relatedObject === null && isset(self::$classes[$this->object])) {
            $this->_relatedObject = $this->{$this->object};
        }
        
        return $this->_relatedObject;
    }
    
    
}