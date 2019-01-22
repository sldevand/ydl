<?php

namespace App\Token;

use App\Exception\TokenException;

/**
 * Class TokenManager
 * @package Token
 * @author Sébastien Lorrain
 */
class TokenManager
{
    /**
     * @return string
     * @throws TokenException
     */
    public static function create()
    {

        try {
            $token = version_compare(phpversion(), '7.0.0', '<')
                ? (function_exists('mcrypt_create_iv')
                    ? bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM))
                    : bin2hex(openssl_random_pseudo_bytes(32)))
                : bin2hex(random_bytes(32));
            $_SESSION['token'] = $token;
            return $token;
        } catch (\Exception $e) {
            throw new TokenException($e->getMessage());
        }
    }

    /**
     * @return bool
     * @throws TokenException
     */
    public static function check()
    {
        if (empty($_POST['token'])) {
            throw new TokenException("Le token est vide");
        }

        if (!hash_equals($_SESSION['token'], $_POST['token'])) {
            throw new TokenException("Le token a echoué");
        }

        return true;
    }
}
