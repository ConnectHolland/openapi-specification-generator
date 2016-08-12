<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Schema\Primitive;

use ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\LongElement;
use PHPUnit_Framework_TestCase;

/**
 * LongElementTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class LongElementTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if LongElement::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $element = new LongElement();

        $expectedResult = array(
            'type' => 'integer',
            'format' => 'int64',
        );

        $this->assertSame($expectedResult, $element->jsonSerialize());
    }

    /**
     * Tests if LongElement::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $element = new LongElement();

        $expectedResult = '{"type":"integer","format":"int64"}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($element));
    }

    /**
     * Tests if LongElement::create returns a new LongElement instance.
     */
    public function testCreate()
    {
        $element = LongElement::create();

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\LongElement', $element);
    }
}
