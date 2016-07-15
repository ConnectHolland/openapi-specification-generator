<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Schema;

use ConnectHolland\OpenAPISpecificationGenerator\Schema\ObjectElement;
use PHPUnit_Framework_TestCase;

/**
 * ObjectElementTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class ObjectElementTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if ObjectElement::setMinProperties sets the instance property and returns the ObjectElement instance.
     */
    public function testSetMinProperties()
    {
        $element = new ObjectElement();

        $this->assertSame($element, $element->setMinProperties(1));
        $this->assertAttributeSame(1, 'minProperties', $element);
    }

    /**
     * Tests if ObjectElement::setMaxProperties sets the instance property and returns the ObjectElement instance.
     */
    public function testSetMaxProperties()
    {
        $element = new ObjectElement();

        $this->assertSame($element, $element->setMaxProperties(1));
        $this->assertAttributeSame(1, 'maxProperties', $element);
    }

    /**
     * Tests if ObjectElement::addProperty sets the instance property and returns the ObjectElement instance.
     */
    public function testAddProperty()
    {
        $schemaElementMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();

        $element = new ObjectElement();

        $this->assertSame($element, $element->addProperty('test', $schemaElementMock));
        $this->assertAttributeSame(array('test' => $schemaElementMock), 'properties', $element);
    }

    /**
     * Tests if ObjectElement::setAdditionalProperties sets the instance property and returns the ObjectElement instance.
     */
    public function testSetAdditionalProperties()
    {
        $element = new ObjectElement();

        $this->assertSame($element, $element->setAdditionalProperties(true));
        $this->assertAttributeSame(true, 'additionalProperties', $element);
    }

    /**
     * Tests if ObjectElement::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $schemaElementMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();
        $schemaElementMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('type' => 'string'));
        $schemaElementMock->expects($this->once())
                ->method('isRequired')
                ->willReturn(true);

        $element = new ObjectElement();
        $element->setMinProperties(1)
                ->setMaxProperties(5)
                ->setAdditionalProperties(true)
                ->addProperty('foo', $schemaElementMock);

        $expectedResult = array(
            'type' => 'object',
            'minProperties' => 1,
            'maxProperties' => 5,
            'properties' => array(
                'foo' => array(
                    'type' => 'string',
                ),
            ),
            'required' => ['foo'],
        );

        $this->assertSame($expectedResult, $element->jsonSerialize());
    }

    /**
     * Tests if ObjectElement::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $schemaElementMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();
        $schemaElementMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('type' => 'string'));
        $schemaElementMock->expects($this->once())
                ->method('isRequired')
                ->willReturn(true);

        $element = new ObjectElement();
        $element->setMinProperties(1)
                ->setMaxProperties(5)
                ->setAdditionalProperties(true)
                ->addProperty('foo', $schemaElementMock);

        $expectedResult = '{"type":"object","minProperties":1,"maxProperties":5,"properties":{"foo":{"type":"string"}},"required":["foo"]}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($element));
    }

    /**
     * Tests if ObjectElement::create returns a new ObjectElement instance.
     */
    public function testCreate()
    {
        $element = ObjectElement::create();

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Schema\ObjectElement', $element);
    }
}
