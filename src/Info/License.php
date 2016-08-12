<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Info;

use JsonSerializable;

/**
 * License.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class License implements JsonSerializable
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
     * Returns the representation of this object for JSON encoding.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $contact = array(
            'name' => $this->name,
        );
        if (isset($this->url)) {
            $contact['url'] = $this->url;
        }

        return $contact;
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
