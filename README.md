YandexTranslatorBundle
===================

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/7659f6e8-68b3-4712-8b7e-5d05c1a7410f/mini.png)](https://insight.sensiolabs.com/projects/7659f6e8-68b3-4712-8b7e-5d05c1a7410f)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ChiarilloMassimo/YandexTranslatorBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ChiarilloMassimo/YandexTranslatorBundle/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/ChiarilloMassimo/YandexTranslatorBundle/badges/build.png?b=master)](https://scrutinizer-ci.com/g/ChiarilloMassimo/YandexTranslatorBundle/build-status/master)

Use Yandex translator service in your Symfony Project

Installation
------------

Install the bundle:

    composer require chiarillomax/yandex-translator-bundle "dev-master"

Register the bundle in `app/AppKernel.php`:

``` php
<?php
// app/AppKernel.php
public function registerBundles()
{
    return array(
        // ...
        new \Yandex\TranslatorBundle\YandexTranslatorBundle()
    );
}
```

Usage
-----

``` php
//use Yandex\TranslatorBundle\Model\Key
$key = new Key();
$key->setValue('YourKey');

$request = $this->get('yandex.translator')->createRequest()
     ->setKey($key->getValue())
     ->setText('Hello Max')
     ->setFrom('en')
     ->setTo('it')
     ->send();

$text = $request->getText(); //Ciao Max
```

Test
-----

    phpunit
