# stellar-crawler

This is a simple read-only PHP API for the stellar network.

## Dependencies

This library has no dependencies.

## Usage


```php
$publicKey = 'GXXXXXXX123456789XXX';
$isPublicNetwork = true;
$crawler = new StellarCrawler($publicKey, $isPublicNetwork);
```

Then $crawler->links can be used to navigate through the Stellar network:

```php
$crawler->getlinks()['next']->follow();
```

## Properties description

StellarCrawler->getlinks() contains an array of array with:

 * The key : name of the link (example: Transactions)
 * The link : the link object used during the navigation

StellarCrawler->getData() contains the json representation of the data sent by the Stellar network.

```php
var_dump($crawler->getData());
```

See the example for more information.

## Donation

XLM donations are welcome! : GC6ZIWMTBZZ54VWX6SJH4JEHRHWSE245O2EIW26CMGAS6PM2R4J6V4PH

## License

MIT