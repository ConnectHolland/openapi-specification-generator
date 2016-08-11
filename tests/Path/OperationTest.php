<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Path;

use ConnectHolland\OpenAPISpecificationGenerator\Path\Operation;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * OperationTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class OperationTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if constructing a new Operation instance sets the instance properties.
     */
    public function testConstruct()
    {
        $responsesMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Responses')
                ->disableOriginalConstructor()
                ->getMock();

        $operation = new Operation($responsesMock);

        $this->assertAttributeSame($responsesMock, 'responses', $operation);
    }

    /**
     * Tests if Operation::setOperationId sets the instance property and returns the Operation instance.
     */
    public function testSetOperationId()
    {
        $responsesMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Responses')
                ->disableOriginalConstructor()
                ->getMock();

        $operation = new Operation($responsesMock);

        $this->assertSame($operation, $operation->setOperationId('test-operation'));
        $this->assertAttributeSame('test-operation', 'operationId', $operation);
    }

    /**
     * Tests if Operation::setSummary sets the instance property and returns the Operation instance.
     */
    public function testSetSummary()
    {
        $responsesMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Responses')
                ->disableOriginalConstructor()
                ->getMock();

        $operation = new Operation($responsesMock);

        $this->assertSame($operation, $operation->setSummary('A summary.'));
        $this->assertAttributeSame('A summary.', 'summary', $operation);
    }

    /**
     * Tests if Operation::setDescription sets the instance property and returns the Operation instance.
     */
    public function testSetDescription()
    {
        $responsesMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Responses')
                ->disableOriginalConstructor()
                ->getMock();

        $operation = new Operation($responsesMock);

        $this->assertSame($operation, $operation->setDescription('A description.'));
        $this->assertAttributeSame('A description.', 'description', $operation);
    }

    /**
     * Tests if Operation::setConsumes sets the instance property and returns the Operation instance.
     */
    public function testSetConsumes()
    {
        $responsesMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Responses')
                ->disableOriginalConstructor()
                ->getMock();

        $operation = new Operation($responsesMock);

        $this->assertSame($operation, $operation->setConsumes(array('application/json')));
        $this->assertAttributeSame(array('application/json'), 'consumes', $operation);
    }

    /**
     * Tests if Operation::setProduces sets the instance property and returns the Operation instance.
     */
    public function testSetProduces()
    {
        $responsesMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Responses')
                ->disableOriginalConstructor()
                ->getMock();

        $operation = new Operation($responsesMock);

        $this->assertSame($operation, $operation->setProduces(array('application/json')));
        $this->assertAttributeSame(array('application/json'), 'produces', $operation);
    }

    /**
     * Tests if Operation::setSchemes sets the instance property and returns the Operation instance.
     */
    public function testSetSchemes()
    {
        $responsesMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Responses')
                ->disableOriginalConstructor()
                ->getMock();

        $operation = new Operation($responsesMock);

        $this->assertSame($operation, $operation->setSchemes(array('https')));
        $this->assertAttributeSame(array('https'), 'schemes', $operation);
    }

    /**
     * Tests if Operation::setTags sets the instance property and returns the Operation instance.
     */
    public function testSetTags()
    {
        $responsesMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Responses')
                ->disableOriginalConstructor()
                ->getMock();

        $operation = new Operation($responsesMock);

        $this->assertSame($operation, $operation->setTags(array('tag')));
        $this->assertAttributeSame(array('tag'), 'tags', $operation);
    }

    /**
     * Tests if Operation::setDeprecated sets the instance property and returns the Operation instance.
     */
    public function testSetDeprecated()
    {
        $responsesMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Responses')
                ->disableOriginalConstructor()
                ->getMock();

        $operation = new Operation($responsesMock);

        $this->assertSame($operation, $operation->setDeprecated(true));
        $this->assertAttributeSame(true, 'deprecated', $operation);
    }

    /**
     * Tests if Operation::addParameter adds a ParameterInterface to the parameters property and returns the Operation instance.
     */
    public function testAddParameter()
    {
        $responsesMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Responses')
                ->disableOriginalConstructor()
                ->getMock();

        $parameterMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Parameter\ParameterInterface')
                ->getMock();

        $operation = new Operation($responsesMock);

        $this->assertSame($operation, $operation->addParameter($parameterMock));
        $this->assertAttributeSame(array($parameterMock), 'parameters', $operation);
    }

    /**
     * Tests if Operation::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $responsesMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Responses')
                ->disableOriginalConstructor()
                ->getMock();
        $responsesMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(new stdClass());

        $parameterMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Parameter\ParameterInterface')
                ->getMock();
        $parameterMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('name' => 'parameterName', 'in' => 'body', 'schema' => array('type' => 'string')));

        $operation = new Operation($responsesMock);
        $operation->setOperationId('test-operation');
        $operation->setSummary('A summary.');
        $operation->setDescription('A description.');
        $operation->setConsumes(array('application/json'));
        $operation->setProduces(array('application/json'));
        $operation->setSchemes(array('https'));
        $operation->setTags(array('tag'));
        $operation->setDeprecated(true);
        $operation->addParameter($parameterMock);

        $expectedResult = array(
            'operationId' => 'test-operation',
            'summary' => 'A summary.',
            'description' => 'A description.',
            'consumes' => array('application/json'),
            'produces' => array('application/json'),
            'parameters' => array(
                array(
                    'name' => 'parameterName',
                    'in' => 'body',
                    'schema' => array(
                        'type' => 'string',
                    ),
                ),
            ),
            'responses' => new stdClass(),
            'schemes' => array('https'),
            'deprecated' => true,
            'tags' => array('tag'),
        );

        $this->assertEquals($expectedResult, $operation->jsonSerialize());
    }

    /**
     * Tests if Operation::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $responsesMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Responses')
                ->disableOriginalConstructor()
                ->getMock();
        $responsesMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(new stdClass());

        $parameterMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Parameter\ParameterInterface')
                ->getMock();
        $parameterMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('name' => 'parameterName', 'in' => 'body', 'schema' => array('type' => 'string')));

        $operation = new Operation($responsesMock);
        $operation->setOperationId('test-operation');
        $operation->setSummary('A summary.');
        $operation->setDescription('A description.');
        $operation->setConsumes(array('application/json'));
        $operation->setProduces(array('application/json'));
        $operation->setSchemes(array('https'));
        $operation->setTags(array('tag'));
        $operation->setDeprecated(true);
        $operation->addParameter($parameterMock);

        $expectedResult = '{"operationId":"test-operation","summary":"A summary.","description":"A description.","consumes":["application\/json"],"produces":["application\/json"],"parameters":[{"name":"parameterName","in":"body","schema":{"type":"string"}}],"responses":{},"schemes":["https"],"deprecated":true,"tags":["tag"]}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($operation));
    }

    /**
     * Tests if Operation::create returns a new Operation instance and sets the instance properties.
     */
    public function testCreate()
    {
        $responsesMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Responses')
                ->disableOriginalConstructor()
                ->getMock();

        $operation = Operation::create($responsesMock);

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Path\Operation', $operation);
        $this->assertAttributeSame($responsesMock, 'responses', $operation);
    }
}
