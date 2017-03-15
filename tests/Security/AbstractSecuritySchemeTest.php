<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Security;

use ConnectHolland\OpenAPISpecificationGenerator\Security\ApiKeySecurityScheme;
use ConnectHolland\OpenAPISpecificationGenerator\Security\BasicSecurityScheme;
use ConnectHolland\OpenAPISpecificationGenerator\Security\OAuth2SecurityScheme;
use PHPUnit_Framework_TestCase;

/**
 * AbstractSecuritySchemeTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
abstract class AbstractSecuritySchemeTest extends PHPUnit_Framework_TestCase
{
    /**
     * The security scheme instance being tested.
     *
     * @var BasicSecurityScheme|ApiKeySecurityScheme|OAuth2SecurityScheme
     */
    protected $securityScheme;

    /**
     * Tests if AbstractSecurityScheme::getIdentifier returns the identifier set during construction.
     */
    public function testGetIdentifier()
    {
        $this->assertSame('foo', $this->securityScheme->getIdentifier());
    }

    /**
     * Tests if AbstractSecurityScheme::setDescription sets the instance property and returns the AbstractSecurityScheme instance.
     */
    public function testSetDescription()
    {
        $securityScheme = $this->securityScheme->setDescription('A description');

        $this->assertSame($this->securityScheme, $securityScheme);
        $this->assertAttributeSame('A description', 'description', $securityScheme);
    }
}
