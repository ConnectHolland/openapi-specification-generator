<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Schema\Primitive;

use ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\DateTimeElement;
use PHPUnit_Framework_TestCase;

/**
 * DateTimeElementTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class DateTimeElementTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if DateTimeElement::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $element = new DateTimeElement();

        $expectedResult = array(
            'type' => 'string',
            'format' => 'date-time',
        );

        $this->assertSame($expectedResult, $element->jsonSerialize());
    }

    /**
     * Tests if DateTimeElement::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $element = new DateTimeElement();

        $expectedResult = '{"type":"string","format":"date-time"}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($element));
    }

    /**
     * Tests if DateTimeElement::create returns a new DateTimeElement instance.
     */
    public function testCreate()
    {
        $element = DateTimeElement::create();

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\DateTimeElement', $element);
    }
}
