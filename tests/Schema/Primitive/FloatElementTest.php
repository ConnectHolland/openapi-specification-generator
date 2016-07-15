<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Schema\Primitive;

use ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\FloatElement;
use PHPUnit_Framework_TestCase;

/**
 * FloatElementTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class FloatElementTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if FloatElement::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $element = new FloatElement();

        $expectedResult = array(
            'type' => 'number',
            'format' => 'float',
        );

        $this->assertSame($expectedResult, $element->jsonSerialize());
    }

    /**
     * Tests if FloatElement::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $element = new FloatElement();

        $expectedResult = '{"type":"number","format":"float"}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($element));
    }

    /**
     * Tests if FloatElement::create returns a new FloatElement instance.
     */
    public function testCreate()
    {
        $element = FloatElement::create();

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\FloatElement', $element);
    }
}
