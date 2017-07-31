<?php

namespace Owja\Helper;

class Data
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * Constructor
     *
     * @param mixed $data
     */
    public function __construct($data = null)
    {
        $this->data = $data;
    }

    /**
     * Get Data by Path
     *
     * @param string $path
     * @throws \Exception
     * @return mixed
     */
    public function get($path)
    {
        $data = $this->data;

        if (!is_string($path) || empty($path)) {
            throw new \Exception('Path must be a valid String');
        }

        if (empty($data)) {
            return null;
        }

        $current = null;

        foreach (explode('.', $path) as $key) {
            $getter = 'get' . str_replace("_", "", ucwords($key, "_"));

            if (is_array($data) && isset($data[$key])) {
                $current = $data[$key];
            } else if (is_object($data) && is_callable(array($data, $getter))) {
                $current = $data->{$getter}();
            } else if (is_object($data) && isset($data->{$key})) {
                $current = $data->{$key};
            } else {
                return null;
            }

            $data = $current;
        }

        return $data;
    }

    /**
     * Set Data
     *
     * @param mixed $data
     * @return Data
     */
    public function set($data)
    {
        $this->data = $data;
        return $this;
    }

}
