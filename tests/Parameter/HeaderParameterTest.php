<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Parameter;

use ConnectHolland\OpenAPISpecificationGenerator\Parameter\HeaderParameter;
use PHPUnit_Framework_TestCase;

/**
 * HeaderParameterTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class HeaderParameterTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if HeaderParameter::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();
        $schemaMock->expects($this->once())
                ->method('getType')
                ->willReturn('array');
        $schemaMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('type' => 'array', 'items' => array(array('type' => 'string'))));

        $parameter = new HeaderParameter('parameterName', $schemaMock);

        $expectedResult = array(
            'name' => 'parameterName',
            'in' => 'header',
            'type' => 'array',
            'items' => array(
                'type' => 'string',
            ),
            'collectionFormat' => 'csv',
        );

        $this->assertSame($expectedResult, $parameter->jsonSerialize());
    }

    /**
     * Tests if HeaderParameter::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();
        $schemaMock->expects($this->once())
                ->method('getType')
                ->willReturn('array');
        $schemaMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('type' => 'array', 'items' => array(array('type' => 'string'))));

        $parameter = new HeaderParameter('parameterName', $schemaMock);

        $expectedResult = '{"name":"parameterName","in":"header","type":"array","items":{"type":"string"},"collectionFormat":"csv"}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($parameter));
    }

    /**
     * Tests if HeaderParameter::create returns a new QueryParameter instance and sets the instance properties.
     */
    public function testCreate()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();

        $parameter = HeaderParameter::create('parameterName', $schemaMock);

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Parameter\HeaderParameter', $parameter);
        $this->assertAttributeSame('parameterName', 'name', $parameter);
        $this->assertAttributeSame($schemaMock, 'schema', $parameter);
        $this->assertAttributeSame('header', 'in', $parameter);
    }
}
