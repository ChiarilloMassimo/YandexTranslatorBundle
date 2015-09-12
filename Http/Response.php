<?php

/**
 * @Author Chiarillo Massimo
 */

namespace Yandex\TranslatorBundle\Http;

class Response
{
    private $decodedBody;

    /**
     * @param String $body
     */
    public function __construct($body)
    {
        $this->decodedBody = json_decode($body, true);
    }

    public function getText()
    {
        $text = $this->getDecodedBodyValue('text');

        if (!is_array($text)) {
            return null;
        }

        return reset($text);
    }

    protected function getLang()
    {
        $lang = $this->getDecodedBodyValue('lang');

        if (!$lang) {
            return false;
        }

        return explode('-', $lang);
    }

    public function getFrom()
    {
        if (!$lang = $this->getLang()) {
            return null;
        }

        return reset($lang);
    }

    public function getTo()
    {
        if (!$lang = $this->getLang()) {
            return null;
        }

        return end($lang);
    }

    public function getCode()
    {
        return $this->getDecodedBodyValue('code');
    }

    private function getDecodedBodyValue($key)
    {
        if (!array_key_exists($key, $this->decodedBody)) {
            return null;
        }

        return $this->decodedBody[$key];
    }
}
