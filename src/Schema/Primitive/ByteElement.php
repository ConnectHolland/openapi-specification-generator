<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive;

/**
 * ByteElement.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class ByteElement extends StringElement
{
    /**
     * The format of the element.
     *
     * @var string
     */
    protected $format = 'byte';
}
