<?php

return array_merge_recursive([
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
], require(__DIR__ . '/params-local.php'));
