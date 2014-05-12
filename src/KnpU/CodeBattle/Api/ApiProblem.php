<?php

namespace KnpU\CodeBattle\Api;

/**
 * A wrapper for holding data to be used for a application/problem+json response
 */
class ApiProblem
{
    private $type;

    private $statusCode;

    private $title;

    private $extraData = array();

    public function __construct($type, $statusCode, $title)
    {
        $this->type = $type;
        $this->statusCode = $statusCode;
        $this->title = $title;
    }

    public function toArray()
    {
        return array_merge(
            $this->extraData,
            [
                'type' => $this->type,
                'title' => $this->title,
                'status' => $this->statusCode
            ]
        );
    }

    public function set($name, $value)
    {
        $this->extraData[$name] = $value;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
