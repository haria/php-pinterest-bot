<?php

namespace seregazhuk\PinterestBot\Api;

use seregazhuk\PinterestBot\Contracts\HttpInterface;

/**
 * Class CurlAdapter
 *
 * @package seregazhuk\PinterestBot
 * @property string $cookieJar
 * @property string $cookePath
 */
class CurlAdapter implements HttpInterface
{
    /**
     * Contains the curl instance
     *
     * @var resource
     */
    private $curl;

    /**
     * Initializes curl resource
     *
     * @access public
     * @param string $url
     *
     * @return $this
     */
    public function init($url)
    {
        $this->curl = curl_init($url);

        return $this;
    }

    /**
     * Sets an option in the curl instance
     *
     * @access public
     * @param  string $option
     * @param  string $value
     * @return static
     */
    public function setOption($option, $value)
    {
        curl_setopt($this->curl, $option, $value);

        return $this;
    }

    /**
     * Sets multiple options at the same time
     *
     * @access public
     * @param  array $options
     * @return static
     */
    public function setOptions(array $options = [])
    {
        curl_setopt_array($this->curl, $options);

        return $this;
    }


    /**
     * Check if the curl request ended up with errors
     *
     * @access public
     * @return boolean
     */
    public function hasErrors()
    {
        return curl_errno($this->curl) ? true : false;
    }

    /**
     * Get curl errors
     *
     * @access public
     * @return string
     */
    public function getErrors()
    {
        return curl_error($this->curl);
    }

    /**
     * Get curl info key
     *
     * @access public
     * @param  string $key
     * @return string
     */
    public function getInfo($key)
    {
        return curl_getinfo($this->curl, $key);
    }

    /**
     * Close the curl resource
     *
     * @access public
     * @return void
     */
    public function close()
    {
        curl_close($this->curl);
    }


    /**
     * Executes curl request
     *
     * @return array
     */
    public function execute()
    {
        return curl_exec($this->curl);
    }
}