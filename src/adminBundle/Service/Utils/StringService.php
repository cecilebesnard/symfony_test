<?php
/**
 * Created by PhpStorm.
 * User: wamobi10
 * Date: 12/01/17
 * Time: 12:06
 */

namespace adminBundle\Service\Utils;


class StringService
{
    public function generateUniqId()
    {
        $result = bin2hex(openssl_random_pseudo_bytes(16));
        return $result;
    }
}