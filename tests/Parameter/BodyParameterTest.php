<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Parameter;

use ConnectHolland\OpenAPISpecificationGenerator\Parameter\BodyParameter;
use PHPUnit_Framework_TestCase;

/**
 * BodyParameterTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class BodyParameterTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if BodyParameter::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();
        $schemaMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('type' => 'string'));

        $parameter = new BodyParameter('parameterName', $schemaMock);

        $expectedResult = array(
            'name' => 'parameterName',
            'in' => 'body',
            'schema' => array(
                'type' => 'string',
            ),
        );

        $this->assertSame($expectedResult, $parameter->jsonSerialize());
    }

    /**
     * Tests if BodyParameter::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();
        $schemaMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('type' => 'string'));

        $parameter = new BodyParameter('parameterName', $schemaMock);

        $expectedResult = '{"name":"parameterName","in":"body","schema":{"type":"string"}}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($parameter));
    }

    /**
     * Tests if BodyParameter::create returns a new BodyParameter instance and sets the instance properties.
     */
    public function testCreate()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();

        $parameter = BodyParameter::create('parameterName', $schemaMock);

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Parameter\BodyParameter', $parameter);
        $this->assertAttributeSame('parameterName', 'name', $parameter);
        $this->assertAttributeSame($schemaMock, 'schema', $parameter);
        $this->assertAttributeSame('body', 'in', $parameter);
    }
}
