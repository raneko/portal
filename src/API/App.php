<?php

namespace Portal;

/**
 * @author Harry Lesmana <harry@raneko.com>
 * @since 2014-12-09
 */
class App {

    /**
     * Get user token id.
     * @return string NULL if token id is not found.
     */
    public static function getTokenId() {
        return isset($_COOKIE[\Portal\Config::getTokenKey()]) ? $_COOKIE[\Portal\Config::getTokenKey()] : NULL;
    }
    
    /**
     * Get remote IP address.
     * @return string
     */
    public static function getIP()
    {
        return $_SERVER["REMOTE_ADDR"];
    }

}
