<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive;

use ConnectHolland\OpenAPISpecificationGenerator\Schema\AbstractElement;

/**
 * AbstractPrimitiveElement.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
abstract class AbstractPrimitiveElement extends AbstractElement
{
    /**
     * The format of the element.
     *
     * @var string
     */
    protected $format;

    /**
     * Sets the format of the element.
     *
     * @param string $format
     *
     * @return static
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $element = parent::jsonSerialize();
        if (isset($this->format)) {
            $element['format'] = $this->format;
        }

        return $element;
    }

    /**
     * Returns a new instance.
     *
     * @return self
     */
    public static function create()
    {
        return new static();
    }
}
