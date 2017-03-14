<?php

namespace ConnectHolland\OpenAPISpecificationGenerator;

use JsonSerializable;

/**
 * ExternalDocumentation.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class ExternalDocumentation implements JsonSerializable
{
    /**
     * The URL for the target documentation.
     *
     * @var string
     */
    private $url;

    /**
     * The description of the target documentation.
     *
     * @var string
     */
    private $description;

    /**
     * Constructs a new ExternalDocumentation instance.
     *
     * @param string $url         the URL for the target documentation
     * @param string $description a short description of the target documentation
     */
    public function __construct($url, $description = null)
    {
        $this->url = $url;
        $this->description = $description;
    }

    /**
     * Returns the representation of this object for JSON encoding.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $externalDocumentation = array(
            'url' => $this->url,
        );
        if (isset($this->description)) {
            $externalDocumentation['description'] = $this->description;
        }

        return $externalDocumentation;
    }
}
