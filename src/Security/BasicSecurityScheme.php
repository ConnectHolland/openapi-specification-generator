<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Security;

/**
 * BasicSecurityScheme.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class BasicSecurityScheme extends AbstractSecurityScheme
{
    /**
     * Constructs a new BasicSecurityScheme instance.
     *
     * @param string $identifier the identifier name for the security scheme
     */
    public function __construct($identifier)
    {
        parent::__construct($identifier, self::TYPE_BASIC);
    }
}
