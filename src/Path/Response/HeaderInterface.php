<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Path\Response;

use JsonSerializable;

/**
 * HeaderInterface.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
interface HeaderInterface extends JsonSerializable
{
    /**
     * Returns the name of the header.
     *
     * @return string
     */
    public function getName();
}
