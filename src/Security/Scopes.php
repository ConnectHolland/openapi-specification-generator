<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Security;

use JsonSerializable;
use stdClass;

/**
 * Scopes.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class Scopes implements JsonSerializable
{
    /**
     * A list of scopes with a short description.
     *
     * @var array
     */
    private $scopes = array();

    /**
     * Returns the names of the scopes.
     */
    public function getNames()
    {
        return array_keys($this->scopes);
    }

    /**
     * Adds a scope.
     *
     * @param string $name        the name of the scope
     * @param string $description a short description of the scope
     *
     * @return Scopes
     */
    public function addScope($name, $description)
    {
        $this->scopes[$name] = $description;

        return $this;
    }

    /**
     * Returns the representation of this object for JSON encoding.
     *
     * @return array|stdClass
     */
    public function jsonSerialize()
    {
        if (empty($this->scopes)) {
            return new stdClass();
        }

        return $this->scopes;
    }
}
