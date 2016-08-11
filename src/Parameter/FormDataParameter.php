<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Parameter;

/**
 * FormDataParameter.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class FormDataParameter extends AbstractExtendedParameter
{
    /**
     * The location of the parameter.
     *
     * @var string
     */
    protected $in = 'formData';
}
