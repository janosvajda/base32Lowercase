<?php

namespace Base32Lowercase;

/**
 * Base32 encoder and decoder
 *
 * Last update: 2012-06-20
 *
 * RFC 4648 compliant
 * @link http://www.ietf.org/rfc/rfc4648.txt
 *
 * Some groundwork based on this class
 * https://github.com/NTICompass/PHP-Base32
 *
 * @author Christian Riesen <chris.riesen@gmail.com>
 * @link http://christianriesen.com
 * @license MIT License see LICENSE file
 */
class Base32Lowercase
{
    /**
	 * Table for encoding base32
	 *
	 * @var array
	 */
    private static $encode = array(
        0 => 'a',
        1 => 'b',
        2 => 'c',
        3 => 'd',
        4 => 'e',
        5 => 'f',
        6 => 'g',
        7 => 'h',
        8 => 'i',
        9 => 'j',
        10 => 'k',
        11 => 'l',
        12 => 'm',
        13 => 'n',
        14 => 'o',
        15 => 'p',
        16 => 'q',
        17 => 'r',
        18 => 's',
        19 => 't',
        20 => 'u',
        21 => 'v',
        22 => 'w',
        23 => 'x',
        24 => 'y',
        25 => 'z',
        26 => 2,
        27 => 3,
        28 => 4,
        29 => 5,
        30 => 6,
        31 => 7,
        32 => '=',
    );
    /**
	 * Table for decoding base32
	 *
	 * @var array
	 */
    private static $decode = array(
        'a' => 0,
        'b' => 1,
        'c' => 2,
        'd' => 3,
        'e' => 4,
        'f' => 5,
        'g' => 6,
        'h' => 7,
        'i' => 8,
        'j' => 9,
        'k' => 10,
        'l' => 11,
        'm' => 12,
        'n' => 13,
        'o' => 14,
        'p' => 15,
        'q' => 16,
        'r' => 17,
        's' => 18,
        't' => 19,
        'u' => 20,
        'v' => 21,
        'w' => 22,
        'x' => 23,
        'y' => 24,
        'z' => 25,
        2 => 26,
        3 => 27,
        4 => 28,
        5 => 29,
        6 => 30,
        7 => 31,
        '=' => 32,
    );
    /**
	 * Creates an array from a binary string into a given chunk size
	 *
	 * @param string $binaryString String to chunk
	 * @param integer $bits Number of bits per chunk
	 * @return array
	 */
    private static function chunk($binaryString, $bits)
    {
        $binaryString = chunk_split($binaryString, $bits, ' ');
        if (substr($binaryString, (strlen($binaryString)) - 1)  == ' ') {
            $binaryString = substr($binaryString, 0, strlen($binaryString)-1);
        }
        return explode(' ', $binaryString);
    }
    /**
	 * Encodes into base32
	 *
	 * @param string $string Clear text string
	 * @return string Base32 encoded string
	 */
    public static function encode($string)
    {
        if (strlen($string) == 0) {
			// Gives an empty string
            return '';
		}
        // Convert string to binary
        $binaryString = '';
		foreach (str_split($string) as $s) {
			// Return each character as an 8-bit binary string
            $s = decbin(ord($s));
			$binaryString .= str_pad($s, 8, 0, STR_PAD_LEFT);
		}
        // Break into 5-bit chunks, then break that into an array
        $binaryArray = self::chunk($binaryString, 5);
        // Pad array to be divisible by 8
        while (count($binaryArray) % 8 !== 0) {
            $binaryArray[] = null;
        }
        $base32String = '';
        // Encode in base32
        foreach ($binaryArray as $bin) {
            $char = 32;
            if (!is_null($bin)) {
                // Pad the binary strings
                $bin = str_pad($bin, 5, 0, STR_PAD_RIGHT);
                $char = bindec($bin);
            }
            // Base32 character
            $base32String .= self::$encode[$char];
        }
        return $base32String;
    }
    /**
	 * Decodes base32
	 *
	 * @param string $base32String Base32 encoded string
	 * @return string Clear text string
	 */
    public static function decode($base32String)
    {
        if (strlen($base32String) == 0) {
            // Gives an empty string
            return '';
        }
        // Only work in upper cases
        $base32String = strtolower($base32String);
        // Remove anything that is not base32 alphabet
        $pattern = '/[^a-z2-7]/';
		$base32String = preg_replace($pattern, '', $base32String);
        $base32Array = str_split($base32String);
        $string = '';
        foreach ($base32Array as $str) {
            $char = self::$decode[$str];
            // Ignore the padding character
            if ($char !== 32) {
                $char = decbin($char);
                $string .= str_pad($char, 5, 0, STR_PAD_LEFT);
            }
        }
        while (strlen($string) %8 !== 0) {
            $string = substr($string, 0, strlen($string)-1);
        }
        $binaryArray = self::chunk($string, 8);
		$realString = '';
		foreach ($binaryArray as $bin) {
			// Pad each value to 8 bits
            $bin = str_pad($bin, 8, 0, STR_PAD_RIGHT);
			// Convert binary strings to ASCII
            $realString .= chr(bindec($bin));
		}
		return $realString;
    }
}