<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Security;

use ConnectHolland\OpenAPISpecificationGenerator\Security\SecurityRequirement;
use PHPUnit_Framework_TestCase;

/**
 * SecurityRequirementTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class SecurityRequirementTest extends PHPUnit_Framework_TestCase
{
    /**
     * The SecurityRequirement instance being tested.
     *
     * @var SecurityRequirement
     */
    private $securityRequirement;

    /**
     * Creates a SecurityRequirement instance for testing.
     */
    public function setUp()
    {
        parent::setUp();

        $this->securityRequirement = new SecurityRequirement('auth');
    }

    /**
     * Tests if constructing a new SecurityRequirement instance sets
     * the instance properties.
     */
    public function testConstruct()
    {
        $this->assertAttributeSame('auth', 'identifier', $this->securityRequirement);
    }

    /**
     * Tests if constructing a new SecurityRequirement instance with
     * SecuritySchemeInterface instance sets the identifier
     * to the instance property.
     *
     * @depends testConstruct
     */
    public function testConstructWithSecurityScheme()
    {
        $securitySchemeMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Security\SecuritySchemeInterface')
            ->getMock();
        $securitySchemeMock->expects($this->once())
            ->method('getIdentifier')
            ->willReturn('auth');

        $securityRequirement = new SecurityRequirement($securitySchemeMock);

        $this->assertAttributeSame('auth', 'identifier', $securityRequirement);
    }

    /**
     * Tests if SecurityRequirement::getIdentifier returns the identifier
     * set during construction.
     */
    public function testGetIdentifier()
    {
        $this->assertSame('auth', $this->securityRequirement->getIdentifier());
    }

    /**
     * Tests if SecurityRequirement::setScopes sets the instance property
     * and returns the SecurityRequirement instance.
     */
    public function testSetScopes()
    {
        $scopesMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Security\Scopes')
            ->disableOriginalConstructor()
            ->getMock();

        $securityRequirement = $this->securityRequirement->setScopes($scopesMock);

        $this->assertSame($this->securityRequirement, $securityRequirement);
        $this->assertAttributeSame($scopesMock, 'scopes', $securityRequirement);
    }

    /**
     * Tests if SecurityRequirement::jsonSerialize returns the expected result.
     *
     * @depends testSetScopes
     */
    public function testJsonSerialize()
    {
        $scopesMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Security\Scopes')
            ->disableOriginalConstructor()
            ->getMock();
        $scopesMock->expects($this->once())
            ->method('getNames')
            ->willReturn(array('write:pets'));

        $this->securityRequirement->setScopes($scopesMock);

        $expectedResult = array(
            'auth' => array(
                'write:pets',
            ),
        );

        $this->assertEquals($expectedResult, $this->securityRequirement->jsonSerialize());
    }

    /**
     * Tests if SecurityRequirement::jsonSerialize returns the expected result.
     *
     * @depends testJsonSerialize
     */
    public function testJsonSerializeThoughJsonEncode()
    {
        $scopesMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Security\Scopes')
            ->disableOriginalConstructor()
            ->getMock();
        $scopesMock->expects($this->once())
            ->method('getNames')
            ->willReturn(array('write:pets'));

        $this->securityRequirement->setScopes($scopesMock);

        $expectedResult = '{"auth":["write:pets"]}';

        $this->assertEquals($expectedResult, json_encode($this->securityRequirement));
    }

    /**
     * Tests if SecurityRequirement::create returns a new
     * SecurityRequirement instance and sets the instance properties.
     */
    public function testCreate()
    {
        $securityRequirement = SecurityRequirement::create('auth');

        $this->assertAttributeSame('auth', 'identifier', $securityRequirement);
    }
}
