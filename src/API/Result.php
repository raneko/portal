<?php

namespace Portal;

/**
 * @author Harry Lesmana <harry@raneko.com>
 * @since 2014-12-09
 */
class Result {

    private $isSuccesful;
    private $responseCode;
    private $responseData;
    private $requestURL;
    private $responseHeader;

    public function __construct() {
        $this->isSuccesful = FALSE;
        $this->responseCode = "F";
        $this->responseData = array();
    }

    /**
     * Convert array to result object.
     * @param array $data
     */
    public function fromArray($data) {
        if (in_array($data["code"], array(0, "0"))) {
            $this->isSuccesful = TRUE;
        }
        $this->responseData = $data["data"];
    }

    /**
     * Get response data.
     * @return array
     */
    public function getData() {
        return $this->responseData;
    }

    /**
     * Get response code.
     * @return string
     */
    public function getResponseCode() {
        return $this->responseCode;
    }

    /**
     * Check whether the call result is succssful.
     * You might want to use this method to determine instead of manually checking the response code.
     * @return boolean
     */
    public function isSuccesful() {
        return $this->isSuccesful;
    }

    /**
     * CURL response header.
     * @param string $responseHeader
     */
    public function setResponseHeader($responseHeader) {
        $this->responseHeader = $responseHeader;
    }

    public function getResponseHeader() {
        return $this->responseHeader;
    }

    /**
     * Request URL.
     * @param string $url
     */
    public function setRequestURL($url) {
        $this->requestURL = $url;
    }

    public function getRequestURL() {
        return $this->requestURL;
    }

}
