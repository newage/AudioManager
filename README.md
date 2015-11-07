AudioManager
============

A manager for a popular text-to-speech cloud services ([Google](https://translate.google.com/), [Ivona](https://www.ivona.com/), ...) on PHP. This project uses [RSR-0](http://www.php-fig.org/psr/psr-0/) autoloading standard,
[PSR-2](http://www.php-fig.org/psr/psr-2/) coding style

[![Build status](https://travis-ci.org/newage/AudioManager.svg?branch=master)](https://travis-ci.org/newage/AudioManager)
[![Code Coverage](https://scrutinizer-ci.com/g/newage/AudioManager/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/newage/AudioManager/?branch=develop)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/newage/AudioManager/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/newage/AudioManager/)

Manager
$manager = new Manager(new Google());
$manager->getAdapter()->getOptions()->setOptions([]);
$manager->read();
$manager->getHeaders();

