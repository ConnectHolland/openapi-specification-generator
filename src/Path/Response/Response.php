<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Path\Response;

use ConnectHolland\OpenAPISpecificationGenerator\Schema\Schema;
use ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface;

/**
 * Response.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class Response implements ResponseInterface
{
    /**
     * The short description of the response.
     *
     * @var string
     */
    private $description;

    /**
     * The definition of the response structure.
     *
     * @var Schema
     */
    private $schema;

    /**
     * The list of headers that are sent with the response.
     *
     * @var HeaderInterface[]
     */
    private $headers = array();

    /**
     * The examples for operation responses.
     *
     * @var array
     */
    private $examples = array();

    /**
     * Constructs a new Response instance.
     *
     * @param string $description a short description of the response
     */
    public function __construct($description)
    {
        $this->description = $description;
    }

    /**
     * Sets the definition of the response structure.
     *
     * @param SchemaElementInterface $schema a definition of the response structure
     *
     * @return Response
     */
    public function setSchema(SchemaElementInterface $schema)
    {
        $this->schema = $schema;

        return $this;
    }

    /**
     * Adds a header to the list of headers that are sent with the response.
     *
     * @param HeaderInterface $header
     *
     * @return Response
     */
    public function addHeader(HeaderInterface $header)
    {
        $this->headers[] = $header;

        return $this;
    }

    /**
     * Returns the representation of this object for JSON encoding.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $response = array(
            'description' => $this->description,
        );
        if (isset($this->schema)) {
            $response['schema'] = $this->schema->jsonSerialize();
        }
        if (empty($this->headers) === false) {
            $response['headers'] = array();
            foreach ($this->headers as $header) {
                $response['headers'][$header->getName()] = $header->jsonSerialize();
            }
        }

        return $response;
    }

    /**
     * Returns a new Response instance.
     *
     * @param string $description a short description of the response
     *
     * @return Response
     */
    public static function create($description)
    {
        return new self($description);
    }
}
