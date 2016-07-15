<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Schema\Primitive;

use ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\DateElement;
use PHPUnit_Framework_TestCase;

/**
 * DateElementTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class DateElementTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if DateElement::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $element = new DateElement();

        $expectedResult = array(
            'type' => 'string',
            'format' => 'date',
        );

        $this->assertSame($expectedResult, $element->jsonSerialize());
    }

    /**
     * Tests if DateElement::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $element = new DateElement();

        $expectedResult = '{"type":"string","format":"date"}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($element));
    }

    /**
     * Tests if DateElement::create returns a new DateElement instance.
     */
    public function testCreate()
    {
        $element = DateElement::create();

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\DateElement', $element);
    }
}
