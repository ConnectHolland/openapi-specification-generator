<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Security;

use JsonSerializable;

/**
 * SecuritySchemeInterface.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
interface SecuritySchemeInterface extends JsonSerializable
{
    /**
     * @var string
     */
    const TYPE_BASIC = 'basic';

    /**
     * @var string
     */
    const TYPE_API_KEY = 'apiKey';

    /**
     * @var string
     */
    const TYPE_OAUTH2 = 'oauth2';

    /**
     * Returns the identifier name for the security scheme.
     *
     * @return string
     */
    public function getIdentifier();
}
