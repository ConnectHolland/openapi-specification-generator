<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Schema\Primitive;

use ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\BooleanElement;
use PHPUnit_Framework_TestCase;

/**
 * BooleanElementTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class BooleanElementTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if BooleanElement::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $element = new BooleanElement();

        $expectedResult = array(
            'type' => 'boolean',
        );

        $this->assertSame($expectedResult, $element->jsonSerialize());
    }

    /**
     * Tests if BooleanElement::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $element = new BooleanElement();

        $expectedResult = '{"type":"boolean"}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($element));
    }

    /**
     * Tests if BooleanElement::create returns a new BooleanElement instance.
     */
    public function testCreate()
    {
        $element = BooleanElement::create();

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\BooleanElement', $element);
    }
}
