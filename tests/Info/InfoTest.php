<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test\Info;

use ConnectHolland\OpenAPISpecificationGenerator\Info\Info;
use PHPUnit_Framework_TestCase;

/**
 * InfoTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class InfoTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if constructing a new Info instance sets the instance properties.
     */
    public function testConstruct()
    {
        $info = new Info('API', '1.0.0');

        $this->assertAttributeSame('API', 'title', $info);
        $this->assertAttributeSame('1.0.0', 'version', $info);
    }

    /**
     * Tests if Info::setDescription sets the instance property and returns the instance.
     */
    public function testSetDescription()
    {
        $info = new Info('API', '1.0.0');

        $this->assertSame($info, $info->setDescription('A description of the API.'));
        $this->assertAttributeSame('A description of the API.', 'description', $info);
    }

    /**
     * Tests if Info::setTermsOfService sets the instance property and returns the instance.
     */
    public function testSetTermsOfService()
    {
        $info = new Info('API', '1.0.0');

        $this->assertSame($info, $info->setTermsOfService('http://swagger.io/terms/'));
        $this->assertAttributeSame('http://swagger.io/terms/', 'termsOfService', $info);
    }

    /**
     * Tests if Info::setContact sets the instance property and returns the instance.
     */
    public function testSetContact()
    {
        $contactMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\Contact')
                ->disableOriginalConstructor()
                ->getMock();

        $info = new Info('API', '1.0.0');

        $this->assertSame($info, $info->setContact($contactMock));
        $this->assertAttributeSame($contactMock, 'contact', $info);
    }

    /**
     * Tests if Info::setLicense sets the instance property and returns the instance.
     */
    public function testSetLicense()
    {
        $licenseMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\License')
                ->disableOriginalConstructor()
                ->getMock();

        $info = new Info('API', '1.0.0');

        $this->assertSame($info, $info->setLicense($licenseMock));
        $this->assertAttributeSame($licenseMock, 'license', $info);
    }

    /**
     * Tests if Info::create returns a new Info instance and sets the instance properties.
     */
    public function testCreate()
    {
        $info = Info::create('API', '1.0.0');

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Info\Info', $info);
        $this->assertAttributeSame('API', 'title', $info);
        $this->assertAttributeSame('1.0.0', 'version', $info);
    }
}
