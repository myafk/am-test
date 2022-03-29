<?php

namespace app\components\services\history\interfaces;

use app\models\History;

/**
 * @property History $history
 */
interface ObjectInterface
{
    public function getBody(): string;
    
    public function getWidgetRender(): array;
}