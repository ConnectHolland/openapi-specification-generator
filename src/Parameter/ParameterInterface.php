<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Parameter;

use JsonSerializable;

/**
 * ParameterInterface.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
interface ParameterInterface extends JsonSerializable
{
    /**
     * Returns true if this parameter is required.
     *
     * @return bool
     */
    public function isRequired();
}
