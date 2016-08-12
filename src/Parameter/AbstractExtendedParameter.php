<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Parameter;

use InvalidArgumentException;

/**
 * AbstractExtendedParameter.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
abstract class AbstractExtendedParameter extends AbstractParameter
{
    /**
     * The boolean indicating the ability to pass empty-valued parameters.
     *
     * @var bool
     */
    private $allowEmptyValue = false;

    /**
     * The format of the array if type array is used.
     *
     * @var string
     */
    private $collectionFormat = 'csv';

    /**
     * Sets the ability to pass empty-valued parameters.
     *
     * @param bool $allowEmptyValue
     *
     * @return self
     */
    public function setAllowEmptyValue($allowEmptyValue)
    {
        $this->allowEmptyValue = $allowEmptyValue;

        return $this;
    }

    /**
     * Sets the format of the array if type array is used.
     *
     * Possible values are:
     * - csv - comma separated values foo,bar.
     * - ssv - space separated values foo bar.
     * - tsv - tab separated values foo\tbar.
     * - pipes - pipe separated values foo|bar.
     * - multi - corresponds to multiple parameter instances instead of multiple values for a single instance foo=bar&foo=baz. This is valid only for parameters in "query" or "formData".
     *
     * @param string $collectionFormat
     *
     * @return self
     *
     * @throws InvalidArgumentException when an invalid collection format is supplied.
     */
    public function setCollectionFormat($collectionFormat)
    {
        if (in_array($collectionFormat, array('csv', 'ssv', 'tsv', 'pipes', 'multi')) === false) {
            throw new InvalidArgumentException(sprintf('The supplied collection format "%s" is invalid.', $collectionFormat));
        }

        $this->collectionFormat = $collectionFormat;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $parameter = parent::jsonSerialize();
        $parameter = array_merge($parameter, $this->schema->jsonSerialize());
        if (isset($parameter['items'])) {
            $parameter['items'] = current($parameter['items']);
        }
        if ($this->allowEmptyValue === true) {
            $parameter['allowEmptyValue'] = true;
        }
        if ($this->schema->getType() === 'array') {
            $parameter['collectionFormat'] = $this->collectionFormat;
        }

        return $parameter;
    }
}
