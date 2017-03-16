<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Security;

use ConnectHolland\OpenAPISpecificationGenerator\Security\Scopes;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * ScopesTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class ScopesTest extends PHPUnit_Framework_TestCase
{
    /**
     * The Scopes instance being tested.
     *
     * @var Scopes
     */
    private $scopes;

    /**
     * Creates a new Scopes instance for testing.
     */
    public function setUp()
    {
        parent::setUp();

        $this->scopes = new Scopes();
    }

    /**
     * Tests if Scopes::addScope adds the scope to the scopes instance property and returns the Scopes instance.
     */
    public function testAddScope()
    {
        $scopes = $this->scopes->addScope('write:pets', 'modify pets in your account');

        $this->assertSame($this->scopes, $scopes);
        $this->assertAttributeSame(
            array(
                'write:pets' => 'modify pets in your account',
            ),
            'scopes',
            $scopes
        );
    }

    /**
     * Tests if Scopes::getNames returns the names of the added scopes.
     *
     * @depends testAddScope
     */
    public function testGetNames()
    {
        $this->scopes->addScope('write:pets', 'modify pets in your account');

        $this->assertSame(array('write:pets'), $this->scopes->getNames());
    }

    /**
     * Tests if Scopes::jsonSerialize returns the expected result when empty.
     */
    public function testJsonSerializeEmpty()
    {
        $this->assertEquals(new stdClass(), $this->scopes->jsonSerialize());
    }

    /**
     * Tests if Scopes::jsonSerialize returns the expected result.
     *
     * @depends testAddScope
     */
    public function testJsonSerialize()
    {
        $this->scopes->addScope('write:pets', 'modify pets in your account');
        $this->scopes->addScope('read:pets', 'read your pets');

        $this->assertSame(
            array(
                'write:pets' => 'modify pets in your account',
                'read:pets' => 'read your pets',
            ),
            $this->scopes->jsonSerialize()
        );
    }
}
