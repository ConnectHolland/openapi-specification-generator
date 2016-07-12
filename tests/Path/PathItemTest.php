<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Path;

use ConnectHolland\OpenAPISpecificationGenerator\Path\PathItem;
use PHPUnit_Framework_TestCase;

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
        $pathItem = new PathItem();

        $this->assertSame($pathItem, $pathItem->setReference('someObject'));
        $this->assertAttributeSame('someObject', 'reference', $pathItem);
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
     * Tests if PathItem::create returns a new PathItem instance.
     */
    public function testCreate()
    {
        $pathItem = PathItem::create();

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Path\PathItem', $pathItem);
    }
}
