<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Encryption extends BaseConfig
{

    public $key = 'test-do-teste';

    public $driver = 'OpenSSL';

    public $blockSize = 16;

    public $digest = 'SHA512';
}
