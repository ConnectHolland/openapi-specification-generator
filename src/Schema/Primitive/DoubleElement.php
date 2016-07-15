<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive;

/**
 * DoubleElement.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class DoubleElement extends AbstractNumberElement
{
    /**
     * The format of the element.
     *
     * @var string
     */
    protected $format = 'double';
}
