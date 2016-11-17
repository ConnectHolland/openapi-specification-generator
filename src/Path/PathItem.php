<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Path;

use ConnectHolland\OpenAPISpecificationGenerator\Schema\ReferenceElement;
use JsonSerializable;
use stdClass;

/**
 * PathItem.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class PathItem implements JsonSerializable
{
    /**
     * The reference to an external definition.
     *
     * @var ReferenceElement
     */
    private $reference;

    /**
     * The definition of a GET operation on this path.
     *
     * @var Operation
     */
    private $get;

    /**
     * The definition of a PUT operation on this path.
     *
     * @var Operation
     */
    private $put;

    /**
     * The definition of a POST operation on this path.
     *
     * @var Operation
     */
    private $post;

    /**
     * The definition of a DELETE operation on this path.
     *
     * @var Operation
     */
    private $delete;

    /**
     * The definition of a OPTIONS operation on this path.
     *
     * @var Operation
     */
    private $options;

    /**
     * The definition of a HEAD operation on this path.
     *
     * @var Operation
     */
    private $head;

    /**
     * The definition of a PATCH operation on this path.
     *
     * @var Operation
     */
    private $patch;

    /**
     * The list of parameters that are applicable for all the operations described under this path.
     *
     * @var array
     */
    private $parameters = array();

    /**
     * Sets a reference to an external definition.
     *
     * @param ReferenceElement $reference The reference to an external definition.
     *
     * @return PathItem
     */
    public function setReference(ReferenceElement $reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Sets the definition of a GET operation on this path.
     *
     * @param Operation $operation A definition of a GET operation on this path.
     *
     * @return PathItem
     */
    public function setGet(Operation $operation)
    {
        $this->get = $operation;

        return $this;
    }

    /**
     * Sets the definition of a PUT operation on this path.
     *
     * @param Operation $operation A definition of a PUT operation on this path.
     *
     * @return PathItem
     */
    public function setPut(Operation $operation)
    {
        $this->put = $operation;

        return $this;
    }

    /**
     * Sets the definition of a POST operation on this path.
     *
     * @param Operation $operation A definition of a POST operation on this path.
     *
     * @return PathItem
     */
    public function setPost(Operation $operation)
    {
        $this->post = $operation;

        return $this;
    }

    /**
     * Sets the definition of a DELETE operation on this path.
     *
     * @param Operation $operation A definition of a DELETE operation on this path.
     *
     * @return PathItem
     */
    public function setDelete(Operation $operation)
    {
        $this->delete = $operation;

        return $this;
    }

    /**
     * Sets the definition of a OPTIONS operation on this path.
     *
     * @param Operation $operation A definition of a OPTIONS operation on this path.
     *
     * @return PathItem
     */
    public function setOptions(Operation $operation)
    {
        $this->options = $operation;

        return $this;
    }

    /**
     * Sets the definition of a HEAD operation on this path.
     *
     * @param Operation $operation A definition of a HEAD operation on this path.
     *
     * @return PathItem
     */
    public function setHead(Operation $operation)
    {
        $this->head = $operation;

        return $this;
    }

    /**
     * Sets the definition of a PATCH operation on this path.
     *
     * @param Operation $operation A definition of a PATCH operation on this path.
     *
     * @return PathItem
     */
    public function setPatch(Operation $operation)
    {
        $this->patch = $operation;

        return $this;
    }

    /**
     * Sets the parameters.
     *
     * @param array $parameters A list of parameters that are applicable for all the operations described under this path.
     *
     * @return PathItem
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * Returns the representation of this object for JSON encoding.
     *
     * @return array|stdClass
     */
    public function jsonSerialize()
    {
        $pathItem = array();
        if ($this->reference instanceof ReferenceElement) {
            $pathItem = $this->reference->jsonSerialize();
        }

        $operations = array('get', 'put', 'post', 'delete', 'options', 'head', 'patch');
        foreach ($operations as $operation) {
            if (isset($this->$operation)) {
                $pathItem[$operation] = $this->$operation->jsonSerialize();
            }
        }

        if (empty($this->parameters) === false) {
            $pathItem['parameters'] = array();
            foreach ($this->parameters as $parameter) {
                $pathItem['parameters'][] = $parameter->jsonSerialize();
            }
        }

        if (empty($pathItem)) {
            $pathItem = new stdClass();
        }

        return $pathItem;
    }

    /**
     * Returns a new Path instance.
     *
     * @return PathItem
     */
    public static function create()
    {
        return new self();
    }
}
