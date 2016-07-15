<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive;

/**
 * BooleanElement.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class BooleanElement extends AbstractPrimitiveElement
{
    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'boolean';
    }
}
