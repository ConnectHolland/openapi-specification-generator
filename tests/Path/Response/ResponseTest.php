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
     * Tests if Response::addHeader adds the Header instance to the headers instance property and returns the Response instance.
     */
    public function testAddHeader()
    {
        $headerMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Response\HeaderInterface')
            ->getMock();

        $response = $this->response->addHeader($headerMock);

        $this->assertSame($this->response, $response);
        $this->assertAttributeSame(array($headerMock), 'headers', $this->response);
    }

    /**
     * Tests if Response::addExample adds the Example instance to the examples instance property and returns the Response instance.
     */
    public function testAddExample()
    {
        $exampleMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Response\ExampleInterface')
            ->getMock();

        $response = $this->response->addExample($exampleMock);

        $this->assertSame($this->response, $response);
        $this->assertAttributeSame(array($exampleMock), 'examples', $this->response);
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
     * Tests if Response::jsonSerialize returns the expected result with a header set.
     *
     * @depends testJsonSerialize
     */
    public function testJsonSerializeWithHeaders()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
            ->getMock();
        $schemaMock->expects($this->once())
            ->method('jsonSerialize')
            ->willReturn(array('type' => 'string'));

        $headerMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Response\HeaderInterface')
            ->getMock();
        $headerMock->expects($this->once())
            ->method('getName')
            ->willReturn('X-Test-Header');
        $headerMock->expects($this->once())
            ->method('jsonSerialize')
            ->willReturn(
                array(
                    'description' => 'The header description.',
                    'type' => 'string',
                )
            );

        $this->response->setSchema($schemaMock);
        $this->response->addHeader($headerMock);

        $expectedResult = array(
            'description' => 'A description.',
            'schema' => array(
                'type' => 'string',
            ),
            'headers' => array(
                'X-Test-Header' => array(
                    'description' => 'The header description.',
                    'type' => 'string',
                ),
            ),
        );

        $this->assertEquals($expectedResult, $this->response->jsonSerialize());
    }

    /**
     * Tests if Response::jsonSerialize returns the expected result with an example set.
     *
     * @depends testJsonSerialize
     */
    public function testJsonSerializeWithExamples()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
            ->getMock();
        $schemaMock->expects($this->once())
            ->method('jsonSerialize')
            ->willReturn(array('type' => 'string'));

        $exampleMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Response\ExampleInterface')
            ->getMock();
        $exampleMock->expects($this->once())
            ->method('getMimetype')
            ->willReturn('application/json');
        $exampleMock->expects($this->once())
            ->method('jsonSerialize')
            ->willReturn(
                array(
                    'foo' => 'bar',
                    'baz' => 'qux',
                )
            );

        $this->response->setSchema($schemaMock);
        $this->response->addExample($exampleMock);

        $expectedResult = array(
            'description' => 'A description.',
            'schema' => array(
                'type' => 'string',
            ),
            'examples' => array(
                'application/json' => array(
                    'foo' => 'bar',
                    'baz' => 'qux',
                ),
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
