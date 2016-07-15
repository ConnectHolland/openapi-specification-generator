<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive;

/**
 * FloatElement.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class FloatElement extends AbstractNumberElement
{
    /**
     * The format of the element.
     *
     * @var string
     */
    protected $format = 'float';
}
