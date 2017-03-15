<?php

namespace ConnectHolland\OpenAPISpecificationGenerator;

use ConnectHolland\OpenAPISpecificationGenerator\Info\Info;
use ConnectHolland\OpenAPISpecificationGenerator\Path\PathItem;
use ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface;
use ConnectHolland\OpenAPISpecificationGenerator\Security\SecuritySchemeInterface;
use JsonSerializable;
use stdClass;

/**
 * Specification.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class Specification implements JsonSerializable
{
    /**
     * Specifies the Swagger Specification version being used.
     *
     * @var string
     */
    private $swagger = '2.0';

    /**
     * The metadata about the API.
     *
     * @var Info
     */
    private $info;

    /**
     * The host (name or ip) serving the API.
     *
     * @var string
     */
    private $host;

    /**
     * The base path on which the API is served.
     *
     * @var string
     */
    private $basePath;

    /**
     * The transfer protocol of the API.
     *
     * @var array
     */
    private $schemes = array();

    /**
     * The list of MIME types the APIs can consume.
     *
     * @var array
     */
    private $consumes = array();

    /**
     * The list of MIME types the APIs can produce.
     *
     * @var array
     */
    private $produces = array();

    /**
     * The available paths and operations for the API.
     *
     * @var PathItem[]
     */
    private $paths = array();

    /**
     * The object to hold data types that can be consumed and produced by operations. These data types can be primitives, arrays or models.
     *
     * @var SchemaElementInterface[]
     */
    private $definitions = array();

    /**
     * The security scheme definitions that can be used across the specification.
     *
     * @var SecuritySchemeInterface[]
     */
    private $securityDefinitions = array();

    /**
     * Additional external documentation.
     *
     * @var ExternalDocumentation
     */
    private $externalDocumentation;

    /**
     * Constructs a new Specification instance.
     *
     * @param Info $info the metadata about the API
     */
    public function __construct(Info $info)
    {
        $this->info = $info;
    }

    /**
     * Sets the host (name or ip) serving the API.
     *
     * @param string $host the host (name or ip) serving the API. This MUST be the host only and does not include the scheme nor sub-paths. It MAY include a port.
     *
     * @return Specification
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Sets the base path on which the API is served.
     *
     * @param string $basePath the base path on which the API is served, which is relative to the host
     *
     * @return Specification
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;

        return $this;
    }

    /**
     * Sets the transfer protocol of the API.
     *
     * @param array $schemes the transfer protocol of the API. Values MUST be from the list: "http", "https", "ws", "wss".
     *
     * @return Specification
     */
    public function setSchemes(array $schemes)
    {
        $this->schemes = $schemes;

        return $this;
    }

    /**
     * Sets the list of MIME types the APIs can consume.
     *
     * @param array $consumes a list of MIME types the APIs can consume
     *
     * @return Specification
     */
    public function setConsumes(array $consumes)
    {
        $this->consumes = $consumes;

        return $this;
    }

    /**
     * Sets the list of MIME types the APIs can produce.
     *
     * @param array $produces a list of MIME types the APIs can produce
     *
     * @return Specification
     */
    public function setProduces(array $produces)
    {
        $this->produces = $produces;

        return $this;
    }

    /**
     * Adds a path endpoint to the specification.
     *
     * @param string   $path     a relative path to an individual endpoint. The field name MUST begin with a slash.
     * @param PathItem $pathItem a PathItem instance containing the operations available on the path
     *
     * @return Specification
     */
    public function setPath($path, PathItem $pathItem)
    {
        $this->paths[$path] = $pathItem;

        return $this;
    }

    /**
     * Adds a single definition.
     *
     * @param string                 $definition the name of the definition
     * @param SchemaElementInterface $schema     a single definition, mapping the "name" to the schema it defines
     *
     * @return Specification
     */
    public function setDefinition($definition, SchemaElementInterface $schema)
    {
        $this->definitions[$definition] = $schema;

        return $this;
    }

    /**
     * Adds a security scheme definition that can be used across the specification.
     *
     * @param SecuritySchemeInterface $securityScheme
     *
     * @return Specification
     */
    public function addSecurityDefinition(SecuritySchemeInterface $securityScheme)
    {
        $this->securityDefinitions[] = $securityScheme;

        return $this;
    }

    /**
     * Sets the additional external documentation.
     *
     * @param ExternalDocumentation $externalDocumentation
     *
     * @return Specification
     */
    public function setExternalDocumentation(ExternalDocumentation $externalDocumentation)
    {
        $this->externalDocumentation = $externalDocumentation;

        return $this;
    }

    /**
     * Returns the representation of this object for JSON encoding.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $specification = array();
        $specification['swagger'] = $this->swagger;
        $specification['info'] = $this->info->jsonSerialize();
        if (isset($this->host)) {
            $specification['host'] = $this->host;
        }
        if (isset($this->basePath)) {
            $specification['basePath'] = $this->basePath;
        }
        if (empty($this->schemes) === false) {
            $specification['schemes'] = $this->schemes;
        }
        if (empty($this->consumes) === false) {
            $specification['consumes'] = $this->consumes;
        }
        if (empty($this->produces) === false) {
            $specification['produces'] = $this->produces;
        }

        $specification['paths'] = array();
        foreach ($this->paths as $path => $pathItem) {
            $specification['paths'][$path] = $pathItem->jsonSerialize();
        }
        if (empty($specification['paths'])) {
            $specification['paths'] = new stdClass();
        }

        if (empty($this->definitions) === false) {
            $specification['definitions'] = array();
            foreach ($this->definitions as $definition => $schema) {
                $specification['definitions'][$definition] = $schema->jsonSerialize();
            }
        }

        if (empty($this->securityDefinitions) === false) {
            foreach ($this->securityDefinitions as $securityScheme) {
                $specification['securityDefinitions'][$securityScheme->getIdentifier()] = $securityScheme->jsonSerialize();
            }
        }

        if (isset($this->externalDocumentation)) {
            $specification['externalDocs'] = $this->externalDocumentation->jsonSerialize();
        }

        return $specification;
    }

    /**
     * Returns a new Specification instance.
     *
     * @param Info $info The metadata about the API. The metadata can be used by the clients if needed.
     *
     * @return Specification
     */
    public static function create(Info $info)
    {
        return new self($info);
    }
}
