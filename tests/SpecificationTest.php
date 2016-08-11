<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test;

use ConnectHolland\OpenAPISpecificationGenerator\Specification;
use PHPUnit_Framework_TestCase;
use stdClass;

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
     * Tests if Specification::setPath sets the instance property and returns the Specification instance.
     */
    public function testSetPath()
    {
        $infoMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\Info')
                ->disableOriginalConstructor()
                ->getMock();

        $pathItemMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\PathItem')
                ->disableOriginalConstructor()
                ->getMock();

        $specification = new Specification($infoMock);

        $this->assertSame($specification, $specification->setPath('/path', $pathItemMock));
        $this->assertAttributeSame(array('/path' => $pathItemMock), 'paths', $specification);
    }

    /**
     * Tests if Specification::setDefinition sets the instance property and returns the Specification instance.
     */
    public function testSetDefinition()
    {
        $infoMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\Info')
                ->disableOriginalConstructor()
                ->getMock();

        $schemaElementMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->disableOriginalConstructor()
                ->getMock();

        $specification = new Specification($infoMock);

        $this->assertSame($specification, $specification->setDefinition('someObject', $schemaElementMock));
        $this->assertAttributeSame(array('someObject' => $schemaElementMock), 'definitions', $specification);
    }

    /**
     * Tests if Specification::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $infoMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\Info')
                ->disableOriginalConstructor()
                ->getMock();
        $infoMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('title' => 'API', 'version' => '1.0'));

        $specification = new Specification($infoMock);

        $expectedResult = array(
            'swagger' => '2.0',
            'info' => array(
                'title' => 'API',
                'version' => '1.0',
            ),
            'paths' => new stdClass(),
        );

        $this->assertEquals($expectedResult, $specification->jsonSerialize());
    }

    /**
     * Tests if Specification::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     *
     * @depends testJsonSerialize
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $infoMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\Info')
                ->disableOriginalConstructor()
                ->getMock();
        $infoMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('title' => 'API', 'version' => '1.0'));

        $specification = new Specification($infoMock);

        $expectedResult = '{"swagger":"2.0","info":{"title":"API","version":"1.0"},"paths":{}}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($specification));
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
