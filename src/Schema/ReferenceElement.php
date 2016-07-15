<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Schema;

/**
 * ReferenceElement.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class ReferenceElement extends AbstractElement
{
    /**
     * The reference identifier.
     *
     * @var string
     */
    private $reference;

    /**
     * Constructs a new ReferenceElement instance.
     *
     * @param string $reference
     */
    public function __construct($reference)
    {
        $this->reference = $reference;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $element = parent::jsonSerialize();
        $element['$ref'] = '#/definitions/'.$this->reference;

        return $element;
    }

    /**
     * Returns a new ReferenceElement instance.
     *
     * @param string $reference
     *
     * @return ReferenceElement
     */
    public static function create($reference)
    {
        return new self($reference);
    }
}
