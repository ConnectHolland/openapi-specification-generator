<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test;

use ConnectHolland\OpenAPISpecificationGenerator\Specification;
use PHPUnit_Framework_TestCase;

/**
 * SpecificationTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class SpecificationTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if constructing a new Specification instance sets the instance properties.
     */
    public function testConstruct()
    {
        $infoMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\Info')
                ->disableOriginalConstructor()
                ->getMock();

        $specification = new Specification($infoMock);

        $this->assertAttributeSame($infoMock, 'info', $specification);
    }

    /**
     * Tests if Specification::setHost sets the instance property and returns the Specification instance.
     */
    public function testSetHost()
    {
        $infoMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\Info')
                ->disableOriginalConstructor()
                ->getMock();

        $specification = new Specification($infoMock);

        $this->assertSame($specification, $specification->setHost('api.example.com'));
        $this->assertAttributeSame('api.example.com', 'host', $specification);
    }

    /**
     * Tests if Specification::setBasePath sets the instance property and returns the Specification instance.
     */
    public function testSetBasePath()
    {
        $infoMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\Info')
                ->disableOriginalConstructor()
                ->getMock();

        $specification = new Specification($infoMock);

        $this->assertSame($specification, $specification->setBasePath('/awesome/api'));
        $this->assertAttributeSame('/awesome/api', 'basePath', $specification);
    }

    /**
     * Tests if Specification::setSchemes sets the instance property and returns the Specification instance.
     */
    public function testSetSchemes()
    {
        $infoMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\Info')
                ->disableOriginalConstructor()
                ->getMock();

        $specification = new Specification($infoMock);

        $this->assertSame($specification, $specification->setSchemes(array('https')));
        $this->assertAttributeSame(array('https'), 'schemes', $specification);
    }

    /**
     * Tests if Specification::setConsumes sets the instance property and returns the Specification instance.
     */
    public function testSetConsumes()
    {
        $infoMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\Info')
                ->disableOriginalConstructor()
                ->getMock();

        $specification = new Specification($infoMock);

        $this->assertSame($specification, $specification->setConsumes(array('application/json')));
        $this->assertAttributeSame(array('application/json'), 'consumes', $specification);
    }

    /**
     * Tests if Specification::setProduces sets the instance property and returns the Specification instance.
     */
    public function testSetProduces()
    {
        $infoMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\Info')
                ->disableOriginalConstructor()
                ->getMock();

        $specification = new Specification($infoMock);

        $this->assertSame($specification, $specification->setProduces(array('application/json')));
        $this->assertAttributeSame(array('application/json'), 'produces', $specification);
    }

    /**
     * Tests if Specification::create returns a new Specification instance and sets the instance properties.
     */
    public function testCreate()
    {
        $infoMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\Info')
                ->disableOriginalConstructor()
                ->getMock();

        $specification = Specification::create($infoMock);

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Specification', $specification);
        $this->assertAttributeSame($infoMock, 'info', $specification);
    }
}