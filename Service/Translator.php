<?php

/**
 * @Author Chiarillo Massimo
 */

namespace Yandex\TranslatorBundle\Service;

use Yandex\TranslatorBundle\Document\Key;
use Yandex\TranslatorBundle\Http\Request;

class Translator
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var Key
     */
    protected $key;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function createRequest()
    {
        return new Request($this->client);
    }
}
