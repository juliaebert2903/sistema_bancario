<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Exceptions extends BaseConfig
{
    public $log = true;

    public $ignoreCodes = [404];

    public $errorViewPath = APPPATH . 'Views/errors';

    public $sensitiveDataInTrace = [];
}
