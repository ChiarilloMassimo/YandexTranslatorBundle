YandexTranslatorBundle
===================

Use Yandex translator service in your Symfony Project

#WIP

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