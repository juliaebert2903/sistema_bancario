<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use DateTimeInterface;

class Cookie extends BaseConfig
{
    public $prefix = '';

    public $expires = 0;

    public $path = '/';

    public $domain = '';

    public $secure = false;

    public $httponly = true;

    public $samesite = 'Lax';

    public $raw = false;
}
