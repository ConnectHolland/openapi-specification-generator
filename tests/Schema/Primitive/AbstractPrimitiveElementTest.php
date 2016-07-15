<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Schema\Primitive;

/**
 * AbstractPrimitiveElementTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class AbstractPrimitiveElementTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests if AbstractPrimitiveElement::setFormat sets the instance property and returns the AbstractPrimitiveElement instance.
     */
    public function testSetFormat()
    {
        $element = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\AbstractPrimitiveElement')
                ->getMockForAbstractClass();

        $this->assertSame($element, $element->setFormat('date-time'));
        $this->assertAttributeSame('date-time', 'format', $element);
    }

    /**
     * Tests if AbstractPrimitiveElement::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $element = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\AbstractPrimitiveElement')
                ->getMockForAbstractClass();

        $element->setFormat('date-time');

        $expectedResult = array(
            'format' => 'date-time',
        );

        $this->assertSame($expectedResult, $element->jsonSerialize());
    }

    /**
     * Tests if AbstractPrimitiveElement::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $element = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\AbstractPrimitiveElement')
                ->getMockForAbstractClass();

        $element->setFormat('date-time');

        $expectedResult = '{"format":"date-time"}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($element));
    }
}
