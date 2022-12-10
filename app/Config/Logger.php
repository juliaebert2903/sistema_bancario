<?php

namespace Config;

use CodeIgniter\Log\Handlers\FileHandler;
use CodeIgniter\Config\BaseConfig;

class Logger extends BaseConfig
{
    public $threshold = 4;

    public $dateFormat = 'Y-m-d H:i:s';

    public $handlers = [

        FileHandler::class => [

            'handles' => [
                'critical',
                'alert',
                'emergency',
                'debug',
                'error',
                'info',
                'notice',
                'warning',
            ],

            'fileExtension' => '',

            'filePermissions' => 0644,

            'path' => '',
        ],
    ];
}
