<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive;

/**
 * DateTimeElement.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class DateTimeElement extends StringElement
{
    /**
     * The format of the element.
     *
     * @var string
     */
    protected $format = 'date-time';
}
