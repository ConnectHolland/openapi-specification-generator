<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Path;

use ConnectHolland\OpenAPISpecificationGenerator\Path\Response\ResponseInterface;
use ConnectHolland\OpenAPISpecificationGenerator\Path\Responses;
use PHPUnit_Framework_TestCase;

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
                ->disableOriginalConstructor()
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
                ->disableOriginalConstructor()
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
                ->disableOriginalConstructor()
                ->getMock();

        $responses = new Responses();

        $this->setExpectedException('InvalidArgumentException', 'Invalid HTTP status code "600" supplied.');

        $responses->setResponse(600, $responseMock);
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
