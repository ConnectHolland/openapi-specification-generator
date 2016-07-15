<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Schema\Primitive;

use ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\BinaryElement;
use PHPUnit_Framework_TestCase;

/**
 * BinaryElementTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class BinaryElementTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if BinaryElement::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $element = new BinaryElement();

        $expectedResult = array(
            'type' => 'string',
            'format' => 'binary',
        );

        $this->assertSame($expectedResult, $element->jsonSerialize());
    }

    /**
     * Tests if BinaryElement::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $element = new BinaryElement();

        $expectedResult = '{"type":"string","format":"binary"}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($element));
    }

    /**
     * Tests if BinaryElement::create returns a new BinaryElement instance.
     */
    public function testCreate()
    {
        $element = BinaryElement::create();

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\BinaryElement', $element);
    }
}
