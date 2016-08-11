<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Parameter;

/**
 * BodyParameter.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class BodyParameter extends AbstractParameter
{
    /**
     * The location of the parameter.
     *
     * @var string
     */
    protected $in = 'body';

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $parameter = parent::jsonSerialize();
        $parameter['schema'] = $this->schema->jsonSerialize();

        return $parameter;
    }
}
