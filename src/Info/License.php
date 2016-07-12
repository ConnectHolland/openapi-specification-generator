<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Info;

/**
 * License.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class License
{
    /**
     * The license name used for the API.
     *
     * @var string
     */
    private $name;

    /**
     * The URL to the license used for the API.
     *
     * @var string
     */
    private $url;

    /**
     * Constructs a new License instance.
     *
     * @param string $name The license name used for the API.
     * @param string $url  A URL to the license used for the API. MUST be in the format of a URL.
     */
    public function __construct($name, $url = null)
    {
        $this->name = $name;
        $this->url = $url;
    }

    /**
     * Returns a new License instance.
     *
     * @param string $name The license name used for the API.
     * @param string $url  A URL to the license used for the API. MUST be in the format of a URL.
     *
     * @return License
     */
    public static function create($name, $url = null)
    {
        return new self($name, $url);
    }
}
