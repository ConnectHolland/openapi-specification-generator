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
     * The Operation instance being tested.
     *
     * @var Operation
     */
    private $operation;

    /**
     * The Responses instance mock used for testing.
     *
     * @var Responses
     */
    private $responsesMock;

    /**
     * Creates a Operation for testing.
     */
    public function setUp()
    {
        parent::setUp();

        $this->responsesMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Responses')
            ->disableOriginalConstructor()
            ->getMock();

        $this->operation = new Operation($this->responsesMock);
    }

    /**
     * Tests if constructing a new Operation instance sets the instance properties.
     */
    public function testConstruct()
    {
        $this->assertAttributeSame($this->responsesMock, 'responses', $this->operation);
    }

    /**
     * Tests if Operation::setOperationId sets the instance property and returns the Operation instance.
     */
    public function testSetOperationId()
    {
        $operation = $this->operation->setOperationId('test-operation');

        $this->assertSame($this->operation, $operation);
        $this->assertAttributeSame('test-operation', 'operationId', $operation);
    }

    /**
     * Tests if Operation::setSummary sets the instance property and returns the Operation instance.
     */
    public function testSetSummary()
    {
        $operation = $this->operation->setSummary('A summary.');

        $this->assertSame($this->operation, $operation);
        $this->assertAttributeSame('A summary.', 'summary', $operation);
    }

    /**
     * Tests if Operation::setDescription sets the instance property and returns the Operation instance.
     */
    public function testSetDescription()
    {
        $operation = $this->operation->setDescription('A description.');

        $this->assertSame($this->operation, $operation);
        $this->assertAttributeSame('A description.', 'description', $operation);
    }

    /**
     * Tests if Operation::setExternalDocumentation sets the instance property and returns the Operation instance.
     */
    public function testSetExternalDocumentation()
    {
        $externalDocumentationMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\ExternalDocumentation')
            ->disableOriginalConstructor()
            ->getMock();

        $operation = $this->operation->setExternalDocumentation($externalDocumentationMock);

        $this->assertSame($this->operation, $operation);
        $this->assertAttributeSame($externalDocumentationMock, 'externalDocumentation', $operation);
    }

    /**
     * Tests if Operation::setConsumes sets the instance property and returns the Operation instance.
     */
    public function testSetConsumes()
    {
        $operation = $this->operation->setConsumes(array('application/json'));

        $this->assertSame($this->operation, $operation);
        $this->assertAttributeSame(array('application/json'), 'consumes', $operation);
    }

    /**
     * Tests if Operation::setProduces sets the instance property and returns the Operation instance.
     */
    public function testSetProduces()
    {
        $operation = $this->operation->setProduces(array('application/json'));

        $this->assertSame($this->operation, $operation);
        $this->assertAttributeSame(array('application/json'), 'produces', $operation);
    }

    /**
     * Tests if Operation::setSchemes sets the instance property and returns the Operation instance.
     */
    public function testSetSchemes()
    {
        $operation = $this->operation->setSchemes(array('https'));

        $this->assertSame($this->operation, $operation);
        $this->assertAttributeSame(array('https'), 'schemes', $operation);
    }

    /**
     * Tests if Operation::setTags sets the instance property and returns the Operation instance.
     */
    public function testSetTags()
    {
        $operation = $this->operation->setTags(array('tag'));

        $this->assertSame($this->operation, $operation);
        $this->assertAttributeSame(array('tag'), 'tags', $operation);
    }

    /**
     * Tests if Operation::setDeprecated sets the instance property and returns the Operation instance.
     */
    public function testSetDeprecated()
    {
        $operation = $this->operation->setDeprecated(true);

        $this->assertSame($this->operation, $operation);
        $this->assertAttributeSame(true, 'deprecated', $operation);
    }

    /**
     * Tests if Operation::addParameter adds a ParameterInterface to the parameters property and returns the Operation instance.
     */
    public function testAddParameter()
    {
        $parameterMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Parameter\ParameterInterface')
                ->getMock();

        $operation = $this->operation->addParameter($parameterMock);

        $this->assertSame($this->operation, $operation);
        $this->assertAttributeSame(array($parameterMock), 'parameters', $operation);
    }

    /**
     * Tests if Operation::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $this->responsesMock->expects($this->once())
            ->method('jsonSerialize')
            ->willReturn(new stdClass());

        $parameterMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Parameter\ParameterInterface')
            ->getMock();
        $parameterMock->expects($this->once())
            ->method('jsonSerialize')
            ->willReturn(array('name' => 'parameterName', 'in' => 'body', 'schema' => array('type' => 'string')));

        $externalDocumentationMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\ExternalDocumentation')
            ->disableOriginalConstructor()
            ->getMock();
        $externalDocumentationMock->expects($this->once())
            ->method('jsonSerialize')
            ->willReturn(array('url' => 'https://documentation.connectholland.nl'));

        $this->operation->setOperationId('test-operation');
        $this->operation->setSummary('A summary.');
        $this->operation->setDescription('A description.');
        $this->operation->setConsumes(array('application/json'));
        $this->operation->setProduces(array('application/json'));
        $this->operation->setSchemes(array('https'));
        $this->operation->setTags(array('tag'));
        $this->operation->setDeprecated(true);
        $this->operation->addParameter($parameterMock);
        $this->operation->setExternalDocumentation($externalDocumentationMock);

        $expectedResult = array(
            'operationId' => 'test-operation',
            'summary' => 'A summary.',
            'description' => 'A description.',
            'externalDocs' => array(
                'url' => 'https://documentation.connectholland.nl',
            ),
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

        $this->assertEquals($expectedResult, $this->operation->jsonSerialize());
    }

    /**
     * Tests if Operation::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $this->responsesMock->expects($this->once())
            ->method('jsonSerialize')
            ->willReturn(new stdClass());

        $parameterMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Parameter\ParameterInterface')
            ->getMock();
        $parameterMock->expects($this->once())
            ->method('jsonSerialize')
            ->willReturn(array('name' => 'parameterName', 'in' => 'body', 'schema' => array('type' => 'string')));

        $this->operation->setOperationId('test-operation');
        $this->operation->setSummary('A summary.');
        $this->operation->setDescription('A description.');
        $this->operation->setConsumes(array('application/json'));
        $this->operation->setProduces(array('application/json'));
        $this->operation->setSchemes(array('https'));
        $this->operation->setTags(array('tag'));
        $this->operation->setDeprecated(true);
        $this->operation->addParameter($parameterMock);

        $expectedResult = '{"operationId":"test-operation","summary":"A summary.","description":"A description.","consumes":["application\/json"],"produces":["application\/json"],"parameters":[{"name":"parameterName","in":"body","schema":{"type":"string"}}],"responses":{},"schemes":["https"],"deprecated":true,"tags":["tag"]}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($this->operation));
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
