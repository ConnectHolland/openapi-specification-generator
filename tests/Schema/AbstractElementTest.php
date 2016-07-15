<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Schema;

use ConnectHolland\OpenAPISpecificationGenerator\Schema\AbstractElement;
use PHPUnit_Framework_TestCase;

/**
 * AbstractElementTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class AbstractElementTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if AbstractElement::setId sets the instance property and returns the AbstractElement instance.
     */
    public function testSetId()
    {
        $element = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\AbstractElement')
                ->getMockForAbstractClass();

        $this->assertSame($element, $element->setId('identifier'));
        $this->assertAttributeSame('identifier', 'id', $element);
    }

    /**
     * Tests if AbstractElement::setTitle sets the instance property and returns the AbstractElement instance.
     */
    public function testSetTitle()
    {
        $element = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\AbstractElement')
                ->getMockForAbstractClass();

        $this->assertSame($element, $element->setTitle('A title.'));
        $this->assertAttributeSame('A title.', 'title', $element);
    }

    /**
     * Tests if AbstractElement::setDescription sets the instance property and returns the AbstractElement instance.
     */
    public function testSetDescription()
    {
        $element = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\AbstractElement')
                ->getMockForAbstractClass();

        $this->assertSame($element, $element->setDescription('A description.'));
        $this->assertAttributeSame('A description.', 'description', $element);
    }

    /**
     * Tests if AbstractElement::setSchema sets the instance property and returns the AbstractElement instance.
     */
    public function testSetSchema()
    {
        $element = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\AbstractElement')
                ->getMockForAbstractClass();

        $this->assertSame($element, $element->setSchema('http://json-schema.org/draft-04/schema'));
        $this->assertAttributeSame('http://json-schema.org/draft-04/schema', 'schema', $element);
    }

    /**
     * Tests if AbstractElement::setDefault sets the instance property and returns the AbstractElement instance.
     */
    public function testSetDefault()
    {
        $element = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\AbstractElement')
                ->getMockForAbstractClass();

        $this->assertSame($element, $element->setDefault('default value'));
        $this->assertAttributeSame('default value', 'default', $element);
    }

    /**
     * Tests if AbstractElement::setEnum sets the instance property and returns the AbstractElement instance.
     */
    public function testSetEnum()
    {
        $element = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\AbstractElement')
                ->getMockForAbstractClass();

        $this->assertSame($element, $element->setEnum(array('value1', 'value2')));
        $this->assertAttributeSame(array('value1', 'value2'), 'enum', $element);
    }

    /**
     * Tests if AbstractElement::setRequired sets the instance property and returns the AbstractElement instance.
     */
    public function testSetRequired()
    {
        $element = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\AbstractElement')
                ->getMockForAbstractClass();

        $this->assertSame($element, $element->setRequired(true));
        $this->assertAttributeSame(true, 'required', $element);
    }

    /**
     * Tests if AbstractElement::isRequired returns false by default.
     *
     * @depends testSetRequired
     */
    public function testIsRequiredReturnsFalse()
    {
        $element = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\AbstractElement')
                ->getMockForAbstractClass();

        $this->assertFalse($element->isRequired());
    }

    /**
     * Tests if AbstractElement::isRequired returns true.
     *
     * @depends testIsRequiredReturnsFalse
     */
    public function testIsRequiredReturnsTrue()
    {
        $element = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\AbstractElement')
                ->getMockForAbstractClass();

        $element->setRequired(true);

        $this->assertTrue($element->isRequired());
    }

    /**
     * Tests if AbstractElement::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $element = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\AbstractElement')
                ->getMockForAbstractClass();
        /* @var $element AbstractElement */
        $element->setId('identifier')
                ->setTitle('A title.')
                ->setDescription('A description.')
                ->setSchema('http://json-schema.org/draft-04/schema')
                ->setDefault('default value')
                ->setEnum(array('value1', 'value2'));

        $expectedResult = array(
            '$schema' => 'http://json-schema.org/draft-04/schema',
            'id' => 'identifier',
            'title' => 'A title.',
            'description' => 'A description.',
            'enum' => array(
                0 => 'value1',
                1 => 'value2',
            ),
            'default' => 'default value',
        );

        $this->assertSame($expectedResult, $element->jsonSerialize());
    }

    /**
     * Tests if AbstractElement::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $element = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\AbstractElement')
                ->getMockForAbstractClass();
        /* @var $element AbstractElement */
        $element->setId('identifier')
                ->setTitle('A title.')
                ->setDescription('A description.')
                ->setSchema('http://json-schema.org/draft-04/schema')
                ->setDefault('default value')
                ->setEnum(array('value1', 'value2'));

        $expectedResult = '{"$schema":"http:\/\/json-schema.org\/draft-04\/schema","id":"identifier","title":"A title.","description":"A description.","enum":["value1","value2"],"default":"default value"}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($element));
    }
}
