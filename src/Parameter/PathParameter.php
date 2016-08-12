<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Parameter;

/**
 * PathParameter.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class PathParameter extends AbstractExtendedParameter
{
    /**
     * The location of the parameter.
     *
     * @var string
     */
    protected $in = 'path';

    /**
     * {@inheritdoc}
     */
    public function isRequired()
    {
        return true;
    }
}
