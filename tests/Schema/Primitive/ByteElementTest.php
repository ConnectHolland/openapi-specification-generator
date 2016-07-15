<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Schema\Primitive;

use ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\ByteElement;
use PHPUnit_Framework_TestCase;

/**
 * ByteElementTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class ByteElementTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if ByteElement::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $element = new ByteElement();

        $expectedResult = array(
            'type' => 'string',
            'format' => 'byte',
        );

        $this->assertSame($expectedResult, $element->jsonSerialize());
    }

    /**
     * Tests if ByteElement::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $element = new ByteElement();

        $expectedResult = '{"type":"string","format":"byte"}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($element));
    }

    /**
     * Tests if ByteElement::create returns a new ByteElement instance.
     */
    public function testCreate()
    {
        $element = ByteElement::create();

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\ByteElement', $element);
    }
}
