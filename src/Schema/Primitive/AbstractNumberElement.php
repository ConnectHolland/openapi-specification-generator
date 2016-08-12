<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive;

/**
 * AbstractNumberElement.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
abstract class AbstractNumberElement extends AbstractPrimitiveElement
{
    /**
     * The minimum value.
     *
     * @var int
     */
    protected $minimum;

    /**
     * The maximum value.
     *
     * @var int
     */
    protected $maximum;

    /**
     * The boolean indicating if the value is stricty greater than the value of "minimum".
     *
     * @var bool
     */
    protected $exclusiveMinimum = false;

    /**
     * The boolean indicating if the value is stricty lower than the value of "maximum".
     *
     * @var bool
     */
    protected $exclusiveMaximum = false;

    /**
     * The division value a value of this element is divised by and must result in an integer.
     *
     * @var int|float
     */
    protected $multipleOf;

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'number';
    }

    /**
     * Sets the minimum value.
     *
     * @param int $minimum
     *
     * @return self
     */
    public function setMinimum($minimum)
    {
        $this->minimum = $minimum;

        return $this;
    }

    /**
     * Sets the maximum value.
     *
     * @param int $maximum
     *
     * @return self
     */
    public function setMaximum($maximum)
    {
        $this->maximum = $maximum;

        return $this;
    }

    /**
     * Sets if the value is stricty greater than the value of "minimum".
     *
     * @param bool $exclusiveMinimum
     *
     * @return self
     */
    public function setExclusiveMinimum($exclusiveMinimum)
    {
        $this->exclusiveMinimum = $exclusiveMinimum;

        return $this;
    }

    /**
     * Sets if the value is stricty lower than the value of "maximum".
     *
     * @param bool $exclusiveMaximum
     *
     * @return self
     */
    public function setExclusiveMaximum($exclusiveMaximum)
    {
        $this->exclusiveMaximum = $exclusiveMaximum;

        return $this;
    }

    /**
     * Sets the division value a value of this element is divised by and must result in an integer.
     *
     * @param int|float $multipleOf
     *
     * @return self
     */
    public function setMultipleOf($multipleOf)
    {
        $this->multipleOf = $multipleOf;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $element = parent::jsonSerialize();
        if (isset($this->minimum)) {
            $element['minimum'] = $this->minimum;
        }
        if (isset($this->maximum)) {
            $element['maximum'] = $this->maximum;
        }
        if ($this->exclusiveMinimum === true) {
            $element['exclusiveMinimum'] = true;
        }
        if ($this->exclusiveMaximum === true) {
            $element['exclusiveMaximum'] = true;
        }
        if (isset($this->multipleOf)) {
            $element['multipleOf'] = $this->multipleOf;
        }

        return $element;
    }
}
