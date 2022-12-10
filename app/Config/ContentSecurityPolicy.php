<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;


class ContentSecurityPolicy extends BaseConfig
{
    public $reportOnly = false;

    public $reportURI;

    public $upgradeInsecureRequests = false;

    public $defaultSrc;

    public $scriptSrc = 'self';

    public $styleSrc = 'self';

    public $imageSrc = 'self';

    public $baseURI;

    public $childSrc = 'self';

    public $connectSrc = 'self';

    public $fontSrc;

    public $formAction = 'self';

    public $frameAncestors;

    public $frameSrc;

    public $mediaSrc;

    public $objectSrc = 'self';

    public $manifestSrc;

    public $pluginTypes;

    public $sandbox;

    public $styleNonceTag = '{csp-style-nonce}';

    public $scriptNonceTag = '{csp-script-nonce}';

    public $autoNonce = true;
}
