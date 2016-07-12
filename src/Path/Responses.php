<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Path;

use ConnectHolland\OpenAPISpecificationGenerator\Path\Response\ResponseInterface;
use InvalidArgumentException;

/**
 * Responses.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class Responses
{
    /**
     * The array with response instances.
     *
     * @var ResponseInterface[]
     */
    private $responses = array();

    /**
     * Sets the default response.
     *
     * @param ResponseInterface $default
     *
     * @return Responses
     */
    public function setDefault(ResponseInterface $default)
    {
        $this->responses['default'] = $default;

        return $this;
    }

    /**
     * Sets the expected response for a HTTP status code.
     *
     * @param int               $httpStatusCode
     * @param ResponseInterface $response
     *
     * @return Responses
     *
     * @throws InvalidArgumentException when invalid HTTP status code is supplied.
     */
    public function setResponse($httpStatusCode, ResponseInterface $response)
    {
        if (is_int($httpStatusCode) === false || $httpStatusCode < 100 || $httpStatusCode > 599) {
            throw new InvalidArgumentException(sprintf('Invalid HTTP status code "%s" supplied.', $httpStatusCode));
        }

        $this->responses[$httpStatusCode] = $response;

        return $this;
    }

    /**
     * Returns a new Responses instance.
     *
     * @return Responses
     */
    public static function create()
    {
        return new self();
    }
}
