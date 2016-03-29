AudioManager
============

A manager for a popular text-to-speech cloud services ([Google](https://translate.google.com/), [Ivona](https://www.ivona.com/), ...) on PHP. This project uses [PSR-4](http://www.php-fig.org/psr/psr-4/) autoloading standard,
[PSR-2](http://www.php-fig.org/psr/psr-2/) coding style

[![Build status](https://travis-ci.org/newage/AudioManager.svg?branch=master)](https://travis-ci.org/newage/AudioManager)
[![Code Coverage](https://scrutinizer-ci.com/g/newage/AudioManager/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/newage/AudioManager/?branch=develop)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/newage/AudioManager/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/newage/AudioManager/)

## Call manager

    $adapter = new Google();
    $adapter->setOptions([
        'language' => 'en',
        'encoding' => 'UTF-8'
    ]);

or

    $adapter = new Google();
    $adapter->setLanguage('en');
    $adapter->setEncoding('UTF-8');

Set adapter to manager

    $manager = new Manager($adapter);
    $audioContent = $manager->read('text');
    $manager->getHeaders();

