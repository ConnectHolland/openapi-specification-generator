<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive;

/**
 * IntegerElement.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class IntegerElement extends AbstractNumberElement
{
    /**
     * The format of the element.
     *
     * @var string
     */
    protected $format = 'int32';

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'integer';
    }
}
