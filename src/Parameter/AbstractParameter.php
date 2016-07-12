<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Parameter;

use ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface;

/**
 * AbstractParameter.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
abstract class AbstractParameter implements ParameterInterface
{
    /**
     * The location of the parameter.
     *
     * @var string
     */
    protected $in;

    /**
     * The name of the parameter.
     *
     * @var string
     */
    private $name;

    /**
     * The schema element instance containing the location specific parameters.
     *
     * @var SchemaElementInterface
     */
    private $schema;

    /**
     * The brief description of the parameter.
     *
     * @var string
     */
    private $description;

    /**
     * The boolean indicating whether this parameter is mandatory.
     *
     * @var bool
     */
    private $required;

    /**
     * Constructs a new AbstractParameter instance.
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
     * Sets the brief description of the parameter.
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Sets whether this parameter is mandatory.
     *
     * @param bool $required
     *
     * @return self
     */
    public function setRequired($required)
    {
        $this->required = $required;

        return $this;
    }
}
