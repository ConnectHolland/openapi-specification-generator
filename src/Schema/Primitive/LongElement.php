<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive;

/**
 * LongElement.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class LongElement extends AbstractNumberElement
{
    /**
     * The format of the element.
     *
     * @var string
     */
    protected $format = 'int64';

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'integer';
    }
}
