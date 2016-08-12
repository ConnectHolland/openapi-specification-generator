<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Parameter;

/**
 * HeaderParameter.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class HeaderParameter extends AbstractExtendedParameter
{
    /**
     * The location of the parameter.
     *
     * @var string
     */
    protected $in = 'header';
}
