<?php

/*
 * BitFeed 2015
 * @Author Chiarillo Massimo
 */

namespace Yandex\TranslatorBundle\Tests\Service;

use Yandex\TranslatorBundle\Model\Key;
use Yandex\TranslatorBundle\Service\Client;
use Yandex\TranslatorBundle\Service\Translator;
use Guzzle\Http\Exception\RequestException;

class TranslatorTest extends \PHPUnit_Framework_TestCase
{
    public function testTransaltorOk()
    {
        $translator = new Translator(
            $this->getClientMock(true)
        );

        $key = (new Key())
            ->setValue('myYandexKey');

        $response = $this->createRequest($translator, $key);

        $this->assertEquals('Ciao Max', $response->getText());
        $this->assertEquals(200, $response->getCode());
        $this->assertEquals('en', $response->getFrom());
        $this->assertEquals('it', $response->getTo());
    }

    public function testTranslatorKo()
    {
        $translator = new Translator(
            $this->getClientMock(false)
        );

        $key = (new Key())
            ->setValue('myYandexKey');

        $response = $this->createRequest($translator, $key);

        //Yandex return invalid response
        $this->assertFalse($response);
    }

    private function createRequest(Translator $translator, Key $key)
    {
        return $translator->createRequest()
            ->setKey($key->getValue())
            ->setText('Hello Max')
            ->setFrom('en')
            ->setTo('it')
            ->send();
    }

    private function getClientMock($sendValidRequest = true)
    {
        $clientMock = $this->getMockBuilder('Yandex\TranslatorBundle\Service\Client')
            ->disableOriginalConstructor()
            ->setMethods(['get'])
            ->getMock();

        $clientMock->expects($this->any())
            ->method('get')
            ->willReturn(
                $this->getRequestMock($sendValidRequest)
            );

        return $clientMock;
    }

    private function getRequestMock($isValidRequest = true)
    {
        $requestMock = $this->getMockBuilder('Guzzle\Http\Message\Request')
            ->setMethods(['send'])
            ->disableOriginalConstructor()
            ->getMock();

        $sendMethodMock = $requestMock->expects(
            $this->once()
        )->method('send');

        if ($isValidRequest) {
            $sendMethodMock->willReturn(
                $this->getResponseMock()
            );

            return $requestMock;
        }

        $sendMethodMock->will(
            $this->throwException(
                new RequestException()
            )
        );

        return $requestMock;
    }

    protected function getResponseMock()
    {
        $responseMock = $this->getMockBuilder('Guzzle\Http\Message\Response')
            ->setMethods(['getBody'])
            ->getMock();

        $responseMock->expects($this->any())
            ->method('getBody')
            ->willReturn(json_encode([
                'code' => 200,
                'lang' => 'en-it',
                'text' => [
                    'Ciao Max'
                ]
            ]));

        return $responseMock;
    }
}