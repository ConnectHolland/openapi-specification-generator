<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Schema;

use JsonSerializable;

/**
 * SchemaElementInterface.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
interface SchemaElementInterface extends JsonSerializable
{
    /**
     * Returns if this element is required.
     *
     * @return bool
     */
    public function isRequired();

    /**
     * Returns the type of element.
     *
     * @return string
     */
    public function getType();
}
