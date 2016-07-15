<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Schema;

use ConnectHolland\OpenAPISpecificationGenerator\Schema\ArrayElement;
use PHPUnit_Framework_TestCase;

/**
 * ArrayElementTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class ArrayElementTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if ArrayElement::setMinProperties sets the instance property and returns the ArrayElement instance.
     */
    public function testSetMinItems()
    {
        $element = new ArrayElement();

        $this->assertSame($element, $element->setMinItems(1));
        $this->assertAttributeSame(1, 'minItems', $element);
    }

    /**
     * Tests if ArrayElement::setMaxProperties sets the instance property and returns the ArrayElement instance.
     */
    public function testSetMaxItems()
    {
        $element = new ArrayElement();

        $this->assertSame($element, $element->setMaxItems(1));
        $this->assertAttributeSame(1, 'maxItems', $element);
    }

    /**
     * Tests if ArrayElement::addProperty sets the instance property and returns the ArrayElement instance.
     */
    public function testAddItem()
    {
        $schemaElementMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();

        $element = new ArrayElement();

        $this->assertSame($element, $element->addItem($schemaElementMock));
        $this->assertAttributeSame(array($schemaElementMock), 'items', $element);
    }

    /**
     * Tests if ArrayElement::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $schemaElementMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();
        $schemaElementMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('type' => 'string'));

        $element = new ArrayElement();
        $element->setMinItems(1)
                ->setMaxItems(5)
                ->addItem($schemaElementMock);

        $expectedResult = array(
            'type' => 'array',
            'minItems' => 1,
            'maxItems' => 5,
            'items' => array(
                array(
                    'type' => 'string',
                ),
            ),
        );

        $this->assertSame($expectedResult, $element->jsonSerialize());
    }

    /**
     * Tests if ArrayElement::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $schemaElementMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();
        $schemaElementMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('type' => 'string'));

        $element = new ArrayElement();
        $element->setMinItems(1)
                ->setMaxItems(5)
                ->addItem($schemaElementMock);

        $expectedResult = array(
            'minItems' => 1,
            'maxItems' => 5,
            'items' => array(
                array(
                    'type' => 'string',
                ),
            ),
        );

        $expectedResult = '{"type":"array","minItems":1,"maxItems":5,"items":[{"type":"string"}]}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($element));
    }

    /**
     * Tests if ArrayElement::create returns a new ArrayElement instance.
     */
    public function testCreate()
    {
        $element = ArrayElement::create();

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Schema\ArrayElement', $element);
    }
}
