<?php

/*
 * BitFeed 2015
 * @Author Chiarillo Massimo
 */

namespace Yandex\TranslatorBundle\Tests\Service;

use Yandex\TranslatorBundle\Service\Client;
use Yandex\TranslatorBundle\Model\Key;
use Yandex\TranslatorBundle\Service\Translator;

class TranslatorTest extends \PHPUnit_Framework_TestCase
{
    public function testTrans()
    {
        $client = new Client();

        $translator = new Translator($client);

        $key = new Key();
        //@Todo Moking Response
        $key->setValue('YourKey')
            ->setEnabled(true);

        $response = $translator->createRequest()
            ->setKey($key->getValue())
            ->setText('Hello Max')
            ->setFrom('en')
            ->setTo('it')
            ->send();

        //@ToDo Mocking Response
        $this->assertEquals('Ciao Max', $response->getText());
        $this->assertEquals(200, $response->getCode());
        $this->assertEquals('en', $response->getFrom());
        $this->assertEquals('it', $response->getTo());
    }
}