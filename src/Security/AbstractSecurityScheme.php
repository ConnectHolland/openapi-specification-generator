<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Security;

/**
 * AbstractSecurityScheme.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
abstract class AbstractSecurityScheme implements SecuritySchemeInterface
{
    /**
     * The identifier name for the security scheme.
     *
     * @var string
     */
    private $identifier;

    /**
     * The type of the security scheme.
     *
     * @var string
     */
    private $type;

    /**
     * The short description for security scheme.
     *
     * @var string
     */
    private $description;

    /**
     * Constructs a new security scheme instance.
     *
     * @param string $identifier the identifier name for the security scheme
     * @param string $type       the type of the security scheme. Valid values are "basic", "apiKey" or "oauth2".
     */
    public function __construct($identifier, $type)
    {
        $this->identifier = $identifier;
        $this->type = $type;
    }

    /**
     * Returns the identifier name for the security scheme.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Sets a short description for the security scheme.
     *
     * @param string $description
     *
     * @return static
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Returns the representation of this object for JSON encoding.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $securityScheme = array(
            'type' => $this->type,
        );

        if (isset($this->description)) {
            $securityScheme['description'] = $this->description;
        }

        return $securityScheme;
    }
}
