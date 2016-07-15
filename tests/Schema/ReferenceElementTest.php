<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Schema;

use ConnectHolland\OpenAPISpecificationGenerator\Schema\ReferenceElement;
use PHPUnit_Framework_TestCase;

/**
 * ReferenceElementTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class ReferenceElementTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if constructing a new ReferenceElement instance sets the instance properties.
     */
    public function testConstruct()
    {
        $element = new ReferenceElement('test-reference');

        $this->assertAttributeSame('test-reference', 'reference', $element);
    }

    /**
     * Tests if ReferenceElement::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $element = new ReferenceElement('test-reference');

        $expectedResult = array(
            '$ref' => '#/definitions/test-reference',
        );

        $this->assertSame($expectedResult, $element->jsonSerialize());
    }

    /**
     * Tests if ReferenceElement::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $element = new ReferenceElement('test-reference');

        $expectedResult = '{"$ref":"#\/definitions\/test-reference"}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($element));
    }

    /**
     * Tests if ReferenceElement::create returns a new ReferenceElement instance.
     */
    public function testCreate()
    {
        $element = ReferenceElement::create('test-reference');

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Schema\ReferenceElement', $element);
        $this->assertAttributeSame('test-reference', 'reference', $element);
    }
}
