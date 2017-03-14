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
     * The Response instance being tested.
     *
     * @var Response
     */
    private $response;

    /**
     * Creates a Response instance for testing.
     */
    public function setUp()
    {
        parent::setUp();

        $this->response = new Response('A description.');
    }

    /**
     * Tests if constructing a new Response instance sets the instance properties.
     */
    public function testConstruct()
    {
        $this->assertAttributeSame('A description.', 'description', $this->response);
    }

    /**
     * Tests if Response::setSchema sets the instance property and returns the Response instance.
     */
    public function testSetSchema()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
            ->getMock();

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Path\Response\Response', $this->response->setSchema($schemaMock));
        $this->assertAttributeSame($schemaMock, 'schema', $this->response);
    }

    /**
     * Tests if Response::jsonSerialize returns the expected result.
     *
     * @depends testSetSchema
     */
    public function testJsonSerialize()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
            ->getMock();
        $schemaMock->expects($this->once())
            ->method('jsonSerialize')
            ->willReturn(array('type' => 'string'));

        $this->response->setSchema($schemaMock);

        $expectedResult = array(
            'description' => 'A description.',
            'schema' => array(
                'type' => 'string',
            ),
        );

        $this->assertEquals($expectedResult, $this->response->jsonSerialize());
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

        $this->response->setSchema($schemaMock);

        $expectedResult = '{"description":"A description.","schema":{"type":"string"}}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($this->response));
    }

    /**
     * Tests if Response::create returns a new Response instance and sets the instance properties.
     */
    public function testCreate()
    {
        $response = Response::create('A description.');

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Path\Response\Response', $response);
        $this->assertAttributeSame('A description.', 'description', $response);
    }
}
