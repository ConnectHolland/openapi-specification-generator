<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Path\Response;

use ConnectHolland\OpenAPISpecificationGenerator\Path\Response\Example;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * ExampleTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class ExampleTest extends PHPUnit_Framework_TestCase
{
    /**
     * The Example instance being tested.
     *
     * @var Example
     */
    private $example;

    /**
     * Creates an Example instance for testing.
     */
    public function setUp()
    {
        parent::setUp();

        $this->example = new Example(
            'application/json',
            array(
                'foo' => 'bar',
                'baz' => 'qux',
            )
        );
    }

    /**
     * Tests if constructing a new Example instance sets the instance properties.
     */
    public function testConstruct()
    {
        $this->assertAttributeSame('application/json', 'mimetype', $this->example);
        $this->assertAttributeSame(
            array(
                'foo' => 'bar',
                'baz' => 'qux',
            ),
            'contents',
            $this->example
        );
    }

    /**
     * Tests if constructing an Example instance with various contents does not throw an InvalidArgumentException.
     *
     * @dataProvider provideExampleContents
     *
     * @param string $mimetype
     * @param mixed  $contents
     */
    public function testConstructAllowsContents($mimetype, $contents)
    {
        $example = new Example($mimetype, $contents);

        $this->assertAttributeSame($contents, 'contents', $example);
    }

    /**
     * Tests if constructing an Example instance with invalid contents throws an InvalidArgumentException.
     */
    public function testConstructThrowsInvalidArgumentException()
    {
        $this->setExpectedException('InvalidArgumentException', 'Supplied example contents is not of type array, bool, float, int or string.');

        new Example('application/json', new stdClass());
    }

    /**
     * Tests if Example::getMimetype returns the mimetype set during construction.
     */
    public function testGetMimetype()
    {
        $this->assertSame('application/json', $this->example->getMimetype());
    }

    /**
     * Tests if Example::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $expectedResult = array(
            'foo' => 'bar',
            'baz' => 'qux',
        );

        $this->assertEquals($expectedResult, $this->example->jsonSerialize());
    }

    /**
     * Returns the test cases for @see testConstructAllowsContents.
     *
     * @return array
     */
    public function provideExampleContents()
    {
        return array(
            array('text/plain', 'String'),
            array('text/plain', true),
            array('text/plain', 1),
            array('text/plain', 1.0),
            array(
                'application/json',
                array(
                    'foo' => 'bar',
                    'baz' => 'qux',
                ),
            ),
        );
    }
}
