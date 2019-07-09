<p align="center">
    <a href="https://github.com/terabytesoftw/mailer-user" target="_blank">
        <img src="https://lh3.googleusercontent.com/D9TFw1F6ddPuheDc_tpNptTdvTg-FNNpjLSBN14X6Sc-3JDiOxfE67rEh4OZfygonx1tKei2b2DEOHDLjF6T3xl8e-rkEEPZeGqLTWcS_v2cBRlyo0vcZLDHG5ivSDGIWCsenbol=w2400" height="50px;">
    </a>
    <h1 align="center">Component Mailer User Core.</h1>
</p>

<p align="center">
    <a href="https://packagist.org/packages/terabytesoftw/mailer-user" target="_blank">
        <img src="https://poser.pugx.org/terabytesoftw/mailer-user/v/unstable.svg" alt="Unstable Version">
    </a>
    <a href="https://travis-ci.org/terabytesoftw/mailer-user" target="_blank">
        <img src="https://travis-ci.org/terabytesoftw/mailer-user.svg?branch=master" alt="Build Status">
    </a>  
    <a href="https://scrutinizer-ci.com/g/terabytesoftw/mailer-user/" target="_blank">
        <img src="https://scrutinizer-ci.com/g/terabytesoftw/mailer-user/badges/build.png?b=master" alt="Build Status">
    </a>
    <a href="https://scrutinizer-ci.com/g/terabytesoftw/mailer-user/" target="_blank">
        <img src="https://scrutinizer-ci.com/g/terabytesoftw/mailer-user/badges/coverage.png?b=master" alt="Build Status">
    </a>    
    <a href="https://scrutinizer-ci.com/g/terabytesoftw/mailer-user/?branch=master" target="_blank">
     	<img src="https://scrutinizer-ci.com/g/terabytesoftw/mailer-user/badges/quality-score.png?b=master" alt="Code Quality">
    </a>
    <a href="https://scrutinizer-ci.com/code-intelligence" target="_blank">
     	<img src="https://scrutinizer-ci.com/g/terabytesoftw/mailer-user/badges/code-intelligence.svg?b=master" alt="Code Intelligence Status">
    </a>
    <a href="https://codeclimate.com/github/terabytesoftw/mailer-user/maintainability" target="_blank">
        <img src="https://api.codeclimate.com/v1/badges/9bbe65b6fda1abd74c2c/maintainability" alt="Maintainability">
    </a>		
</p>

</br>

<p align="center">
App Web Application Basic of Yii Version 2.0. <a href="http://www.yiiframework.com/" title="Yii Framework" target="_blank">Yii Framework</a> application best for rapidly creating projects with Bootstrap 4.
</p>

### **DIRECTORY STRUCTURE:**

```
config/             contains application configurations
docs/               contains documentation application basic
src/                contains source files
tests/              contains tests codeception for the web application
vendor/             contains dependent 3rd-party packages
```

### **REQUIREMENTS:**

- The minimum requirement by this project template that your Web server supports:
    - PHP 7.2 or higher.
    - [Composer Config Plugin](https://github.com/hiqdev/composer-config-plugin)

### **GENERATE MESSAGES TRANSLATION:**

<p align="justify">
To generate the Component Mailer User Core translations, you can change the language settings in:
<p>

```
config/messages.php - [mailer-user]:

'languages' => ['en'], 
```
<p align="justify">
 Automatically the generator will create the folder of your language in /messages - [mailer-user], If any translation is needed, you can open an issue to add it.
</p>

```
root directory - [mailer-user]:
./vendor/bin/yii message config/messages.php
```

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

[![License](https://poser.pugx.org/terabytesoftw/mailer-user/license.svg)](LICENSE.md)
[![YiiFramework](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](https://www.yiiframework.com/)
[![Total Downloads](https://poser.pugx.org/terabytesoftw/mailer-user/downloads.svg)](https://packagist.org/packages/terabytesoftw/mailer-user)
[![StyleCI](https://github.styleci.io/repos/195688130/shield?branch=master)](https://github.styleci.io/repos/195688130)
