<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Migrations extends BaseConfig
{
    public $enabled = true;

    public $table = 'migrations';

    public $timestampFormat = 'Y-m-d-His_';
}
