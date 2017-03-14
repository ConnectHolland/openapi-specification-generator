<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Path\Response;

use ConnectHolland\OpenAPISpecificationGenerator\Path\Response\Header;
use ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface;
use PHPUnit_Framework_TestCase;

/**
 * HeaderTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class HeaderTest extends PHPUnit_Framework_TestCase
{
    /**
     * The Header instance being tested.
     *
     * @var Header
     */
    private $header;

    /**
     * The SchemaElementInterface mock used for testing.
     *
     * @var SchemaElementInterface
     */
    private $schemaMock;

    /**
     * Creates a Header instance and mocks for testing.
     */
    public function setUp()
    {
        parent::setUp();

        $this->schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
            ->getMock();

        $this->header = new Header('X-Test-Header', $this->schemaMock);
    }

    /**
     * Tests if constructing a new Header instance sets the instance properties.
     */
    public function testConstruct()
    {
        $this->assertAttributeSame('X-Test-Header', 'name', $this->header);
        $this->assertAttributeSame($this->schemaMock, 'schema', $this->header);
    }

    /**
     * Tests if Header::getName returns the name set during construction.
     */
    public function testGetName()
    {
        $this->assertSame('X-Test-Header', $this->header->getName());
    }

    /**
     * Tests if Header::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $this->schemaMock->expects($this->once())
            ->method('jsonSerialize')
            ->willReturn(
                array(
                    'description' => 'A description.',
                    'type' => 'string',
                )
            );

        $expectedResult = array(
            'description' => 'A description.',
            'type' => 'string',
        );

        $this->assertEquals($expectedResult, $this->header->jsonSerialize());
    }

    /**
     * Tests if Header::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeTroughJsonEncode()
    {
        $this->schemaMock->expects($this->once())
            ->method('jsonSerialize')
            ->willReturn(
                array(
                    'description' => 'A description.',
                    'type' => 'string',
                )
            );

        $expectedResult = '{"description":"A description.","type":"string"}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($this->header));
    }

    /**
     * Tests if Header::create returns a new Header instance and sets the instance properties.
     */
    public function testCreate()
    {
        $header = Header::create('X-Test-Header', $this->schemaMock);

        $this->assertAttributeSame('X-Test-Header', 'name', $header);
        $this->assertAttributeSame($this->schemaMock, 'schema', $header);
    }
}
