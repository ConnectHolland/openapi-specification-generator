<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Parameter;

use ConnectHolland\OpenAPISpecificationGenerator\Parameter\QueryParameter;
use PHPUnit_Framework_TestCase;

/**
 * QueryParameterTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class QueryParameterTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if QueryParameter::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();
        $schemaMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('type' => 'string'));

        $parameter = new QueryParameter('parameterName', $schemaMock);
        $parameter->setDescription('A description.');
        $parameter->setAllowEmptyValue(true);
        $parameter->setRequired(true);

        $expectedResult = array(
            'name' => 'parameterName',
            'in' => 'query',
            'description' => 'A description.',
            'required' => true,
            'type' => 'string',
            'allowEmptyValue' => true,
        );

        $this->assertSame($expectedResult, $parameter->jsonSerialize());
    }

    /**
     * Tests if QueryParameter::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();
        $schemaMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('type' => 'string'));

        $parameter = new QueryParameter('parameterName', $schemaMock);
        $parameter->setDescription('A description.');
        $parameter->setAllowEmptyValue(true);
        $parameter->setRequired(true);

        $expectedResult = '{"name":"parameterName","in":"query","description":"A description.","required":true,"type":"string","allowEmptyValue":true}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($parameter));
    }

    /**
     * Tests if QueryParameter::create returns a new QueryParameter instance and sets the instance properties.
     */
    public function testCreate()
    {
        $schemaMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->getMock();

        $parameter = QueryParameter::create('parameterName', $schemaMock);

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Parameter\QueryParameter', $parameter);
        $this->assertAttributeSame('parameterName', 'name', $parameter);
        $this->assertAttributeSame($schemaMock, 'schema', $parameter);
        $this->assertAttributeSame('query', 'in', $parameter);
    }
}
