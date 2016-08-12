<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Schema\Primitive;

use ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\DoubleElement;
use PHPUnit_Framework_TestCase;

/**
 * DoubleElementTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class DoubleElementTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if DoubleElement::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $element = new DoubleElement();

        $expectedResult = array(
            'type' => 'number',
            'format' => 'double',
        );

        $this->assertSame($expectedResult, $element->jsonSerialize());
    }

    /**
     * Tests if DoubleElement::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $element = new DoubleElement();

        $expectedResult = '{"type":"number","format":"double"}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($element));
    }

    /**
     * Tests if DoubleElement::create returns a new DoubleElement instance.
     */
    public function testCreate()
    {
        $element = DoubleElement::create();

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\DoubleElement', $element);
    }
}
