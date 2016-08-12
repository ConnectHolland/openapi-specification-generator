<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Schema\Primitive;

use ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\AbstractNumberElement;
use PHPUnit_Framework_TestCase;

/**
 * AbstractNumberElementTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class AbstractNumberElementTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if AbstractNumberElement::setMinimum sets the instance property and returns the AbstractNumberElement instance.
     */
    public function testSetMinimum()
    {
        $element = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\AbstractNumberElement')
                ->getMockForAbstractClass();

        $this->assertSame($element, $element->setMinimum(1));
        $this->assertAttributeSame(1, 'minimum', $element);
    }

    /**
     * Tests if AbstractNumberElement::setMaximum sets the instance property and returns the AbstractNumberElement instance.
     */
    public function testSetMaximum()
    {
        $element = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\AbstractNumberElement')
                ->getMockForAbstractClass();

        $this->assertSame($element, $element->setMaximum(5));
        $this->assertAttributeSame(5, 'maximum', $element);
    }

    /**
     * Tests if AbstractNumberElement::setExclusiveMinimum sets the instance property and returns the AbstractNumberElement instance.
     */
    public function testSetExclusiveMinimum()
    {
        $element = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\AbstractNumberElement')
                ->getMockForAbstractClass();

        $this->assertSame($element, $element->setExclusiveMinimum(true));
        $this->assertAttributeSame(true, 'exclusiveMinimum', $element);
    }

    /**
     * Tests if AbstractNumberElement::setExclusiveMaximum sets the instance property and returns the AbstractNumberElement instance.
     */
    public function testSetExclusiveMaximum()
    {
        $element = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\AbstractNumberElement')
                ->getMockForAbstractClass();

        $this->assertSame($element, $element->setExclusiveMaximum(true));
        $this->assertAttributeSame(true, 'exclusiveMaximum', $element);
    }

    /**
     * Tests if AbstractNumberElement::setMultipleOf sets the instance property and returns the AbstractNumberElement instance.
     */
    public function testSetMultipleOf()
    {
        $element = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\AbstractNumberElement')
                ->getMockForAbstractClass();

        $this->assertSame($element, $element->setMultipleOf(2));
        $this->assertAttributeSame(2, 'multipleOf', $element);
    }

    /**
     * Tests if AbstractNumberElement::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $element = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\AbstractNumberElement')
                ->getMockForAbstractClass();
        /* @var $element AbstractNumberElement */
        $element->setMinimum(1)
                ->setMaximum(5)
                ->setExclusiveMinimum(true)
                ->setExclusiveMaximum(true)
                ->setMultipleOf(2);

        $expectedResult = array(
            'type' => 'number',
            'minimum' => 1,
            'maximum' => 5,
            'exclusiveMinimum' => true,
            'exclusiveMaximum' => true,
            'multipleOf' => 2,
        );

        $this->assertSame($expectedResult, $element->jsonSerialize());
    }

    /**
     * Tests if AbstractNumberElement::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $element = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\AbstractNumberElement')
                ->getMockForAbstractClass();
        /* @var $element AbstractNumberElement */
        $element->setMinimum(1)
                ->setMaximum(5)
                ->setExclusiveMinimum(true)
                ->setExclusiveMaximum(true)
                ->setMultipleOf(2);

        $expectedResult = '{"type":"number","minimum":1,"maximum":5,"exclusiveMinimum":true,"exclusiveMaximum":true,"multipleOf":2}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($element));
    }
}
