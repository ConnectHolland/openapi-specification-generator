<?php

namespace ConnectHolland\OpenAPISpecificationGenerator;

use ConnectHolland\OpenAPISpecificationGenerator\Info\Info;
use ConnectHolland\OpenAPISpecificationGenerator\Path\PathItem;
use ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface;

/**
 * Specification.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class Specification
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
     * Constructs a new Specification instance.
     *
     * @param Info $info The metadata about the API.
     */
    public function __construct(Info $info)
    {
        $this->info = $info;
    }

    /**
     * Sets the host (name or ip) serving the API.
     *
     * @param string $host The host (name or ip) serving the API. This MUST be the host only and does not include the scheme nor sub-paths. It MAY include a port.
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
     * @param string $basePath The base path on which the API is served, which is relative to the host.
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
     * @param array $schemes The transfer protocol of the API. Values MUST be from the list: "http", "https", "ws", "wss".
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
     * @param array $consumes A list of MIME types the APIs can consume.
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
     * @param array $produces A list of MIME types the APIs can produce.
     *
     * @return Specification
     */
    public function setProduces(array $produces)
    {
        $this->produces = $produces;

        return $this;
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
