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

    /**
     * Tests if ResponseReference::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $responseReference = new ResponseReference('test-reference');

        $expectedResult = array(
            '$ref' => '#/definitions/test-reference',
        );

        $this->assertEquals($expectedResult, $responseReference->jsonSerialize());
    }

    /**
     * Tests if ResponseReference::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $responseReference = new ResponseReference('test-reference');

        $expectedResult = '{"$ref":"#\/definitions\/test-reference"}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($responseReference));
    }

    /**
     * Tests if ResponseReference::create returns a new ResponseReference instance and sets the instance properties.
     */
    public function testCreate()
    {
        $responseReference = ResponseReference::create('test-reference');

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Path\Response\ResponseReference', $responseReference);
        $this->assertAttributeSame('test-reference', 'reference', $responseReference);
    }
}
