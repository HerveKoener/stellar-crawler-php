# stellar-crawler

This is a simple read-only PHP API for the stellar network.

## Dependencies

This library has no dependencies.

## Installing

### Install Option 1: Phar

**IDEAL FOR: Quick hacking or small projects**
StellarCrawler provides a [PHP Archive file](https://github.com/HerveKoener/stellar-crawler-php/blob/master/stellarCrawler.phar) that includes the entire library. Simply [download this file](https://github.com/HerveKoener/stellar-crawler-php/blob/master/stellarCrawler.phar) and *include* it in your code.

```php
<?php

// Point to where you downloaded the phar
include('./StellarCrawler.phar');
 
// And you're ready to go!
$publicKey = 'GXXXXXXX123456789XXX';
$isPublicNetwork = true;
$crawler = StellarCrawler::newInstance($publicKey, $isPublicNetwork);
...
```

### Install Option 2: Composer

**IDEAL FOR: Projects that already support Composer, the sane alternative to PEAR.**

[Composer](https://getcomposer.org/) is starting to emerge as the true people's package manager for PHP. If you aren't already using it, you should give it a shot. Simply add *quasark/StellarCrawler* to *require* in your *composer.json* file like below. After doing so, you're all set to start using Httpful! The autoloader provided by composer takes care of the rest!

```javascript
{
    "require": {
        "quasark/StellarCrawler": "*"
    }
}
```

## Basic Usage

### Instanciation

First of all you need to instanciate your **crawler** by using the *newInstance* factory method:

```php
$publicKey = 'GXXXXXXX123456789XXX';
$isPublicNetwork = true;
$crawler = StellarCrawler::newInstance($publicKey, $isPublicNetwork);
```

### Navigation

Then you can navigate through the Stellar network by using the *follow()* method provided by the StellarLink object:

```php
$crawler->getlinks()['next']->follow();
var_dump($crawler->getData());
$crawler->followPrev();
```

There are also helper methods that can be used to navigate easily:

```php
//Follow the next link
$crawler->followNext();

//Follow the prev link
$crawler->followPrev();

//Go back to the previous page
$crawler->followBack();
```

### Check data

When you have navigated to your favourite page, you can retrieve the data by using the **getData()** method:

```php
var_dump($crawler->getData());
```

## Advanced Usage

### Instanciation with custom horizon server

The API provide another way to instanciate the StellarCrawler. The public factory method **newInstanceWithServer** allows to instanciate the crawler with custom horizon server:

```php
$publicKey = 'GXXXXXXX123456789XXX';
$horizonServer = 'https://horizon-testnet.stellar.org';
$crawler = StellarCrawler::newInstanceWithServer($publicKey, $horizonServer);
```

### Historisation

StellarCrawler API provide a historisation mechanism in order to keep track of your journey in the Stellar network. The simplest way to use the historisation mechanism is to call the **followBack()** method. But you can retrieve the full history by calling **getHistory()**:

```php
var_dump($crawler->getHistory());
```

This method returns an array of StellarLink representing the navigation history.

## Properties description

**StellarCrawler->getlinks()** contains an array of array with:

 * **The key** : name of the link (example: Transactions)
 * **The link** : the link object used during the navigation

**StellarCrawler->getData()** contains the json representation of the data sent by the Stellar network.

```php
var_dump($crawler->getData());
```

**StellarCrawler->getHistory()** contains an array of StellarLink representing the navigation history.

**StellarCrawler->followNext()** follows the 'next' link if available. If the current page doesn't contain a 'next' link, a StellarCrawlerException is thrown. *This method is the same as using StellarCrawler->getlinks()['next']->follow();*

**StellarCrawler->followPrev()** follows the 'prev' link if available. If the current page doesn't contain a 'prev' link, a StellarCrawlerException is thrown. *This method is the same as using StellarCrawler->getlinks()['prev']->follow();*

**StellarCrawler->followBack()** follows the 'back' link if available. If the current page doesn't contain a 'back' link, a StellarCrawlerException is thrown. *This method is the same as using StellarCrawler->getlinks()['back']->follow();*

**See the example for more information.**

## Donation

XLM donations are welcome! : GC6ZIWMTBZZ54VWX6SJH4JEHRHWSE245O2EIW26CMGAS6PM2R4J6V4PH

## License

MIT