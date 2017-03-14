<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Path;

use ConnectHolland\OpenAPISpecificationGenerator\ExternalDocumentation;
use ConnectHolland\OpenAPISpecificationGenerator\Parameter\ParameterInterface;
use JsonSerializable;

/**
 * Operation.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class Operation implements JsonSerializable
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
     * Returns true when this operation is marked as deprecated.
     *
     * @return bool
     */
    public function isDeprecated()
    {
        return $this->deprecated === true;
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
     * Sets additional external documentation for this operation.
     *
     * @param ExternalDocumentation $externalDocumentation additional external documentation for this operation
     *
     * @return Operation
     */
    public function setExternalDocumentation(ExternalDocumentation $externalDocumentation)
    {
        $this->externalDocumentation = $externalDocumentation;

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
     * @param array $tags a list of tags for API documentation control
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
     * Returns the representation of this object for JSON encoding.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $operation = array();
        if (isset($this->operationId)) {
            $operation['operationId'] = $this->operationId;
        }
        if (isset($this->summary)) {
            $operation['summary'] = $this->summary;
        }
        if (isset($this->description)) {
            $operation['description'] = $this->description;
        }
        if (isset($this->externalDocumentation)) {
            $operation['externalDocs'] = $this->externalDocumentation->jsonSerialize();
        }
        if (empty($this->consumes) === false) {
            $operation['consumes'] = $this->consumes;
        }
        if (empty($this->produces) === false) {
            $operation['produces'] = $this->produces;
        }
        if (empty($this->parameters) === false) {
            $operation['parameters'] = array();
            foreach ($this->parameters as $parameter) {
                $operation['parameters'][] = $parameter->jsonSerialize();
            }
        }
        $operation['responses'] = $this->responses->jsonSerialize();
        if (empty($this->schemes) === false) {
            $operation['schemes'] = $this->schemes;
        }
        if ($this->isDeprecated()) {
            $operation['deprecated'] = true;
        }
        if (empty($this->tags) === false) {
            $operation['tags'] = $this->tags;
        }

        return $operation;
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
