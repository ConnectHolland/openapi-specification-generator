<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Path\Response;

use ConnectHolland\OpenAPISpecificationGenerator\Path\Response\Response;
use PHPUnit_Framework_TestCase;

/**
 * ResponseTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class ResponseTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if constructing a new Response instance sets the instance properties.
     */
    public function testConstruct()
    {
        $response = new Response('A response description.');

        $this->assertAttributeSame('A response description.', 'description', $response);
    }

    /**
     * Tests if Response::setSchema sets the instance property and returns the Response instance.
     */
    public function testSetSchema()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();

        $response = new Response('');

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Path\Response\Response', $response->setSchema($schemaMock));
        $this->assertAttributeSame($schemaMock, 'schema', $response);
    }

    /**
     * Tests if Response::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();
        $schemaMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('type' => 'string'));

        $response = new Response('A description.');
        $response->setSchema($schemaMock);

        $expectedResult = array(
            'description' => 'A description.',
            'schema' => array(
                'type' => 'string',
            ),
        );

        $this->assertEquals($expectedResult, $response->jsonSerialize());
    }

    /**
     * Tests if Response::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();
        $schemaMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('type' => 'string'));

        $response = new Response('A description.');
        $response->setSchema($schemaMock);

        $expectedResult = '{"description":"A description.","schema":{"type":"string"}}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($response));
    }

    /**
     * Tests if Specification::create returns a new Specification instance and sets the instance properties.
     */
    public function testCreate()
    {
        $response = Response::create('A response description.');

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Path\Response\Response', $response);
        $this->assertAttributeSame('A response description.', 'description', $response);
    }
}
