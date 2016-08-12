<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Schema\Primitive;

use ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\StringElement;
use PHPUnit_Framework_TestCase;

/**
 * StringElementTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class StringElementTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if StringElement::setMinLength sets the instance property and returns the StringElement instance.
     */
    public function testSetMinLength()
    {
        $element = new StringElement();

        $this->assertSame($element, $element->setMinLength(1));
        $this->assertAttributeSame(1, 'minLength', $element);
    }

    /**
     * Tests if StringElement::setMaxLength sets the instance property and returns the StringElement instance.
     */
    public function testSetMaxLength()
    {
        $element = new StringElement();

        $this->assertSame($element, $element->setMaxLength(1));
        $this->assertAttributeSame(1, 'maxLength', $element);
    }

    /**
     * Tests if StringElement::setPattern sets the instance property and returns the StringElement instance.
     */
    public function testSetPattern()
    {
        $element = new StringElement();

        $this->assertSame($element, $element->setPattern('^test$'));
        $this->assertAttributeSame('^test$', 'pattern', $element);
    }

    /**
     * Tests if StringElement::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $element = new StringElement();
        $element->setPattern('^default value$')
                ->setMinLength(1)
                ->setMaxLength(5);

        $expectedResult = array(
            'type' => 'string',
            'minLength' => 1,
            'maxLength' => 5,
            'pattern' => '^default value$',
        );

        $this->assertSame($expectedResult, $element->jsonSerialize());
    }

    /**
     * Tests if StringElement::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $element = new StringElement();
        $element->setPattern('^default value$')
                ->setMinLength(1)
                ->setMaxLength(5);

        $expectedResult = '{"type":"string","minLength":1,"maxLength":5,"pattern":"^default value$"}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($element));
    }

    /**
     * Tests if StringElement::create returns a new StringElement instance.
     */
    public function testCreate()
    {
        $element = StringElement::create();

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\StringElement', $element);
    }
}
