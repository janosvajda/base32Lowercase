base32Lowercase
======

lowercased Base32 Encoder/Decoder

Usage
-----

    <?php

    // Include class or user autoloader
    use Base32\Base32Lowercase;

    $string = 'KjLOKMjHlsksjd-odKKKlsmd.JPeg';

    $encoded = Base32::encode($string);
    // $encoded contains now 'MZXW6YTB'

    $decoded = Base32::decode($encoded);
    // $decoded is again 'KjLOKMjHlsksjd-odKKKlsmd.JPeg'


About
=====

Use
---


Goal
----

Requirements
------------

PHP 5.3.x+

If you want to run the tests, PHPUnit 3.6 or up is required.

Author
------


This class based on Christian Riesen's base32 class

https://github.com/ChristianRiesen/base32

I just did some minor changes in that class.