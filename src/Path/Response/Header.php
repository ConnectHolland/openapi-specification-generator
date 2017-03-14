<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Path\Response;

use ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface;

/**
 * Header.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class Header implements HeaderInterface
{
    /**
     * The name of the header.
     *
     * @var string
     */
    private $name;

    /**
     * The definition of the header.
     *
     * @var SchemaElementInterface
     */
    private $schema;

    /**
     * Constructs a new Header instance.
     *
     * @param string                 $name
     * @param SchemaElementInterface $schema
     */
    public function __construct($name, SchemaElementInterface $schema)
    {
        $this->name = $name;
        $this->schema = $schema;
    }

    /**
     * Returns the name of the header.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the representation of this object for JSON encoding.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->schema->jsonSerialize();
    }

    /**
     * Returns a new Header instance.
     *
     * @param string                 $name
     * @param SchemaElementInterface $schema
     *
     * @return Header
     */
    public static function create($name, SchemaElementInterface $schema)
    {
        return new self($name, $schema);
    }
}
