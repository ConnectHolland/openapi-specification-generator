<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Path;

use ConnectHolland\OpenAPISpecificationGenerator\Path\Response\ResponseInterface;
use ConnectHolland\OpenAPISpecificationGenerator\Path\Responses;
use ConnectHolland\OpenAPISpecificationGenerator\Specification;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * ResponsesTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class ResponsesTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if Responses::setDefault sets the instance property and returns the Responses instance.
     */
    public function testSetDefault()
    {
        $responseMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Response\ResponseInterface')
                ->getMock();

        $responses = new Responses();

        $this->assertSame($responses, $responses->setDefault($responseMock));
        $this->assertAttributeSame(array('default' => $responseMock), 'responses', $responses);
    }

    /**
     * Tests if Responses::setResponse sets the instance property and returns the Responses instance.
     */
    public function testSetResponse()
    {
        $responseMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Response\ResponseInterface')
                ->getMock();

        $responses = new Responses();

        $this->assertSame($responses, $responses->setResponse(ResponseInterface::HTTP_OK, $responseMock));
        $this->assertAttributeSame(array(ResponseInterface::HTTP_OK => $responseMock), 'responses', $responses);
    }

    /**
     * Tests if Responses::setResponse throws an invalid argument exception on an invalid HTTP status code.
     */
    public function testSetResponseThrowInvalidArgumentExceptionOnInvalidHTTPStatusCode()
    {
        $responseMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Response\ResponseInterface')
                ->getMock();

        $responses = new Responses();

        $this->setExpectedException('InvalidArgumentException', 'Invalid HTTP status code "600" supplied.');

        $responses->setResponse(600, $responseMock);
    }

    /**
     * Tests if Responses::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $responseMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Response\ResponseInterface')
                ->getMock();
        $responseMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('description' => 'A description.'));

        $responses = new Responses();
        $responses->setDefault($responseMock);

        $expectedResult = array(
            'default' => array(
                'description' => 'A description.',
            ),
        );

        $this->assertEquals($expectedResult, $responses->jsonSerialize());
    }

    /**
     * Tests if Responses::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $responseMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Response\ResponseInterface')
                ->getMock();
        $responseMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('description' => 'A description.'));

        $responses = new Responses();
        $responses->setDefault($responseMock);

        $expectedResult = '{"default":{"description":"A description."}}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($responses));
    }

    /**
     * Tests if Responses::jsonSerialize returns the expected JSON encoded result through the json_encode function with empty properties.
     */
    public function testJsonSerializeThroughJsonEncodeWithEmptyProperties()
    {
        $responses = new Responses();

        $this->assertJsonStringEqualsJsonString('{}', json_encode($responses));
    }

    /**
     * Tests if Responses::create returns a new Responses instance.
     */
    public function testCreate()
    {
        $responses = Responses::create();

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Path\Responses', $responses);
    }
}
