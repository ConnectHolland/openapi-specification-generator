<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Path\Response;

use InvalidArgumentException;

/**
 * Example.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class Example implements ExampleInterface
{
    /**
     * The mimetype of the example response.
     *
     * @var string
     */
    private $mimetype;

    /**
     * The contents of the example.
     *
     * @var array|bool|float|int|string
     */
    private $contents;

    /**
     * Constructs an Example instance.
     *
     * @param string                      $mimetype
     * @param array|bool|float|int|string $contents
     */
    public function __construct($mimetype, $contents)
    {
        if (is_scalar($contents) === false && is_array($contents) === false) {
            throw new InvalidArgumentException('Supplied example contents is not of type array, bool, float, int or string.');
        }

        $this->mimetype = $mimetype;
        $this->contents = $contents;
    }

    /**
     * {@inheritdoc}
     */
    public function getMimetype()
    {
        return $this->mimetype;
    }

    /**
     * Returns the representation of this object for JSON encoding.
     *
     * @return array|bool|float|int|string
     */
    public function jsonSerialize()
    {
        return $this->contents;
    }
}
