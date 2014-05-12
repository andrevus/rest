<?php

namespace KnpU\CodeBattle\Api;

/**
 * A wrapper for holding data to be used for a application/problem+json response
 */
class ApiProblem
{
    const TYPE_VALIDATION_ERROR = 'validation_error';

    const TYPE_INVALID_REQUEST_BODY_FORMAT = 'invalid_body_format';

    static private $titles = array(
        self::TYPE_VALIDATION_ERROR => 'There was a validation error',
        self::TYPE_INVALID_REQUEST_BODY_FORMAT => 'Invalid JSON format sent',
    );

    private $type;

    private $statusCode;

    private $title;

    private $extraData = array();

    public function __construct($type, $statusCode)
    {
        $this->type = $type;
        $this->statusCode = $statusCode;

        if (!isset(self::$titles[$type])) {
            throw new \InvalidArgumentException('No title for type '.$type);
        }

        $this->title = self::$titles[$type];
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

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
