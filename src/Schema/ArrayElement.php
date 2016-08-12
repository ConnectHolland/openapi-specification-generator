<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Schema;

/**
 * ArrayElement.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class ArrayElement extends AbstractElement
{
    /**
     * The minimum amount of items.
     *
     * @var int
     */
    private $minItems;

    /**
     * The maximum amount of items.
     *
     * @var int
     */
    private $maxItems;

    /**
     * The items on the array element.
     *
     * @var array
     */
    private $items = array();

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'array';
    }

    /**
     * Sets the minimum amount of items.
     *
     * @param int $minItems
     *
     * @return ArrayElement
     */
    public function setMinItems($minItems)
    {
        $this->minItems = $minItems;

        return $this;
    }

    /**
     * Sets the maximum amount of items.
     *
     * @param int $maxItems
     *
     * @return ArrayElement
     */
    public function setMaxItems($maxItems)
    {
        $this->maxItems = $maxItems;

        return $this;
    }

    /**
     * Adds an item to the array element.
     *
     * @param SchemaElementInterface $item
     *
     * @return ArrayElement
     */
    public function addItem(SchemaElementInterface $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $element = parent::jsonSerialize();
        if (isset($this->minItems)) {
            $element['minItems'] = $this->minItems;
        }
        if (isset($this->maxItems)) {
            $element['maxItems'] = $this->maxItems;
        }
        $element['items'] = array();
        foreach ($this->items as $item) {
            $element['items'][] = $item->jsonSerialize();
        }

        return $element;
    }

    /**
     * Returns a new ArrayElement instance.
     *
     * @return ArrayElement
     */
    public static function create()
    {
        return new self();
    }
}
