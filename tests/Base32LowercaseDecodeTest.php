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
        $TestString="AbCDEFGHIJKlMNOpQrSTWXYZ123456789.ABcDEFGHiJK---ABcd**12.12.2014.JPEG";
        var_dump(Base32Lowercase::encode($TestString));
        $this->assertEquals($TestString, Base32Lowercase::decode(Base32Lowercase::encode($TestString)));
    }    
    
    /**
     * Test special characters
     */
    public function testEncodeSpecialchars2(){
        $TestString="++==AbCDEFGHIJKlMNOpQrSTWXYZ123456789.ABcDEFGHiJK---ABcd**12.12.20--*/14.JPEG=====";
        $this->assertEquals($TestString, Base32Lowercase::decode(Base32Lowercase::encode($TestString)));
    }    
}

