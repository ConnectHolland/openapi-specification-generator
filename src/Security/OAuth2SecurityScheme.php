<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Security;

use InvalidArgumentException;

/**
 * OAuth2SecurityScheme.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class OAuth2SecurityScheme extends AbstractSecurityScheme
{
    /**
     * @var string
     */
    const FLOW_IMPLICIT = 'implicit';

    /**
     * @var string
     */
    const FLOW_PASSWORD = 'password';

    /**
     * @var string
     */
    const FLOW_APPLICATION = 'application';

    /**
     * @var string
     */
    const FLOW_ACCESS_CODE = 'accessCode';

    /**
     * The flow used by the OAuth2 security scheme.
     *
     * @var string
     */
    private $flow;

    /**
     * The authorization URL to be used for this flow.
     *
     * @var string|null
     */
    private $authorizationUrl;

    /**
     * The token URL to be used for this flow.
     *
     * @var string|null
     */
    private $tokenUrl;

    /**
     * The available scopes for the OAuth2 security scheme.
     *
     * @var Scopes
     */
    private $scopes;

    /**
     * Constructs a new OAuth2SecurityScheme instance.
     *
     * @param string      $identifier       the identifier name for the security scheme
     * @param string      $flow             the flow used by the OAuth2 security scheme. Valid values are "implicit", "password", "application" or "accessCode".
     * @param string|null $authorizationUrl the authorization URL to be used for this flow. This SHOULD be in the form of a URL.
     * @param string|null $tokenUrl         the token URL to be used for this flow. This SHOULD be in the form of a URL.
     * @param Scopes      $scopes           the available scopes for the OAuth2 security scheme
     *
     * @throws InvalidArgumentException
     */
    public function __construct($identifier, $flow, $authorizationUrl, $tokenUrl, Scopes $scopes)
    {
        if (in_array($flow, array(self::FLOW_IMPLICIT, self::FLOW_PASSWORD, self::FLOW_APPLICATION, self::FLOW_ACCESS_CODE)) === false) {
            throw new InvalidArgumentException('Supplied SecurityScheme flow is not of type implicit, password, application or accessCode.');
        }

        if (in_array($flow, array(self::FLOW_IMPLICIT, self::FLOW_ACCESS_CODE)) && isset($authorizationUrl) === false) {
            throw new InvalidArgumentException('The authorizationUrl is required for flow types implicit and accessCode.');
        }

        if (in_array($flow, array(self::FLOW_PASSWORD, self::FLOW_APPLICATION, self::FLOW_ACCESS_CODE)) && isset($tokenUrl) === false) {
            throw new InvalidArgumentException('The tokenUrl is required for flow types password, application and accessCode.');
        }

        parent::__construct($identifier, self::TYPE_OAUTH2);

        $this->flow = $flow;
        $this->authorizationUrl = $authorizationUrl;
        $this->tokenUrl = $tokenUrl;
        $this->scopes = $scopes;
    }

    /**
     * Returns the representation of this object for JSON encoding.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $securityScheme = parent::jsonSerialize();
        $securityScheme['flow'] = $this->flow;
        if (isset($this->authorizationUrl)) {
            $securityScheme['authorizationUrl'] = $this->authorizationUrl;
        }
        if (isset($this->tokenUrl)) {
            $securityScheme['tokenUrl'] = $this->tokenUrl;
        }
        $securityScheme['scopes'] = $this->scopes->jsonSerialize();

        return $securityScheme;
    }

    /**
     * Returns a new OAuth2SecurityScheme instance.
     *
     * @param string      $identifier       the identifier name for the security scheme
     * @param string      $flow             the flow used by the OAuth2 security scheme. Valid values are "implicit", "password", "application" or "accessCode".
     * @param string|null $authorizationUrl the authorization URL to be used for this flow. This SHOULD be in the form of a URL.
     * @param string|null $tokenUrl         the token URL to be used for this flow. This SHOULD be in the form of a URL.
     * @param Scopes      $scopes           the available scopes for the OAuth2 security scheme
     *
     * @throws InvalidArgumentException
     *
     * @return OAuth2SecurityScheme
     */
    public static function create($identifier, $flow, $authorizationUrl, $tokenUrl, Scopes $scopes)
    {
        return new self($identifier, $flow, $authorizationUrl, $tokenUrl, $scopes);
    }
}
