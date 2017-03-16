<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Security;

use ConnectHolland\OpenAPISpecificationGenerator\Security\OAuth2SecurityScheme;
use ConnectHolland\OpenAPISpecificationGenerator\Security\Scopes;
use ConnectHolland\OpenAPISpecificationGenerator\Security\SecuritySchemeInterface;
use stdClass;

/**
 * OAuth2SecuritySchemeTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class OAuth2SecuritySchemeTest extends AbstractSecuritySchemeTest
{
    /**
     * The Scopes instance mock used for testing.
     *
     * @var Scopes
     */
    private $scopesMock;

    /**
     * Creates a new OAuth2SecurityScheme instance for testing.
     */
    public function setUp()
    {
        parent::setUp();

        $this->scopesMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Security\Scopes')
            ->disableOriginalConstructor()
            ->getMock();

        $this->securityScheme = new OAuth2SecurityScheme(
            'foo',
            OAuth2SecurityScheme::FLOW_ACCESS_CODE,
            'https://github.com/login/oauth/authorize',
            'https://github.com/login/oauth/access_token',
            $this->scopesMock
        );
    }

    /**
     * Tests if constructing a new OAuth2SecurityScheme instance sets the instance properties.
     */
    public function testConstruct()
    {
        $this->assertAttributeSame('foo', 'identifier', $this->securityScheme);
        $this->assertAttributeSame(SecuritySchemeInterface::TYPE_OAUTH2, 'type', $this->securityScheme);
        $this->assertAttributeSame(OAuth2SecurityScheme::FLOW_ACCESS_CODE, 'flow', $this->securityScheme);
        $this->assertAttributeSame('https://github.com/login/oauth/authorize', 'authorizationUrl', $this->securityScheme);
        $this->assertAttributeSame('https://github.com/login/oauth/access_token', 'tokenUrl', $this->securityScheme);
        $this->assertAttributeSame($this->scopesMock, 'scopes', $this->securityScheme);
    }

    /**
     * Tests if constructing a new OAuth2SecurityScheme instance with
     * invalid combinations of $flow, $authorizationUrl and $tokenUrl
     * throws an InvalidArgumentException.
     *
     * @dataProvider provideConstructThrowsInvalidArgumentExceptionCases
     *
     * @param string      $flow
     * @param string|null $authorizationUrl
     * @param string      $expectedExceptionMessage
     */
    public function testConstructThrowsInvalidArgumentException($flow, $authorizationUrl, $expectedExceptionMessage)
    {
        $this->setExpectedException('InvalidArgumentException', $expectedExceptionMessage);

        new OAuth2SecurityScheme('foo', $flow, $authorizationUrl, null, $this->scopesMock);
    }

    /**
     * Tests if OAuth2SecurityScheme::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $this->scopesMock->expects($this->once())
            ->method('jsonSerialize')
            ->willReturn(new stdClass());

        $this->securityScheme->setDescription('A description');

        $expectedResult = array(
            'type' => 'oauth2',
            'description' => 'A description',
            'flow' => 'accessCode',
            'authorizationUrl' => 'https://github.com/login/oauth/authorize',
            'tokenUrl' => 'https://github.com/login/oauth/access_token',
            'scopes' => new stdClass(),
        );

        $this->assertEquals($expectedResult, $this->securityScheme->jsonSerialize());
    }

    /**
     * Tests if OAuth2SecurityScheme::jsonSerialize returns the expected result through the json_encode function.
     *
     * @depends testJsonSerialize
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $this->scopesMock->expects($this->once())
            ->method('jsonSerialize')
            ->willReturn(
                array(
                    'write:pets' => 'modify pets in your account',
                    'read:pets' => 'read your pets',
                )
            );

        $this->securityScheme->setDescription('A description');

        $expectedResult = '{"type":"oauth2","description":"A description","flow":"accessCode","authorizationUrl":"https://github.com/login/oauth/authorize","tokenUrl":"https://github.com/login/oauth/access_token","scopes":{"write:pets":"modify pets in your account","read:pets":"read your pets"}}';

        $this->assertEquals($expectedResult, json_encode($this->securityScheme, JSON_UNESCAPED_SLASHES));
    }

    /**
     * Tests if OAuth2SecurityScheme::jsonSerialize returns the expected result for "implicit" flow.
     *
     * @depends testJsonSerialize
     */
    public function testJsonSerializeImplicit()
    {
        $this->scopesMock->expects($this->once())
            ->method('jsonSerialize')
            ->willReturn(new stdClass());

        $securityScheme = new OAuth2SecurityScheme('foo', OAuth2SecurityScheme::FLOW_IMPLICIT, 'https://github.com/login/oauth/authorize', null, $this->scopesMock);

        $expectedResult = array(
            'type' => 'oauth2',
            'flow' => 'implicit',
            'authorizationUrl' => 'https://github.com/login/oauth/authorize',
            'scopes' => new stdClass(),
        );

        $this->assertEquals($expectedResult, $securityScheme->jsonSerialize());
    }

    /**
     * Tests if OAuth2SecurityScheme::jsonSerialize returns the expected result for "password" flow.
     *
     * @depends testJsonSerialize
     */
    public function testJsonSerializePassword()
    {
        $this->scopesMock->expects($this->once())
            ->method('jsonSerialize')
            ->willReturn(new stdClass());

        $securityScheme = new OAuth2SecurityScheme('foo', OAuth2SecurityScheme::FLOW_PASSWORD, null, 'https://github.com/login/oauth/access_token', $this->scopesMock);

        $expectedResult = array(
            'type' => 'oauth2',
            'flow' => 'password',
            'tokenUrl' => 'https://github.com/login/oauth/access_token',
            'scopes' => new stdClass(),
        );

        $this->assertEquals($expectedResult, $securityScheme->jsonSerialize());
    }

    /**
     * Tests if OAuth2SecurityScheme::jsonSerialize returns the expected result for "application" flow.
     *
     * @depends testJsonSerialize
     */
    public function testJsonSerializeApplication()
    {
        $this->scopesMock->expects($this->once())
            ->method('jsonSerialize')
            ->willReturn(new stdClass());

        $securityScheme = new OAuth2SecurityScheme('foo', OAuth2SecurityScheme::FLOW_APPLICATION, null, 'https://github.com/login/oauth/access_token', $this->scopesMock);

        $expectedResult = array(
            'type' => 'oauth2',
            'flow' => 'application',
            'tokenUrl' => 'https://github.com/login/oauth/access_token',
            'scopes' => new stdClass(),
        );

        $this->assertEquals($expectedResult, $securityScheme->jsonSerialize());
    }

    /**
     * Tests if OAuth2SecurityScheme::create returns a new OAuth2SecurityScheme instance and sets the instance properties.
     */
    public function testCreate()
    {
        $securityScheme = OAuth2SecurityScheme::create(
            'foo',
            OAuth2SecurityScheme::FLOW_ACCESS_CODE,
            'https://github.com/login/oauth/authorize',
            'https://github.com/login/oauth/access_token',
            $this->scopesMock
        );

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Security\OAuth2SecurityScheme', $securityScheme);
        $this->assertAttributeSame('foo', 'identifier', $this->securityScheme);
        $this->assertAttributeSame(SecuritySchemeInterface::TYPE_OAUTH2, 'type', $this->securityScheme);
        $this->assertAttributeSame(OAuth2SecurityScheme::FLOW_ACCESS_CODE, 'flow', $this->securityScheme);
        $this->assertAttributeSame('https://github.com/login/oauth/authorize', 'authorizationUrl', $this->securityScheme);
        $this->assertAttributeSame('https://github.com/login/oauth/access_token', 'tokenUrl', $this->securityScheme);
        $this->assertAttributeSame($this->scopesMock, 'scopes', $this->securityScheme);
    }

    /**
     * Returns a list with cases that should throw an InvalidArgumentException with specific exception message during construction of a OAuth2SecurityScheme.
     *
     * @return array
     */
    public function provideConstructThrowsInvalidArgumentExceptionCases()
    {
        $expectedFlowExceptionMessage = 'Supplied SecurityScheme flow is not of type implicit, password, application or accessCode.';
        $expectedAuthorizationUrlExceptionMessage = 'The authorizationUrl is required for flow types implicit and accessCode.';
        $expectedTokenUrlExceptionMessage = 'The tokenUrl is required for flow types password, application and accessCode.';

        return array(
            array(
                'invalid',
                'https://github.com/login/oauth/authorize',
                $expectedFlowExceptionMessage,
            ),
            array(
                OAuth2SecurityScheme::FLOW_IMPLICIT,
                null,
                $expectedAuthorizationUrlExceptionMessage,
            ),
            array(
                OAuth2SecurityScheme::FLOW_ACCESS_CODE,
                null,
                $expectedAuthorizationUrlExceptionMessage,
            ),
            array(
                OAuth2SecurityScheme::FLOW_PASSWORD,
                null,
                $expectedTokenUrlExceptionMessage,
            ),
            array(
                OAuth2SecurityScheme::FLOW_APPLICATION,
                null,
                $expectedTokenUrlExceptionMessage,
            ),
            array(
                OAuth2SecurityScheme::FLOW_ACCESS_CODE,
                'https://github.com/login/oauth/authorize',
                $expectedTokenUrlExceptionMessage,
            ),
        );
    }
}
