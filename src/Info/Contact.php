<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Info;

/**
 * Contact.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class Contact
{
    /**
     * The identifying name of the contact person/organization.
     *
     * @var string
     */
    private $name;

    /**
     * The URL pointing to the contact information. MUST be in the format of a URL.
     *
     * @var string
     */
    private $url;

    /**
     * The email address of the contact person/organization. MUST be in the format of an email address.
     *
     * @var string
     */
    private $email;

    /**
     * Constructs a new Contact instance.
     *
     * @param string $name  The identifying name of the contact person/organization.
     * @param string $url   The URL pointing to the contact information. MUST be in the format of a URL.
     * @param string $email The email address of the contact person/organization. MUST be in the format of an email address.
     */
    public function __construct($name = null, $url = null, $email = null)
    {
        $this->name = $name;
        $this->url = $url;
        $this->email = $email;
    }

    /**
     * Returns a new Contact instance.
     *
     * @param string $name  The identifying name of the contact person/organization.
     * @param string $url   The URL pointing to the contact information. MUST be in the format of a URL.
     * @param string $email The email address of the contact person/organization. MUST be in the format of an email address.
     *
     * @return Contact
     */
    public static function create($name = null, $url = null, $email = null)
    {
        return new self($name, $url, $email);
    }
}
