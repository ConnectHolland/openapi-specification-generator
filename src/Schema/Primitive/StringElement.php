<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive;

/**
 * StringElement.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class StringElement extends AbstractPrimitiveElement
{
    /**
     * The minimum length of the string value.
     *
     * @var int
     */
    private $minLength;

    /**
     * The maximum length of the string value.
     *
     * @var int
     */
    private $maxLength;

    /**
     * The regex validation pattern string values must match.
     *
     * @var string
     */
    private $pattern;

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'string';
    }

    /**
     * Sets the minimum length of the string value.
     *
     * @param int $minLength
     *
     * @return StringElement
     */
    public function setMinLength($minLength)
    {
        $this->minLength = $minLength;

        return $this;
    }

    /**
     * Sets the maximum length of the string value.
     *
     * @param int $maxLength
     *
     * @return StringElement
     */
    public function setMaxLength($maxLength)
    {
        $this->maxLength = $maxLength;

        return $this;
    }

    /**
     * Sets the regex validation pattern string values must match.
     *
     * @param string $pattern
     *
     * @return StringElement
     */
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $element = parent::jsonSerialize();
        if (isset($this->minLength)) {
            $element['minLength'] = $this->minLength;
        }
        if (isset($this->maxLength)) {
            $element['maxLength'] = $this->maxLength;
        }
        if (isset($this->pattern)) {
            $element['pattern'] = $this->pattern;
        }

        return $element;
    }
}
