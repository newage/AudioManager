AudioManager
============

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

A manager for a popular text-to-speech cloud services ([Google](https://translate.google.com/), [Ivona](https://www.ivona.com/), ...) on PHP. This project uses [PSR-4](http://www.php-fig.org/psr/psr-4/) autoloading standard,
[PSR-2](http://www.php-fig.org/psr/psr-2/) coding style

## Install

Via Composer

``` bash
$ composer require newage/audio-manager
```

## Usage

Setup an `Google` adapter

    $adapter = new \AudioManager\Adapter\Google();
    $adapter->getOptions()->setLanguage('en');
    $adapter->getOptions()->setEncoding('UTF-8');

Setup an `Ivona` adapter

    $adapter = new \AudioManager\Adapter\Ivona();
    $adapter->getOptions()->setAccessKey('...');
    $adapter->getOptions()->setSecretKey('...');

Setup an adapter to manager

    $manager = new \AudioManager\Manager($adapter);
    $audioContent = $manager->read('text');
    $manager->getHeaders();

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email vadim.leontiev@gmail.com instead of using the issue tracker.

## Credits

- [Vadim Leontiev][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/newage/audio-manager.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/newage/AudioManager/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/newage/AudioManager.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/newage/AudioManager.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/newage/audio-manager.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/newage/audio-manager
[link-travis]: https://travis-ci.org/newage/AudioManager
[link-scrutinizer]: https://scrutinizer-ci.com/g/newage/AudioManager/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/newage/AudioManager
[link-downloads]: https://packagist.org/packages/newage/audio-manager
[link-author]: https://github.com/newage
[link-contributors]: ../../contributors
