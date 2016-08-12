<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Schema;

/**
 * AbstractElement.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
abstract class AbstractElement implements SchemaElementInterface
{
    /**
     * The id of the element.
     *
     * @var string
     */
    protected $id;

    /**
     * The title of the element.
     *
     * @var string
     */
    protected $title;

    /**
     * The description of the element.
     *
     * @var string
     */
    protected $description;

    /**
     * The reference to a validation schema.
     *
     * @var string
     */
    protected $schema;

    /**
     * The default value of the element.
     *
     * @var mixed
     */
    protected $default;

    /**
     * The array with possible values.
     *
     * @var array
     */
    protected $enum = array();

    /**
     * The boolean indicating if this element is required.
     *
     * @var bool
     */
    protected $required = false;

    /**
     * Returns if this element is required.
     *
     * @return bool
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * Sets the id of the schema.
     *
     * @param string $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Sets the title of the schema.
     *
     * @param string $title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Sets the description of the schema.
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Sets the reference to a validation schema.
     *
     * @param string $schema
     *
     * @return self
     */
    public function setSchema($schema)
    {
        $this->schema = $schema;

        return $this;
    }

    /**
     * Sets the default value.
     *
     * @param mixed $default
     *
     * @return self
     */
    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
    }

    /**
     * Sets the array with possible values.
     *
     * @param array $enum
     *
     * @return self
     */
    public function setEnum(array $enum)
    {
        $this->enum = $enum;

        return $this;
    }

    /**
     * Sets if this element is required.
     *
     * @param bool $required
     *
     * @return self
     */
    public function setRequired($required)
    {
        $this->required = $required;

        return $this;
    }

    /**
     * Returns the representation of this object for JSON encoding.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $type = $this->getType();

        $element = array();
        if (empty($type) === false) {
            $element['type'] = $type;
        }
        if (isset($this->schema)) {
            $element['$schema'] = $this->schema;
        }
        if (isset($this->id)) {
            $element['id'] = $this->id;
        }
        if (isset($this->title)) {
            $element['title'] = $this->title;
        }
        if (isset($this->description)) {
            $element['description'] = $this->description;
        }
        if (empty($this->enum) === false) {
            $element['enum'] = $this->enum;
        }
        if (isset($this->default)) {
            $element['default'] = $this->default;
        }

        return $element;
    }
}
