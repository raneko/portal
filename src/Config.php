<?php

namespace Portal;

/**
 * Basic configuration to get the whole class working.
 * @author Harry Lesmana <harry@raneko.com>
 * @since 2014-12-08
 */
class Config {

    /**
     * Static variable to hold all the configuration value.
     * @var array
     */
    private static $data;

    /**
     * Set key to make API call.
     * @param string $key
     */
    public static function setApiKey($key) {
        self::$data["key"] = $key;
    }

    /**
     * Get key to make API call.
     * @return string NULL if api key is not set.
     */
    public static function getApiKey() {
        return isset(self::$data["key"]) ? self::$data["key"] : NULL;
    }

    /**
     * Set API host.
     * @param string $host
     */
    public static function setHost($host) {
        self::$data["host"] = $host;
    }

    /**
     * Get API host.
     * @return string
     */
    public static function getHost() {
        return isset(self::$data["host"]) ? self::$data["host"] : NULL;
    }

    /**
     * Set API port.
     * @param int $port
     */
    public static function setPort($port = 80) {
        self::$data["port"] = $port;
    }

    /**
     * Get API port.
     * Default is set to port 80.
     * @return int
     */
    public static function getPort() {
        return isset(self::$data["port"]) ? self::$data["port"] : 80;
    }

    /**
     * Set response extension to json.
     */
    public static function setExtensionJSON() {
        self::$data["extension"] = "json";
    }

    /**
     * Get response extension.
     * Default is set to json.
     * @return type
     */
    public static function getExtension() {
        return isset(self::$data["extension"]) ? self::$data["extension"] : "json";
    }
    
    /**
     * Get key used to store the token.
     * @return string
     */
    public static function getTokenKey()
    {
        return isset(self::$data["token_key"]) ? self::$data["token_key"] : "tokenId";
    }
    
    /**
     * Set key to get the token.
     * @param string $key
     */
    public static function setTokenKey($key)
    {
        self::$data["token_key"] = $key;
    }

}
