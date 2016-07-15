<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Schema\Primitive;

use ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\IntegerElement;
use PHPUnit_Framework_TestCase;

/**
 * IntegerElementTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class IntegerElementTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if IntegerElement::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $element = new IntegerElement();

        $expectedResult = array(
            'type' => 'integer',
            'format' => 'int32',
        );

        $this->assertSame($expectedResult, $element->jsonSerialize());
    }

    /**
     * Tests if IntegerElement::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $element = new IntegerElement();

        $expectedResult = '{"type":"integer","format":"int32"}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($element));
    }

    /**
     * Tests if IntegerElement::create returns a new IntegerElement instance.
     */
    public function testCreate()
    {
        $element = IntegerElement::create();

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\IntegerElement', $element);
    }
}
