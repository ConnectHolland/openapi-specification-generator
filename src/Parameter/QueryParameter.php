<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Parameter;

/**
 * QueryParameter.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class QueryParameter extends AbstractExtendedParameter
{
    /**
     * The location of the parameter.
     *
     * @var string
     */
    protected $in = 'query';
}
