<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Security;

use ConnectHolland\OpenAPISpecificationGenerator\Security\BasicSecurityScheme;
use ConnectHolland\OpenAPISpecificationGenerator\Security\SecuritySchemeInterface;

/**
 * BasicSecuritySchemeTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class BasicSecuritySchemeTest extends AbstractSecuritySchemeTest
{
    /**
     * Creates a new BasicSecurityScheme instance for testing.
     */
    public function setUp()
    {
        parent::setUp();

        $this->securityScheme = new BasicSecurityScheme('foo');
    }

    /**
     * Tests if constructing a new BasicSecurityScheme instance sets the instance properties.
     */
    public function testConstruct()
    {
        $this->assertAttributeSame('foo', 'identifier', $this->securityScheme);
        $this->assertAttributeSame(SecuritySchemeInterface::TYPE_BASIC, 'type', $this->securityScheme);
    }

    /**
     * Tests if BasicSecurityScheme::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $this->securityScheme->setDescription('A description');

        $expectedResult = array(
            'type' => 'basic',
            'description' => 'A description',
        );

        $this->assertEquals($expectedResult, $this->securityScheme->jsonSerialize());
    }
}
