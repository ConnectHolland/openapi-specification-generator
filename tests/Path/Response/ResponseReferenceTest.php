<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Path\Response;

use ConnectHolland\OpenAPISpecificationGenerator\Path\Response\ResponseReference;
use PHPUnit_Framework_TestCase;

/**
 * ResponseReference.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class ResponseReferenceTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if constructing a new ResponseReference instance sets the instance properties.
     */
    public function testConstruct()
    {
        $responseReference = new ResponseReference('test-reference');

        $this->assertAttributeSame('test-reference', 'reference', $responseReference);
    }
}
