<?php
/**
 * @author Janos Vajda
 */

namespace Base32LowercaseTest;

require __DIR__ . '/../src/Base32Lowercase.php';

use Base32Lowercase\Base32Lowercase;

class Base32LowercaseDecodeTest extends  \PHPUnit_Framework_TestCase{

    /**
     * Test with empty parameter
     */
    public function testEncodeEmpty(){
        $this->assertEquals('', Base32Lowercase::encode(''));
    }

    /**
     * Test special chars
     */
    public function testEncodeSpecialchars(){
        $this->assertEquals('krsxg5bnfvdestdfjzqwk3lfeusu4vknmjstimzsgexeu4dfm4======', Base32Lowercase::encode('Test--FILeNaeme%%NUMbe4321.Jpeg'));
    }    
    
    /**
     * Test mixed chars like date and file extension
     */
    public function testEncodeSpecialcharsWithDate(){
        $this->assertEquals('ifbegrcfizduqskkjnge2ttpobixeu2uk54fswrnfuzdambrgexdamjogezc4ucom4======', Base32Lowercase::encode('ABCDEFGHIJKLMNopQrSTWxYZ--20011.01.12.PNg'));
    }    
}

