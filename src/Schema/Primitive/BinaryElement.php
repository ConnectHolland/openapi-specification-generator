<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive;

/**
 * BinaryElement.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class BinaryElement extends StringElement
{
    /**
     * The format of the element.
     *
     * @var string
     */
    protected $format = 'binary';
}
