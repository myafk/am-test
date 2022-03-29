<?php

namespace app\components\services\History;

use app\components\services\history\interfaces\ObjectInterface;
use app\components\services\History\objects\CallHistoryObject;
use app\components\services\History\objects\CustomerHistoryObject;
use app\components\services\History\objects\FaxHistoryObject;
use app\components\services\History\objects\SmsHistoryObject;
use app\components\services\History\objects\TaskHistoryObject;
use app\models\History;
use InvalidArgumentException;
use yii\db\ActiveRecordInterface;

final class HistoryObjectStaticFactory
{
    public static $map = [
        'lead' => CustomerHistoryObject::class,
        'sms'  => SmsHistoryObject::class,
        'task' => TaskHistoryObject::class,
        'call' => CallHistoryObject::class,
        'fax'  => FaxHistoryObject::class,
    ];
    
    public static function factory(string $object, History $history, ActiveRecordInterface $record): ObjectInterface
    {
        if (isset(self::$map[$object])) {
            return new self::$map[$object]($history, $record);
        }
        
        throw new InvalidArgumentException('Unknown object given');
    }
}