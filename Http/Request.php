<?php

/**
 * @Author Chiarillo Massimo
 */

namespace Yandex\TranslatorBundle\Http;

use Guzzle\Http\ClientInterface;
use Yandex\TranslatorBundle\Service\Client;

class Request
{
    const REQUEST_URI = 'https://translate.yandex.net/api/v1.5/tr.json/translate';

    protected $client;

    protected $key;

    protected $from;

    protected $to;

    protected $text;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param  mixed $key
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param  mixed $from
     * @return $this
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param  mixed $to
     * @return $this
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param  mixed $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    public function send()
    {
        try {
            $body = $this->client
                ->get(
                    self::REQUEST_URI,
                    [],
                    [
                        'query' => [
                            'key'  => $this->getKey(),
                            'lang' => sprintf('%s-%s', $this->getFrom(), $this->getTo()),
                            'text' => $this->getText()
                        ]
                    ]
                )
                ->send()
                ->getBody(true);
        } catch (\Exception $e) {
            return false;
        }

        return new Response($body);
    }
}