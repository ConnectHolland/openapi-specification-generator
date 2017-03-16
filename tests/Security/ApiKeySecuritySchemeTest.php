<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Security;

use ConnectHolland\OpenAPISpecificationGenerator\Security\ApiKeySecurityScheme;
use ConnectHolland\OpenAPISpecificationGenerator\Security\SecuritySchemeInterface;

/**
 * ApiKeySecuritySchemeTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class ApiKeySecuritySchemeTest extends AbstractSecuritySchemeTest
{
    /**
     * Creates a new ApiKeySecurityScheme instance for testing.
     */
    public function setUp()
    {
        parent::setUp();

        $this->securityScheme = new ApiKeySecurityScheme('foo', 'X-Test-Header', ApiKeySecurityScheme::IN_HEADER);
    }

    /**
     * Tests if constructing a new ApiKeySecurityScheme instance sets the instance properties.
     */
    public function testConstruct()
    {
        $this->assertAttributeSame('foo', 'identifier', $this->securityScheme);
        $this->assertAttributeSame(SecuritySchemeInterface::TYPE_API_KEY, 'type', $this->securityScheme);
        $this->assertAttributeSame('X-Test-Header', 'name', $this->securityScheme);
        $this->assertAttributeSame(ApiKeySecurityScheme::IN_HEADER, 'in', $this->securityScheme);
    }

    /**
     * Tests if constructing a new ApiKeySecurityScheme instance with invalid $in argument throws an InvalidArgumentException.
     */
    public function testConstuctThrowsInvalidArgumentExceptionForInvalidInType()
    {
        $this->setExpectedException('InvalidArgumentException', 'Supplied SecurityScheme $in is not of type query or header.');

        new ApiKeySecurityScheme('foo', 'X-Test-Header', 'invalid');
    }

    /**
     * Tests if ApiKeySecurityScheme::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $this->securityScheme->setDescription('A description');

        $expectedResult = array(
            'type' => 'apiKey',
            'description' => 'A description',
            'name' => 'X-Test-Header',
            'in' => 'header',
        );

        $this->assertEquals($expectedResult, $this->securityScheme->jsonSerialize());
    }

    /**
     * Tests if ApiKeySecurityScheme::create returns a new ApiKeySecurityScheme instance and sets the instance properties.
     */
    public function testCreate()
    {
        $securityScheme = ApiKeySecurityScheme::create('foo', 'X-Test-Header', ApiKeySecurityScheme::IN_HEADER);

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Security\ApiKeySecurityScheme', $securityScheme);
        $this->assertAttributeSame('foo', 'identifier', $this->securityScheme);
        $this->assertAttributeSame(SecuritySchemeInterface::TYPE_API_KEY, 'type', $this->securityScheme);
        $this->assertAttributeSame('X-Test-Header', 'name', $this->securityScheme);
        $this->assertAttributeSame(ApiKeySecurityScheme::IN_HEADER, 'in', $this->securityScheme);
    }
}
