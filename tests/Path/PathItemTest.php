<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Path;

use ConnectHolland\OpenAPISpecificationGenerator\Path\PathItem;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * PathItemTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class PathItemTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if PathItem::setReference sets the instance property and returns the PathItem instance.
     */
    public function testSetReference()
    {
        $referenceElementMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\ReferenceElement')
                ->disableOriginalConstructor()
                ->getMock();

        $pathItem = new PathItem();

        $this->assertSame($pathItem, $pathItem->setReference($referenceElementMock));
        $this->assertAttributeSame($referenceElementMock, 'reference', $pathItem);
    }

    /**
     * Tests if PathItem::setGet sets the instance property and returns the PathItem instance.
     */
    public function testSetGet()
    {
        $operationMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Operation')
                ->disableOriginalConstructor()
                ->getMock();

        $pathItem = new PathItem();

        $this->assertSame($pathItem, $pathItem->setGet($operationMock));
        $this->assertAttributeSame($operationMock, 'get', $pathItem);
    }

    /**
     * Tests if PathItem::setPut sets the instance property and returns the PathItem instance.
     */
    public function testSetPut()
    {
        $operationMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Operation')
                ->disableOriginalConstructor()
                ->getMock();

        $pathItem = new PathItem();

        $this->assertSame($pathItem, $pathItem->setPut($operationMock));
        $this->assertAttributeSame($operationMock, 'put', $pathItem);
    }

    /**
     * Tests if PathItem::setPost sets the instance property and returns the PathItem instance.
     */
    public function testSetPost()
    {
        $operationMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Operation')
                ->disableOriginalConstructor()
                ->getMock();

        $pathItem = new PathItem();

        $this->assertSame($pathItem, $pathItem->setPost($operationMock));
        $this->assertAttributeSame($operationMock, 'post', $pathItem);
    }

    /**
     * Tests if PathItem::setDelete sets the instance property and returns the PathItem instance.
     */
    public function testSetDelete()
    {
        $operationMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Operation')
                ->disableOriginalConstructor()
                ->getMock();

        $pathItem = new PathItem();

        $this->assertSame($pathItem, $pathItem->setDelete($operationMock));
        $this->assertAttributeSame($operationMock, 'delete', $pathItem);
    }

    /**
     * Tests if PathItem::setOptions sets the instance property and returns the PathItem instance.
     */
    public function testSetOptions()
    {
        $operationMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Operation')
                ->disableOriginalConstructor()
                ->getMock();

        $pathItem = new PathItem();

        $this->assertSame($pathItem, $pathItem->setOptions($operationMock));
        $this->assertAttributeSame($operationMock, 'options', $pathItem);
    }

    /**
     * Tests if PathItem::setHead sets the instance property and returns the PathItem instance.
     */
    public function testSetHead()
    {
        $operationMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Operation')
                ->disableOriginalConstructor()
                ->getMock();

        $pathItem = new PathItem();

        $this->assertSame($pathItem, $pathItem->setHead($operationMock));
        $this->assertAttributeSame($operationMock, 'head', $pathItem);
    }

    /**
     * Tests if PathItem::setPatch sets the instance property and returns the PathItem instance.
     */
    public function testSetPatch()
    {
        $operationMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Operation')
                ->disableOriginalConstructor()
                ->getMock();

        $pathItem = new PathItem();

        $this->assertSame($pathItem, $pathItem->setPatch($operationMock));
        $this->assertAttributeSame($operationMock, 'patch', $pathItem);
    }

    /**
     * Tests if PathItem::setParameters sets the instance property and returns the PathItem instance.
     */
    public function testSetParameters()
    {
        $parameterMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Parameter\ParameterInterface')
                ->getMock();

        $pathItem = new PathItem();

        $this->assertSame($pathItem, $pathItem->setParameters(array($parameterMock)));
        $this->assertAttributeSame(array($parameterMock), 'parameters', $pathItem);
    }

    /**
     * Tests if PathItem::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $referenceElementMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\ReferenceElement')
                ->disableOriginalConstructor()
                ->getMock();
        $referenceElementMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('$ref' => '#/definitions/test-reference'));

        $operationMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Operation')
                ->disableOriginalConstructor()
                ->getMock();
        $operationMock->expects($this->exactly(7))
                ->method('jsonSerialize')
                ->willReturn(array('responses' => new stdClass()));

        $parameterMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Parameter\ParameterInterface')
                ->getMock();
        $parameterMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('name' => 'parameterName', 'in' => 'body', 'schema' => array('type' => 'string')));

        $pathItem = new PathItem();
        $pathItem->setReference($referenceElementMock);
        $pathItem->setGet($operationMock);
        $pathItem->setPut($operationMock);
        $pathItem->setPost($operationMock);
        $pathItem->setDelete($operationMock);
        $pathItem->setOptions($operationMock);
        $pathItem->setHead($operationMock);
        $pathItem->setPatch($operationMock);
        $pathItem->setParameters(array($parameterMock));

        $expectedResult = array(
            '$ref' => '#/definitions/test-reference',
            'get' => array(
                'responses' => new stdClass(),
            ),
            'put' => array(
                'responses' => new stdClass(),
            ),
            'post' => array(
                'responses' => new stdClass(),
            ),
            'delete' => array(
                'responses' => new stdClass(),
            ),
            'options' => array(
                'responses' => new stdClass(),
            ),
            'head' => array(
                'responses' => new stdClass(),
            ),
            'patch' => array(
                'responses' => new stdClass(),
            ),
            'parameters' => array(
                array(
                    'name' => 'parameterName',
                    'in' => 'body',
                    'schema' => array(
                        'type' => 'string'
                    )
                ),
            ),
        );

        $this->assertEquals($expectedResult, $pathItem->jsonSerialize());
    }

    /**
     * Tests if PathItem::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $referenceElementMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\ReferenceElement')
                ->disableOriginalConstructor()
                ->getMock();
        $referenceElementMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('$ref' => '#/definitions/test-reference'));

        $operationMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\Operation')
                ->disableOriginalConstructor()
                ->getMock();
        $operationMock->expects($this->exactly(7))
                ->method('jsonSerialize')
                ->willReturn(array('responses' => new stdClass()));

        $parameterMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Parameter\ParameterInterface')
                ->getMock();
        $parameterMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('name' => 'parameterName', 'in' => 'body', 'schema' => array('type' => 'string')));

        $pathItem = new PathItem();
        $pathItem->setReference($referenceElementMock);
        $pathItem->setGet($operationMock);
        $pathItem->setPut($operationMock);
        $pathItem->setPost($operationMock);
        $pathItem->setDelete($operationMock);
        $pathItem->setOptions($operationMock);
        $pathItem->setHead($operationMock);
        $pathItem->setPatch($operationMock);
        $pathItem->setParameters(array($parameterMock));

        $expectedResult = '{"$ref":"#\/definitions\/test-reference","get":{"responses":{}},"put":{"responses":{}},"post":{"responses":{}},"delete":{"responses":{}},"options":{"responses":{}},"head":{"responses":{}},"patch":{"responses":{}},"parameters":[{"name":"parameterName","in":"body","schema":{"type":"string"}}]}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($pathItem));
    }

    /**
     * Tests if PathItem::jsonSerialize returns the expected JSON encoded result through the json_encode function with empty properties.
     */
    public function testJsonSerializeThroughJsonEncodeWithEmptyProperties()
    {
        $pathItem = new PathItem();

        $expectedResult = '{}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($pathItem));
    }

    /**
     * Tests if PathItem::create returns a new PathItem instance.
     */
    public function testCreate()
    {
        $pathItem = PathItem::create();

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Path\PathItem', $pathItem);
    }
}
