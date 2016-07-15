<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive;

/**
 * DateElement.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class DateElement extends StringElement
{
    /**
     * The format of the element.
     *
     * @var string
     */
    protected $format = 'date';
}
