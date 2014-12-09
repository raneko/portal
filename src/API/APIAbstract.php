<?php

namespace Portal\API;

/**
 * @author Harry Lesmana <harry@raneko.com>
 * @since 2014-12-08
 */
abstract class APIAbstract {

    protected $_apiType;
    protected $_apiEntity;
    protected $_apiCmd;
    protected $_apiToken;

    /**
     * Call API.
     * @param array $params
     * @return \Portal\Result
     */
    public function call($params = array()) {
        $result = new \Portal\Result();
        $proceed = $this->validatePreRequisite();
        $postParams = array();

        /**
         * Validate parameters.
         */
        if ($proceed) {
            $proceed = $this->_validateParam($param);
        }

        /**
         * Add additional API data.
         */
        if ($proceed) {
            $params["api_key"] = \Portal\Config::getApiKey();
            $params["api_cmd"] = $this->_apiCmd;
            $params["api_token"] = \Portal\App::getTokenId();
            foreach ($params as $_key => $_value) {
                $postParams = $_key . "=" . urlencode($_value);
            }
        }

        if ($proceed) {
            /* Initiate connection */
            $_ch = curl_init();

            curl_setopt($_ch, CURLOPT_URL, $this->buildURL());
            curl_setopt($_ch, CURLOPT_POST, count($postParams));
            curl_setopt($_ch, CURLOPT_POSTFIELDS, implode("&", $postParams));
            curl_setopt($_ch, CURLOPT_RETURNTRANSFER, 1); /* Don"t echo result */
            curl_setopt($_ch, CURLOPT_VERBOSE, 1);
            curl_setopt($_ch, CURLOPT_HEADER, 1); /* Get header */
            curl_setopt($_ch, CURLOPT_SSL_VERIFYPEER, false); /* Ignore CA */
            curl_setopt($_ch, CURLOPT_HTTPHEADER, array("Content-Type: text/plain"));

            /* Execute POST */
            $_result = curl_exec($_ch);

            /* Check if CURL call successful */
            if ($_result !== FALSE) {
                $_headerSize = curl_getinfo($_ch, CURLINFO_HEADER_SIZE);

                $result->setResponseHeader(substr($_result, 0, $_headerSize));
                $result->fromArray(json_decode(substr($_result, $_headerSize), TRUE));
            }

            /* Close connection */
            curl_close($_ch);
        }

        return $result;
    }

    /**
     * Check whether parameter is valid.
     * @return boolean
     */
    abstract protected function _validateParam($param);

    private function validatePreRequisite() {
        $result = TRUE;

        if (!isset($this->_apiType)) {
            throw new Exception("API type is not set, this is to be set through implementation class");
        }
        if (!isset($this->_apiEntity)) {
            throw new Exception("API entity is not set, this is to be set through implementation class");
        }
        if (!isset($this->_apiCmd)) {
            throw new Exception("API command is not set, this is to be set through implementation class");
        }
        if (\Portal\Config::getHost() == NULL) {
            throw new Exception("API host is not set, this is to be set through Portal\\Config");
        }
        if (\Portal\Config::getApiKey() == NULL) {
            throw new Exception("API key is not set, this is to be set through Portal\\Config");
        }

        return $result;
    }

    /**
     * Build URL based on the given parameters.
     * @return string
     */
    private function buildURL() {
        $result = array(
            "http://",
            \Portal\Config::getHost(),
            ":",
            \Portal\Config::getPort(),
            "/",
            $this->_apiEntity,
            ".",
            \Portal\Config::getExtension()
        );
        return implode("", $result);
    }

    /**
     * Set call type to txn.
     */
    protected function _setTypeTxn() {
        $this->_apiType = "txn";
    }

    /**
     * Set call type to view.
     */
    protected function _setTypeView() {
        $this->_apiType = "view";
    }

}
