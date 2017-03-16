<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Security;

use JsonSerializable;

/**
 * SecurityRequirement.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class SecurityRequirement implements JsonSerializable
{
    /**
     * The identifier name of the related security scheme.
     *
     * @var string
     */
    private $identifier;

    /**
     * The scopes required for the execution.
     *
     * @var Scopes
     */
    private $scopes;

    /**
     * Constructs a new SecurityRequirement instance.
     *
     * @param SecuritySchemeInterface|string $identifierOrScheme the related identifier of the security scheme or the security scheme
     */
    public function __construct($identifierOrScheme)
    {
        if ($identifierOrScheme instanceof SecuritySchemeInterface) {
            $identifierOrScheme = $identifierOrScheme->getIdentifier();
        }

        $this->identifier = $identifierOrScheme;
    }

    /**
     * Returns the identifier name of the related security scheme.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Sets the scopes required for the execution.
     *
     * @param Scopes $scopes
     *
     * @return SecurityRequirement
     */
    public function setScopes(Scopes $scopes)
    {
        $this->scopes = $scopes;

        return $this;
    }

    /**
     * Returns the representation of this object for JSON encoding.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $securityRequirement = array(
            $this->identifier => array(),
        );
        if (isset($this->scopes)) {
            $securityRequirement[$this->identifier] = $this->scopes->getNames();
        }

        return $securityRequirement;
    }

    /**
     * Returns a new SecurityRequirement instance.
     *
     * @param SecuritySchemeInterface|string $identifierOrScheme
     *
     * @return SecurityRequirement
     */
    public static function create($identifierOrScheme)
    {
        return new self($identifierOrScheme);
    }
}
