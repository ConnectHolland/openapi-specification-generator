<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Info;

/**
 * Info.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class Info
{
    /**
     * The title of the application.
     *
     * @var string
     */
    private $title;

    /**
     * A short description of the application.
     *
     * @var string
     */
    private $description;

    /**
     * The Terms of Service for the API.
     *
     * @var string
     */
    private $termsOfService;

    /**
     * The contact information for the exposed API.
     *
     * @var Contact
     */
    private $contact;

    /**
     * The license information for the exposed API.
     *
     * @var License
     */
    private $license;

    /**
     * The version of the application API (not to be confused with the specification version).
     *
     * @var string
     */
    private $version;

    /**
     * Constructs a new Info instance.
     *
     * @param string $title   The title of the application.
     * @param string $version The version of the application API (not to be confused with the specification version).
     */
    public function __construct($title, $version)
    {
        $this->title = $title;
        $this->version = $version;
    }

    /**
     * Sets the short description of the application.
     *
     * @param string $description A short description of the application.
     *
     * @return Info
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Sets the Terms of Service for the API.
     *
     * @param string $termsOfService The Terms of Service for the API.
     *
     * @return Info
     */
    public function setTermsOfService($termsOfService)
    {
        $this->termsOfService = $termsOfService;

        return $this;
    }

    /**
     * Sets the contact information for the exposed API.
     *
     * @param Contact $contact The contact information for the exposed API.
     *
     * @return Info
     */
    public function setContact(Contact $contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Sets the license information for the exposed API.
     *
     * @param License $license The license information for the exposed API.
     *
     * @return Info
     */
    public function setLicense(License $license)
    {
        $this->license = $license;

        return $this;
    }

    /**
     * Returns a new Info instance.
     *
     * @param string $title   The title of the application.
     * @param string $version Provides the version of the application API (not to be confused with the specification version).
     *
     * @return Info
     */
    public static function create($title, $version)
    {
        return new self($title, $version);
    }
}
