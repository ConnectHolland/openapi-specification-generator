<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Info;

use ConnectHolland\OpenAPISpecificationGenerator\Info\Contact;
use PHPUnit_Framework_TestCase;

/**
 * ContactTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class ContactTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if constructing a new Contact instance sets the instance properties.
     */
    public function testConstruct()
    {
        $contact = new Contact('John Doe', 'http://support.example.com', 'john@example.com');

        $this->assertAttributeSame('John Doe', 'name', $contact);
        $this->assertAttributeSame('http://support.example.com', 'url', $contact);
        $this->assertAttributeSame('john@example.com', 'email', $contact);
    }

    /**
     * Tests if Contact::create returns a new Contact instance and sets the instance properties.
     */
    public function testCreate()
    {
        $contact = Contact::create('John Doe', 'http://support.example.com', 'john@example.com');

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Info\Contact', $contact);
        $this->assertAttributeSame('John Doe', 'name', $contact);
        $this->assertAttributeSame('http://support.example.com', 'url', $contact);
        $this->assertAttributeSame('john@example.com', 'email', $contact);
    }
}
