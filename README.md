base32Lowercase
===============

Lowercased Base32 Encoder/Decoder.

Usage
-----

    <?php

    // Include class or user autoloader
    use Base32Lowercase\Base32Lowercase;

    $TestString="AbCDEFGHIJKlMNOpQrSTWXYZ123456789.ABcDEFGHiJK---ABcd**12.12.2014.JPEG";
    $this->assertEquals($TestString, Base32Lowercase::decode(Base32Lowercase::encode($TestString)));


Requirements
------------

PHP 5.3.x+

If you want to run the tests, PHPUnit 3.6 or up is required.

Author
------


This class based on Christian Riesen's base32 class

https://github.com/ChristianRiesen/base32

I just did some minor changes in that class.