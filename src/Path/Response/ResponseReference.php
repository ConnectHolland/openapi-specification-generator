<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Path\Response;

/**
 * ResponseReference.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class ResponseReference implements ResponseInterface
{
    /**
     * The reference string.
     *
     * @var string
     */
    private $reference;

    /**
     * Constructs a new ResponseReference instance.
     *
     * @param string $reference A reference string.
     */
    public function __construct($reference)
    {
        $this->reference = $reference;
    }

    /**
     * Returns the representation of this object for JSON encoding.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array(
            '$ref' => '#/definitions/'.$this->reference,
        );
    }

    /**
     * Returns a new ResponseReference instance.
     *
     * @param string $reference A reference string.
     *
     * @return ResponseReference
     */
    public static function create($reference)
    {
        return new self($reference);
    }
}
