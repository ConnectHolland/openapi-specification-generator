<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Parameter;

use PHPUnit_Framework_TestCase;

/**
 * AbstractParameterTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class AbstractParameterTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if constructing a new AbstractParameter instance sets the instance properties.
     */
    public function testConstruct()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();

        $parameter = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Parameter\AbstractParameter')
                ->setConstructorArgs(array('parameterName', $schemaMock))
                ->getMockForAbstractClass();

        $this->assertAttributeSame('parameterName', 'name', $parameter);
        $this->assertAttributeSame($schemaMock, 'schema', $parameter);
    }

    /**
     * Tests if AbstractParameter::setDescription sets the instance property and returns the AbstractParameter instance.
     */
    public function testSetDescription()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();

        $parameter = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Parameter\AbstractParameter')
                ->setConstructorArgs(array('parameterName', $schemaMock))
                ->getMockForAbstractClass();

        $this->assertSame($parameter, $parameter->setDescription('A description.'));
        $this->assertAttributeSame('A description.', 'description', $parameter);
    }

    /**
     * Tests if AbstractParameter::setRequired sets the instance property and returns the AbstractParameter instance.
     */
    public function testSetRequired()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();

        $parameter = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Parameter\AbstractParameter')
                ->setConstructorArgs(array('parameterName', $schemaMock))
                ->getMockForAbstractClass();

        $this->assertSame($parameter, $parameter->setRequired(true));
        $this->assertAttributeSame(true, 'required', $parameter);
    }

    /**
     * Tests if AbstractParameter::isRequired returns false by default.
     */
    public function testIsRequiredReturnsFalseByDefault()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();

        $parameter = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Parameter\AbstractParameter')
                ->setConstructorArgs(array('parameterName', $schemaMock))
                ->getMockForAbstractClass();

        $this->assertFalse($parameter->isRequired());
    }

    /**
     * Tests if AbstractParameter::isRequired returns true.
     *
     * @depends testSetRequired
     */
    public function testIsRequiredReturnsTrue()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();

        $parameter = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Parameter\AbstractParameter')
                ->setConstructorArgs(array('parameterName', $schemaMock))
                ->getMockForAbstractClass();

        $parameter->setRequired(true);

        $this->assertTrue($parameter->isRequired());
    }
}
