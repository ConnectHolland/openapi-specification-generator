<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Security;

use InvalidArgumentException;

/**
 * ApiKeySecurityScheme.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class ApiKeySecurityScheme extends AbstractSecurityScheme
{
    /**
     * @var string
     */
    const IN_QUERY = 'query';

    /**
     * @var string
     */
    const IN_HEADER = 'header';

    /**
     * The name of the header or query parameter to be used.
     *
     * @var string
     */
    private $name;

    /**
     * The location of the API key.
     *
     * @var string
     */
    private $in;

    /**
     * Constructs a new ApiKeySecurityScheme instance.
     *
     * @param string $identifier the identifier name for the security scheme
     * @param string $name       the name of the header or query parameter to be used
     * @param string $in         the location of the API key. Valid values are "query" or "header".
     *
     * @throws InvalidArgumentException
     */
    public function __construct($identifier, $name, $in)
    {
        if (in_array($in, array(self::IN_QUERY, self::IN_HEADER)) === false) {
            throw new InvalidArgumentException('Supplied SecurityScheme $in is not of type query or header.');
        }

        parent::__construct($identifier, self::TYPE_API_KEY);

        $this->name = $name;
        $this->in = $in;
    }

    /**
     * Returns the representation of this object for JSON encoding.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $securityScheme = parent::jsonSerialize();
        $securityScheme['name'] = $this->name;
        $securityScheme['in'] = $this->in;

        return $securityScheme;
    }
}
