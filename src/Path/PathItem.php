<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Path;

/**
 * PathItem.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class PathItem
{
    /**
     * The reference to an external definition.
     *
     * @var string
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
     * @param string $reference The reference to an external definition.
     *
     * @return PathItem
     */
    public function setReference($reference)
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
     * Returns a new Path instance.
     *
     * @return PathItem
     */
    public static function create()
    {
        return new self();
    }
}
