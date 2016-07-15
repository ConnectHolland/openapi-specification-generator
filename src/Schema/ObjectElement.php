<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Schema;

/**
 * ObjectElement.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class ObjectElement extends AbstractElement
{
    /**
     * The minimum amount of properties.
     *
     * @var int
     */
    private $minProperties;

    /**
     * The maximum amount of properties.
     *
     * @var int
     */
    private $maxProperties;

    /**
     * The array with properties on the object element.
     *
     * @var array
     */
    private $properties = array();

    /**
     * The boolean indicating if additional properties are allowed.
     *
     * @var bool
     */
    private $additionalProperties = false;

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'object';
    }

    /**
     * Sets the minimum amount of properties.
     *
     * @param int $minProperties
     *
     * @return ObjectElement
     */
    public function setMinProperties($minProperties)
    {
        $this->minProperties = $minProperties;

        return $this;
    }

    /**
     * Sets the maximum amount of properties.
     *
     * @param int $maxProperties
     *
     * @return ObjectElement
     */
    public function setMaxProperties($maxProperties)
    {
        $this->maxProperties = $maxProperties;

        return $this;
    }

    /**
     * Sets the boolean indicating if additional properties are allowed.
     *
     * @param bool $additionalProperties
     *
     * @return ObjectElement
     */
    public function setAdditionalProperties($additionalProperties)
    {
        $this->additionalProperties = $additionalProperties;

        return $this;
    }

    /**
     * Adds a property to the object element.
     *
     * @param string                 $name
     * @param SchemaElementInterface $property
     *
     * @return ObjectElement
     */
    public function addProperty($name, SchemaElementInterface $property)
    {
        $this->properties[$name] = $property;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $element = parent::jsonSerialize();
        if (isset($this->minProperties)) {
            $element['minProperties'] = $this->minProperties;
        }
        if (isset($this->maxProperties)) {
            $element['maxProperties'] = $this->maxProperties;
        }
        if (empty($this->properties) === false) {
            $requiredProperties = array();

            $element['properties'] = array();
            foreach ($this->properties as $name => $property) {
                $element['properties'][$name] = $property->jsonSerialize();

                if ($property->isRequired()) {
                    $requiredProperties[] = $name;
                }
            }

            if (empty($requiredProperties) === false) {
                $element['required'] = $requiredProperties;
            }
        }

        return $element;
    }

    /**
     * Returns a new ObjectElement instance.
     *
     * @return ObjectElement
     */
    public static function create()
    {
        return new self();
    }
}
