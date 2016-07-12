<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Path;

use ConnectHolland\OpenAPISpecificationGenerator\Parameter\ParameterInterface;

/**
 * Operation.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class Operation
{
    /**
     * The unique string used to identify the operation. The id MUST be unique among all operations described in the API.
     *
     * @var string
     */
    private $operationId;

    /**
     * The short summary of what the operation does.
     *
     * @var string
     */
    private $summary;

    /**
     * The verbose explanation of the operation behavior.
     *
     * @var string
     */
    private $description;

    /**
     * The list of MIME types the operation can consume. This overrides the consumes definition at the root object.
     *
     * @var array
     */
    private $consumes = array();

    /**
     * The list of MIME types the operation can produce. This overrides the produces definition at the root object.
     *
     * @var array
     */
    private $produces = array();

    /**
     * The transfer protocol for the operation. This overrides the schemes definition at the root object.
     *
     * @var array
     */
    private $schemes = array();

    /**
     * The list of parameters that are applicable for this operation.
     *
     * @var array
     */
    private $parameters = array();

    /**
     * The list of possible responses as they are returned from executing this operation.
     *
     * @var Responses
     */
    private $responses;

    /**
     * The list of tags for API documentation control.
     *
     * @var array
     */
    private $tags = array();

    /**
     * The additional external documentation for this operation.
     *
     * @var ExternalDocumentation
     */
    private $externalDocumentation;

    /**
     * The boolean declaring this operation to be deprecated.
     *
     * @var bool
     */
    private $deprecated = false;

    /**
     * A declaration of which security schemes are applied for this operation.
     *
     * @var SecurityRequirement
     */
    private $security;

    /**
     * Constructs a new Operation instance.
     *
     * @param Responses $responses
     */
    public function __construct(Responses $responses)
    {
        $this->responses = $responses;
    }

    /**
     * Sets the unique string used to identify the operation.
     *
     * @param string $operationId
     *
     * @return Operation
     */
    public function setOperationId($operationId)
    {
        $this->operationId = $operationId;

        return $this;
    }

    /**
     * Sets the short summary of what the operation does.
     *
     * @param string $summary
     *
     * @return Operation
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Sets the verbose explanation of the operation behavior.
     *
     * @param string $description
     *
     * @return Operation
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Sets the list of MIME types the operation can consume.
     *
     * @param array $consumes
     *
     * @return Operation
     */
    public function setConsumes(array $consumes)
    {
        $this->consumes = $consumes;

        return $this;
    }

    /**
     * Sets the list of MIME types the operation can produce.
     *
     * @param array $produces
     *
     * @return Operation
     */
    public function setProduces(array $produces)
    {
        $this->produces = $produces;

        return $this;
    }

    /**
     * Sets the transfer protocol for the operation.
     *
     * @param array $schemes
     *
     * @return Operation
     */
    public function setSchemes(array $schemes)
    {
        $this->schemes = $schemes;

        return $this;
    }

    /**
     * Sets the list of tags for API documentation control.
     *
     * @param array $tags A list of tags for API documentation control.
     *
     * @return Operation
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Sets this operation to be deprecated.
     *
     * @param bool $deprecated
     *
     * @return Operation
     */
    public function setDeprecated($deprecated)
    {
        $this->deprecated = $deprecated;

        return $this;
    }

    /**
     * Adds a parameter applicable for this operation.
     *
     * @param ParameterInterface $parameter
     *
     * @return Operation
     */
    public function addParameter(ParameterInterface $parameter)
    {
        $this->parameters[] = $parameter;

        return $this;
    }

    /**
     * Returns a new Operation instance.
     *
     * @param Responses $responses
     *
     * @return Operation
     */
    public static function create(Responses $responses)
    {
        return new self($responses);
    }
}
