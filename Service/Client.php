<?php

/**
 * @Author Chiarillo Massimo
 */

namespace Yandex\TranslatorBundle\Service;

use Guzzle\Http\Client as HttpClient;

class Client extends HttpClient
{
    const USER_AGENT = 'Yandex/Translator';

    public function __construct()
    {
        parent::__construct();

        $this->setUserAgent(
            self::USER_AGENT
        );
    }
}
