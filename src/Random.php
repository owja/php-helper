<?php

/**
 *   Class to generate Random strings based on
 *   https://gist.github.com/raveren/5555297
 *   Rokas Šleinius (raveren)
 */

namespace Owja\Helper;

class Random
{
    const ALNUM     = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const ALPHA     = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const HEX       = '0123456789abcdef';
    const NUMBERS   = '0123456789';

    /**
     * @var string
     */
    protected $token;

    /**
     * Constructor
     *
     * @param integer $length
     * @param string $pool
     */
    public function __construct(int $length = null, string $pool = self::ALNUM)
    {
        if ($length !== null) {
            $this->token = $this->generate($length, $pool);
        }
    }

    /**
     * Generate Random String
     *
     * @param integer $length
     * @param string $_pool
     * @return string
     * @throws \Exception
     */
    public function generate(int $length = 128, string $_pool = self::ALNUM) : string
    {
        if ($length < 1) {
            throw new \Exception('Length lower than one is not allowed.');
        }

        if (empty($_pool)) {
            throw new \Exception('Empty pool is not allowed.');
        }

        $token = "";
        $pool = str_split($_pool);
        $max = count($pool);

        for ($i = 0; $i < $length; $i++) {
            $token .= $pool[$this->_rnd(0, $max)];
        }

        return $token;
    }

    /**
     * Get Random Integer
     *
     * @param integer $min
     * @param integer $max
     * @return integer
     */
    protected function _rnd(int $min, int $max) : int
    {
        $range = $max - $min;
        $log    = log( $range, 2 );
        $bytes  = (int) ( $log / 8 ) + 1;
        $bits   = (int) $log + 1;
        $filter = (int) ( 1 << $bits ) - 1;

        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes))) & $filter;
        } while ( $rnd >= $range );

        return $min + $rnd;
    }


    /**
     * Convert to String
     *
     * @return string
     * @throws \Exception
     */
    public function getToken() : string
    {
        if (empty($this->token)) {
            throw new \Exception('No token generated.');
        }

        return (string) $this->token;
    }

    /**
     * Convert to String
     *
     * @return string
     */
    public function __toString() : string
    {
        return $this->getToken();
    }
}