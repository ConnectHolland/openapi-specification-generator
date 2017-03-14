<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test;

use ConnectHolland\OpenAPISpecificationGenerator\ExternalDocumentation;
use PHPUnit_Framework_TestCase;

/**
 * ExternalDocumentationTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class ExternalDocumentationTest extends PHPUnit_Framework_TestCase
{
    /**
     * The ExternalDocumentation instance being tested.
     *
     * @var ExternalDocumentation
     */
    private $externalDocumentation;

    /**
     * Creates a ExternalDocumentation for testing.
     */
    public function setUp()
    {
        parent::setUp();

        $this->externalDocumentation = new ExternalDocumentation('https://documentation.connectholland.nl', 'A description');
    }

    /**
     * Tests if constructing a new ExternalDocumentation instance sets the instance properties.
     */
    public function testConstruct()
    {
        $this->assertAttributeSame('https://documentation.connectholland.nl', 'url', $this->externalDocumentation);
        $this->assertAttributeSame('A description', 'description', $this->externalDocumentation);
    }

    /**
     * Tests if ExternalDocumentation::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $expectedResult = array(
            'url' => 'https://documentation.connectholland.nl',
            'description' => 'A description',
        );

        $this->assertEquals($expectedResult, $this->externalDocumentation->jsonSerialize());
    }
}
