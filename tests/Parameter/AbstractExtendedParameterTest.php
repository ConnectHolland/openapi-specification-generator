<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Parameter;

use PHPUnit_Framework_TestCase;

/**
 * AbstractExtendedParameterTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class AbstractExtendedParameterTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if AbstractExtendedParameter::setAllowEmptyValue sets the instance property and returns the AbstractExtendedParameter instance.
     */
    public function testSetAllowEmptyValue()
    {
        $parameter = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Parameter\AbstractExtendedParameter')
                ->disableOriginalConstructor()
                ->getMockForAbstractClass();

        $this->assertSame($parameter, $parameter->setAllowEmptyValue(true));
        $this->assertAttributeSame(true, 'allowEmptyValue', $parameter);
    }

    /**
     * Tests if AbstractExtendedParameter::setCollectionFormat sets the instance property and returns the AbstractExtendedParameter instance.
     */
    public function testSetCollectionFormat()
    {
        $parameter = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Parameter\AbstractExtendedParameter')
                ->disableOriginalConstructor()
                ->getMockForAbstractClass();

        $this->assertSame($parameter, $parameter->setCollectionFormat('ssv'));
        $this->assertAttributeSame('ssv', 'collectionFormat', $parameter);
    }

    /**
     * Tests if AbstractExtendedParameter::setCollectionFormat throws an InvalidArgumentException on an invalid collection format.
     */
    public function testSetCollectionFormatThrowsInvalidArgumentExceptionOnInvalidCollectionFormat()
    {
        $parameter = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Parameter\AbstractExtendedParameter')
                ->disableOriginalConstructor()
                ->getMockForAbstractClass();

        $this->setExpectedException('InvalidArgumentException', 'The supplied collection format "invalid-format" is invalid.');

        $parameter->setCollectionFormat('invalid-format');
    }
}
