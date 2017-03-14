<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Path\Response;

use JsonSerializable;

/**
 * ExampleInterface.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
interface ExampleInterface extends JsonSerializable
{
    /**
     * Returns the mimetype of the example.
     *
     * @return string
     */
    public function getMimetype();
}
