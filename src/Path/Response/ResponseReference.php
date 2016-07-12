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
}
