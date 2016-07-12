<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Path;

use ConnectHolland\OpenAPISpecificationGenerator\Path\Operation;
use PHPUnit_Framework_TestCase;

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
