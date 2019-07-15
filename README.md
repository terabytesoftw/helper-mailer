<p align="center">
    <a href="https://github.com/terabytesoftw/helper-mailer" target="_blank">
        <img src="https://lh3.googleusercontent.com/D9TFw1F6ddPuheDc_tpNptTdvTg-FNNpjLSBN14X6Sc-3JDiOxfE67rEh4OZfygonx1tKei2b2DEOHDLjF6T3xl8e-rkEEPZeGqLTWcS_v2cBRlyo0vcZLDHG5ivSDGIWCsenbol=w2400" height="50px;">
    </a>
    <h1 align="center">Helper Mailer.</h1>
</p>

<p align="center">
    <a href="https://packagist.org/packages/terabytesoftw/helper-mailer" target="_blank">
        <img src="https://poser.pugx.org/terabytesoftw/helper-mailer/v/unstable.svg" alt="Unstable Version">
    </a>
    <a href="https://travis-ci.org/terabytesoftw/helper-mailer" target="_blank">
        <img src="https://travis-ci.org/terabytesoftw/helper-mailer.svg?branch=master" alt="Build Status">
    </a>  
    <a href="https://scrutinizer-ci.com/g/terabytesoftw/helper-mailer/" target="_blank">
        <img src="https://scrutinizer-ci.com/g/terabytesoftw/helper-mailer/badges/build.png?b=master" alt="Build Status">
    </a>
    <a href="https://scrutinizer-ci.com/g/terabytesoftw/helper-mailer/" target="_blank">
        <img src="https://scrutinizer-ci.com/g/terabytesoftw/helper-mailer/badges/coverage.png?b=master" alt="Build Status">
    </a>    
    <a href="https://scrutinizer-ci.com/g/terabytesoftw/helper-mailer/?branch=master" target="_blank">
     	<img src="https://scrutinizer-ci.com/g/terabytesoftw/helper-mailer/badges/quality-score.png?b=master" alt="Code Quality">
    </a>
    <a href="https://scrutinizer-ci.com/code-intelligence" target="_blank">
     	<img src="https://scrutinizer-ci.com/g/terabytesoftw/helper-mailer/badges/code-intelligence.svg?b=master" alt="Code Intelligence Status">
    </a>
    <a href="https://codeclimate.com/github/terabytesoftw/helper-mailer/maintainability" target="_blank">
        <img src="https://api.codeclimate.com/v1/badges/9bbe65b6fda1abd74c2c/maintainability" alt="Maintainability">
    </a>		
</p>

</br>

### **DIRECTORY STRUCTURE:**

```
config/             contains application configurations
src/                contains source files
tests/              contains tests codeception for the web application
vendor/             contains dependent 3rd-party packages
```

### **REQUIREMENTS:**

- The minimum requirement by this project template that your Web server supports:
    - PHP 7.2 or higher.
    - [Composer Config Plugin](https://github.com/hiqdev/composer-config-plugin)

### **INSTALLATION:**

<p align="justify">
If you do not have <a href="http://getcomposer.org/" title="Composer" target="_blank">Composer</a>, you may install it by following the instructions at <a href="http://getcomposer.org/doc/00-intro.md#installation-nix" title="getcomposer.org" target="_blank">getcomposer.org</a>.
</p>

You can then install this extension using the following command composer:

~~~
composer require terabytesoftw/helper-mailer '^1.0@dev'
~~~

or add composer.json:

~~~
"terabytesoftw/helper-mailer":"^1.0@dev"
~~~

### **USAGE:**

~~~
// config params defaults config/maileruser.php
// note: if you change one of the default values you must execute: composer du, from the command line.

    // config default
    'helper.mailer.usefiletransport' => true,
    'helper.mailer.sender' => 'no-reply@helpermailer.com', // from->email
    'helper.mailer.sender.name' => 'helper mailer example', // from->name
    'helper.mailer.swiftmailer.logging' => false,
    'helper.mailer.viewpath' => '@root/tests/_data/views', // viewPath

// Simple email:

<?php

use terabytesoft\helpers\Mailer;

$mailer = new Mailer();

$this->mailer->sendMessage(
    'test@helpermailer.com', // to->email
    'test mailer user codecept', // subject->email
    // options mailer
    [
        'replyTo' => 'replyto@helpermailer.com', // replyTo->email
        'textBody' => 'Plain text content' // bodyContent->email
    ]
);

// Email with views params:

<?php

use terabytesoft\helpers\Mailer;

$mailer = new Mailer();

$this->mailer->sendMessage(
    'test@helpermailer.com', // to->email
    'test mailer user codecept', // subject->email
    [
        'views' => 'viewtest', //view->email
    ],
    [
        'params' => 'Params text content' //params->email
    ]
);
~~~

### **RUN TESTS CODECEPTION:**

~~~
// download all composer dependencies root project
$ composer update --prefer-dist -vvv

// run all tests with code coverage
$ vendor/bin/codecept run --coverage-xml
~~~

### **WEB SERVER SUPPORT:**

- Apache.
- Nginx.
- OpenLiteSpeed.

### **DOCUMENTATION STYLE GUIDE:**

[Style CI Documentation PSR2.](https://docs.styleci.io/presets#psr2)

### **LICENCE:**

[![License](https://poser.pugx.org/terabytesoftw/helper-mailer/license.svg)](LICENSE.md)
[![YiiFramework](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](https://www.yiiframework.com/)
[![Total Downloads](https://poser.pugx.org/terabytesoftw/helper-mailer/downloads.svg)](https://packagist.org/packages/terabytesoftw/helper-mailer)
[![StyleCI](https://github.styleci.io/repos/195688130/shield?branch=master)](https://github.styleci.io/repos/195688130)
