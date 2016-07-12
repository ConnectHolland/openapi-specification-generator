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
     * @var Header[]
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
     * @param string $description A short description of the response.
     */
    public function __construct($description)
    {
        $this->description = $description;
    }

    /**
     * Sets the definition of the response structure.
     *
     * @param SchemaElementInterface $schema A definition of the response structure.
     *
     * @return Response
     */
    public function setSchema(SchemaElementInterface $schema)
    {
        $this->schema = $schema;

        return $this;
    }

    /**
     * Returns a new Response instance.
     *
     * @param string $description A short description of the response.
     *
     * @return Response
     */
    public static function create($description)
    {
        return new self($description);
    }
}
