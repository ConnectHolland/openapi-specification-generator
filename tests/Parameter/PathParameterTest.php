<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Parameter;

use ConnectHolland\OpenAPISpecificationGenerator\Parameter\PathParameter;
use ConnectHolland\OpenAPISpecificationGenerator\Parameter\QueryParameter;
use PHPUnit_Framework_TestCase;

/**
 * PathParameterTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class PathParameterTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if PathParameter::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();
        $schemaMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('type' => 'string'));

        $parameter = new PathParameter('parameterName', $schemaMock);

        $expectedResult = array(
            'name' => 'parameterName',
            'in' => 'path',
            'required' => true,
            'type' => 'string',
        );

        $this->assertSame($expectedResult, $parameter->jsonSerialize());
    }

    /**
     * Tests if PathParameter::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();
        $schemaMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('type' => 'string'));

        $parameter = new PathParameter('parameterName', $schemaMock);

        $expectedResult = '{"name":"parameterName","in":"path","required":true,"type":"string"}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($parameter));
    }

    /**
     * Tests if PathParameter::create returns a new QueryParameter instance and sets the instance properties.
     */
    public function testCreate()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();

        $parameter = PathParameter::create('test', $schemaMock);

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Parameter\PathParameter', $parameter);
        $this->assertAttributeSame('test', 'name', $parameter);
        $this->assertAttributeSame($schemaMock, 'schema', $parameter);
        $this->assertAttributeSame('path', 'in', $parameter);
    }
}
