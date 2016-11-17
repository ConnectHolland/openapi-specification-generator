<?php

namespace ConnectHolland\OpenAPISpecificationGenerator\Test;

use ConnectHolland\OpenAPISpecificationGenerator\Info\Contact;
use ConnectHolland\OpenAPISpecificationGenerator\Info\Info;
use ConnectHolland\OpenAPISpecificationGenerator\Info\License;
use ConnectHolland\OpenAPISpecificationGenerator\Parameter\BodyParameter;
use ConnectHolland\OpenAPISpecificationGenerator\Parameter\FormDataParameter;
use ConnectHolland\OpenAPISpecificationGenerator\Parameter\PathParameter;
use ConnectHolland\OpenAPISpecificationGenerator\Parameter\QueryParameter;
use ConnectHolland\OpenAPISpecificationGenerator\Path\Operation;
use ConnectHolland\OpenAPISpecificationGenerator\Path\PathItem;
use ConnectHolland\OpenAPISpecificationGenerator\Path\Response\Response;
use ConnectHolland\OpenAPISpecificationGenerator\Path\Responses;
use ConnectHolland\OpenAPISpecificationGenerator\Schema\ArrayElement;
use ConnectHolland\OpenAPISpecificationGenerator\Schema\ObjectElement;
use ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\DoubleElement;
use ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\IntegerElement;
use ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\LongElement;
use ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\StringElement;
use ConnectHolland\OpenAPISpecificationGenerator\Schema\ReferenceElement;
use ConnectHolland\OpenAPISpecificationGenerator\Specification;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * SpecificationTest.
 *
 * @author Niels Nijens <niels@connectholland.nl>
 */
class SpecificationTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if constructing a new Specification instance sets the instance properties.
     */
    public function testConstruct()
    {
        $infoMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\Info')
                ->disableOriginalConstructor()
                ->getMock();

        $specification = new Specification($infoMock);

        $this->assertAttributeSame($infoMock, 'info', $specification);
    }

    /**
     * Tests if Specification::setHost sets the instance property and returns the Specification instance.
     */
    public function testSetHost()
    {
        $infoMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\Info')
                ->disableOriginalConstructor()
                ->getMock();

        $specification = new Specification($infoMock);

        $this->assertSame($specification, $specification->setHost('api.example.com'));
        $this->assertAttributeSame('api.example.com', 'host', $specification);
    }

    /**
     * Tests if Specification::setBasePath sets the instance property and returns the Specification instance.
     */
    public function testSetBasePath()
    {
        $infoMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\Info')
                ->disableOriginalConstructor()
                ->getMock();

        $specification = new Specification($infoMock);

        $this->assertSame($specification, $specification->setBasePath('/awesome/api'));
        $this->assertAttributeSame('/awesome/api', 'basePath', $specification);
    }

    /**
     * Tests if Specification::setSchemes sets the instance property and returns the Specification instance.
     */
    public function testSetSchemes()
    {
        $infoMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\Info')
                ->disableOriginalConstructor()
                ->getMock();

        $specification = new Specification($infoMock);

        $this->assertSame($specification, $specification->setSchemes(array('https')));
        $this->assertAttributeSame(array('https'), 'schemes', $specification);
    }

    /**
     * Tests if Specification::setConsumes sets the instance property and returns the Specification instance.
     */
    public function testSetConsumes()
    {
        $infoMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\Info')
                ->disableOriginalConstructor()
                ->getMock();

        $specification = new Specification($infoMock);

        $this->assertSame($specification, $specification->setConsumes(array('application/json')));
        $this->assertAttributeSame(array('application/json'), 'consumes', $specification);
    }

    /**
     * Tests if Specification::setProduces sets the instance property and returns the Specification instance.
     */
    public function testSetProduces()
    {
        $infoMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\Info')
                ->disableOriginalConstructor()
                ->getMock();

        $specification = new Specification($infoMock);

        $this->assertSame($specification, $specification->setProduces(array('application/json')));
        $this->assertAttributeSame(array('application/json'), 'produces', $specification);
    }

    /**
     * Tests if Specification::setPath sets the instance property and returns the Specification instance.
     */
    public function testSetPath()
    {
        $infoMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\Info')
                ->disableOriginalConstructor()
                ->getMock();

        $pathItemMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Path\PathItem')
                ->disableOriginalConstructor()
                ->getMock();

        $specification = new Specification($infoMock);

        $this->assertSame($specification, $specification->setPath('/path', $pathItemMock));
        $this->assertAttributeSame(array('/path' => $pathItemMock), 'paths', $specification);
    }

    /**
     * Tests if Specification::setDefinition sets the instance property and returns the Specification instance.
     */
    public function testSetDefinition()
    {
        $infoMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\Info')
                ->disableOriginalConstructor()
                ->getMock();

        $schemaElementMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Schema\SchemaElementInterface')
                ->disableOriginalConstructor()
                ->getMock();

        $specification = new Specification($infoMock);

        $this->assertSame($specification, $specification->setDefinition('someObject', $schemaElementMock));
        $this->assertAttributeSame(array('someObject' => $schemaElementMock), 'definitions', $specification);
    }

    /**
     * Tests if Specification::jsonSerialize returns the expected result.
     */
    public function testJsonSerialize()
    {
        $infoMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\Info')
                ->disableOriginalConstructor()
                ->getMock();
        $infoMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('title' => 'API', 'version' => '1.0'));

        $specification = new Specification($infoMock);

        $expectedResult = array(
            'swagger' => '2.0',
            'info' => array(
                'title' => 'API',
                'version' => '1.0',
            ),
            'paths' => new stdClass(),
        );

        $this->assertEquals($expectedResult, $specification->jsonSerialize());
    }

    /**
     * Tests if Specification::jsonSerialize returns the expected JSON encoded result through the json_encode function.
     *
     * @depends testJsonSerialize
     */
    public function testJsonSerializeThroughJsonEncode()
    {
        $infoMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\Info')
                ->disableOriginalConstructor()
                ->getMock();
        $infoMock->expects($this->once())
                ->method('jsonSerialize')
                ->willReturn(array('title' => 'API', 'version' => '1.0'));

        $specification = new Specification($infoMock);

        $expectedResult = '{"swagger":"2.0","info":{"title":"API","version":"1.0"},"paths":{}}';

        $this->assertJsonStringEqualsJsonString($expectedResult, json_encode($specification));
    }

    /**
     * Tests if Specification::create returns a new Specification instance and sets the instance properties.
     */
    public function testCreate()
    {
        $infoMock = $this->getMockBuilder('ConnectHolland\OpenAPISpecificationGenerator\Info\Info')
                ->disableOriginalConstructor()
                ->getMock();

        $specification = Specification::create($infoMock);

        $this->assertInstanceOf('ConnectHolland\OpenAPISpecificationGenerator\Specification', $specification);
        $this->assertAttributeSame($infoMock, 'info', $specification);
    }

    /**
     * Tests if Specification::jsonSerialize returns the expected JSON encoded result through the json_encode function with the Uber API specification example.
     *
     * @link http://editor.swagger.io/ The editor containing the specification example
     *
     * @depends testJsonSerializeThroughJsonEncode
     */
    public function testJsonSerializeThroughJsonEncodeWithUberAPISpecificationExample()
    {
        $info = Info::create('Uber API', '1.0.0')
                ->setDescription('Move your app forward with the Uber API');

        $specification = Specification::create($info)
                ->setHost('api.uber.com')
                ->setSchemes(array('https'))
                ->setBasePath('/v1')
                ->setProduces(array('application/json'));

        $specification->setPath('/products', PathItem::create()
                ->setGet(
                    Operation::create(
                        Responses::create()
                            ->setDefault(
                                Response::create('Unexpected error')
                                    ->setSchema(ReferenceElement::create('Error'))
                            )
                            ->setResponse(Response::HTTP_OK,
                                Response::create('An array of products')
                                    ->setSchema(
                                        ArrayElement::create()
                                            ->setItems(
                                                ReferenceElement::create('Product')
                                            )
                                    )
                            )
                    )
                    ->setSummary('Product Types')
                    ->setDescription("The Products endpoint returns information about the *Uber* products\noffered at a given location. The response includes the display name\nand other details about each product, and lists the products in the\nproper display order.\n")
                    ->addParameter(
                        QueryParameter::create('latitude', DoubleElement::create())
                            ->setDescription('Latitude component of location.')
                            ->setRequired(true)
                    )
                    ->addParameter(
                        QueryParameter::create('longitude', DoubleElement::create())
                            ->setDescription('Longitude component of location.')
                            ->setRequired(true)
                    )
                    ->setTags(array('Products'))
                ));

        $specification->setPath('/estimates/price', PathItem::create()
                ->setGet(
                    Operation::create(
                        Responses::create()
                            ->setDefault(
                                Response::create('Unexpected error')
                                    ->setSchema(ReferenceElement::create('Error'))
                            )
                            ->setResponse(Response::HTTP_OK,
                                Response::create('An array of price estimates by product')
                                    ->setSchema(
                                        ArrayElement::create()
                                            ->setItems(
                                                ReferenceElement::create('PriceEstimate')
                                            )
                                    )
                            )
                    )
                    ->setSummary('Price Estimates')
                    ->setDescription("The Price Estimates endpoint returns an estimated price range\nfor each product offered at a given location. The price estimate is\nprovided as a formatted string with the full price range and the localized\ncurrency symbol.<br><br>The response also includes low and high estimates,\nand the [ISO 4217](http://en.wikipedia.org/wiki/ISO_4217) currency code for\nsituations requiring currency conversion. When surge is active for a particular\nproduct, its surge_multiplier will be greater than 1, but the price estimate\nalready factors in this multiplier.\n")
                    ->addParameter(
                        QueryParameter::create('start_latitude', DoubleElement::create())
                            ->setDescription('Latitude component of start location.')
                            ->setRequired(true)
                    )
                    ->addParameter(
                        QueryParameter::create('start_longitude', DoubleElement::create())
                            ->setDescription('Longitude component of start location.')
                            ->setRequired(true)
                    )
                    ->addParameter(
                        QueryParameter::create('end_latitude', DoubleElement::create())
                            ->setDescription('Latitude component of end location.')
                            ->setRequired(true)
                    )
                    ->addParameter(
                        QueryParameter::create('end_longitude', DoubleElement::create())
                            ->setDescription('Longitude component of end location.')
                            ->setRequired(true)
                    )
                    ->setTags(array('Estimates'))
                ));

        $specification->setPath('/estimates/time', PathItem::create()
                ->setGet(
                    Operation::create(
                        Responses::create()
                            ->setDefault(
                                Response::create('Unexpected error')
                                    ->setSchema(ReferenceElement::create('Error'))
                            )
                            ->setResponse(Response::HTTP_OK,
                                Response::create('An array of products')
                                    ->setSchema(
                                        ArrayElement::create()
                                            ->setItems(
                                                ReferenceElement::create('Product')
                                            )
                                    )
                            )
                    )
                    ->setSummary('Time Estimates')
                    ->setDescription('The Time Estimates endpoint returns ETAs for all products offered at a given location, with the responses expressed as integers in seconds. We recommend that this endpoint be called every minute to provide the most accurate, up-to-date ETAs.')
                    ->addParameter(
                        QueryParameter::create('start_latitude', DoubleElement::create())
                            ->setDescription('Latitude component of start location.')
                            ->setRequired(true)
                    )
                    ->addParameter(
                        QueryParameter::create('start_longitude', DoubleElement::create())
                            ->setDescription('Longitude component of start location.')
                            ->setRequired(true)
                    )
                    ->addParameter(
                        QueryParameter::create('customer_uuid', StringElement::create()
                                ->setFormat('uuid')
                            )
                            ->setDescription('Unique customer identifier to be used for experience customization.')
                    )
                    ->addParameter(
                        QueryParameter::create('product_id', StringElement::create())
                            ->setDescription('Unique identifier representing a specific product for a given latitude & longitude.')
                    )
                    ->setTags(array('Estimates'))
                ));

        $specification->setPath('/me', PathItem::create()
                ->setGet(
                    Operation::create(
                        Responses::create()
                            ->setDefault(
                                Response::create('Unexpected error')
                                    ->setSchema(ReferenceElement::create('Error'))
                            )
                            ->setResponse(Response::HTTP_OK,
                                Response::create('Profile information for a user')
                                    ->setSchema(
                                        ArrayElement::create()
                                            ->setItems(
                                                ReferenceElement::create('Profile')
                                            )
                                    )
                            )
                    )
                    ->setSummary('User Profile')
                    ->setDescription('The User Profile endpoint returns information about the Uber user that has authorized with the application.')
                    ->setTags(array('User'))
                ));

        $specification->setPath('/history', PathItem::create()
                ->setGet(
                    Operation::create(
                        Responses::create()
                            ->setDefault(
                                Response::create('Unexpected error')
                                    ->setSchema(ReferenceElement::create('Error'))
                            )
                            ->setResponse(Response::HTTP_OK,
                                Response::create('History information for the given user')
                                    ->setSchema(
                                        ArrayElement::create()
                                            ->setItems(
                                                ReferenceElement::create('Activities')
                                            )
                                    )
                            )
                    )
                    ->setSummary('User Activity')
                    ->setDescription("The User Activity endpoint returns data about a user's lifetime activity with Uber. The response will include pickup locations and times, dropoff locations and times, the distance of past requests, and information about which products were requested.<br><br>The history array in the response will have a maximum length based on the limit parameter. The response value count may exceed limit, therefore subsequent API requests may be necessary.")
                    ->addParameter(
                        QueryParameter::create('offset', IntegerElement::create())
                            ->setDescription('Offset the list of returned results by this amount. Default is zero.')
                    )
                    ->addParameter(
                        QueryParameter::create('limit', IntegerElement::create())
                            ->setDescription('Number of items to retrieve. Default is 5, maximum is 100.')
                    )
                    ->setTags(array('User'))
                ));

        $specification->setDefinition('Product',
                ObjectElement::create()
                    ->addProperty('product_id', StringElement::create()
                        ->setDescription('Unique identifier representing a specific product for a given latitude & longitude. For example, uberX in San Francisco will have a different product_id than uberX in Los Angeles.')
                    )
                    ->addProperty('description', StringElement::create()
                        ->setDescription('Description of product.')
                    )
                    ->addProperty('display_name', StringElement::create()
                        ->setDescription('Display name of product.')
                    )
                    ->addProperty('capacity', StringElement::create()
                        ->setDescription('Capacity of product. For example, 4 people.')
                    )
                    ->addProperty('image', StringElement::create()
                        ->setDescription('Image URL representing the product.')
                    )
            );

        $specification->setDefinition('PriceEstimate',
                ObjectElement::create()
                    ->addProperty('product_id', StringElement::create()
                        ->setDescription('Unique identifier representing a specific product for a given latitude & longitude. For example, uberX in San Francisco will have a different product_id than uberX in Los Angeles.')
                    )
                    ->addProperty('currency_code', StringElement::create()
                        ->setDescription('[ISO 4217](http://en.wikipedia.org/wiki/ISO_4217) currency code.')
                    )
                    ->addProperty('display_name', StringElement::create()
                        ->setDescription('Display name of product.')
                    )
                    ->addProperty('estimate', StringElement::create()
                        ->setDescription('Formatted string of estimate in local currency of the start location. Estimate could be a range, a single number (flat rate) or "Metered" for TAXI.')
                    )
                    ->addProperty('low_estimate', DoubleElement::create()
                            ->setFormat(null)
                        ->setDescription('Lower bound of the estimated price.')
                    )
                    ->addProperty('high_estimate', DoubleElement::create()
                            ->setFormat(null)
                        ->setDescription('Upper bound of the estimated price.')
                    )
                    ->addProperty('surge_multiplier', DoubleElement::create()
                            ->setFormat(null)
                        ->setDescription('Expected surge multiplier. Surge is active if surge_multiplier is greater than 1. Price estimate already factors in the surge multiplier.')
                    )
            );

        $specification->setDefinition('Profile',
                ObjectElement::create()
                    ->addProperty('first_name', StringElement::create()
                        ->setDescription('First name of the Uber user.')
                    )
                    ->addProperty('last_name', StringElement::create()
                        ->setDescription('Last name of the Uber user.')
                    )
                    ->addProperty('email', StringElement::create()
                        ->setDescription('Email address of the Uber user')
                    )
                    ->addProperty('picture', StringElement::create()
                        ->setDescription('Image URL of the Uber user.')
                    )
                    ->addProperty('promo_code', StringElement::create()
                        ->setDescription('Promo code of the Uber user.')
                    )
            );

        $specification->setDefinition('Activity',
                ObjectElement::create()
                    ->addProperty('uuid', StringElement::create()
                        ->setDescription('Unique identifier for the activity')
                    )
            );

        $specification->setDefinition('Activities',
                ObjectElement::create()
                    ->addProperty('offset', IntegerElement::create()
                        ->setDescription('Position in pagination.')
                    )
                    ->addProperty('limit', IntegerElement::create()
                        ->setDescription('Number of items to retrieve (100 max).')
                    )
                    ->addProperty('count', IntegerElement::create()
                        ->setDescription('Total number of items available.')
                    )
                    ->addProperty('history', ArrayElement::create()
                        ->setItems(ReferenceElement::create('Activity'))
                        ->setDescription('Total number of items available.')
                    )
            );

        $specification->setDefinition('Error',
                ObjectElement::create()
                    ->addProperty('code', IntegerElement::create())
                    ->addProperty('message', StringElement::create())
                    ->addProperty('fields', StringElement::create())
            );

        $this->assertJsonStringEqualsJsonFile(__DIR__.'/fixtures/uber-api-swagger.json', json_encode($specification, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

    /**
     * Tests if Specification::jsonSerialize returns the expected JSON encoded result through the json_encode function with the Echo specification example.
     *
     * @link http://editor.swagger.io/ The editor containing the specification example
     *
     * @depends testJsonSerializeThroughJsonEncode
     */
    public function testJsonSerializeThroughJsonEncodeWithEchoSpecificationExample()
    {
        $info = Info::create('Echo', '1.0.0')
                ->setDescription("#### Echos back every URL, method, parameter and header\nFeel free to make a path or an operation and use **Try Operation** to test it. The echo server will\nrender back everything.\n");

        $specification = Specification::create($info)
                ->setHost('mazimi-prod.apigee.net')
                ->setSchemes(array('http'))
                ->setBasePath('/echo');

        $specification->setPath('/', PathItem::create()
                ->setGet(
                    Operation::create(
                        Responses::create()
                            ->setResponse(Response::HTTP_OK, Response::create('Echo GET'))
                    )
                )
                ->setPost(
                    Operation::create(
                        Responses::create()
                            ->setResponse(Response::HTTP_OK, Response::create('Echo POST'))
                    )
                    ->addParameter(
                        FormDataParameter::create('name', StringElement::create())
                            ->setDescription('name')
                    )
                    ->addParameter(
                        FormDataParameter::create('year', StringElement::create())
                            ->setDescription('year')
                    )
                ));

        $specification->setPath('/test-path/{id}', PathItem::create()
                ->setGet(Operation::create(
                        Responses::create()
                            ->setResponse(Response::HTTP_OK, Response::create('Echo test-path'))
                    )
                )
                ->setParameters(
                    array(
                        PathParameter::create('id', StringElement::create())->setDescription('ID'),
                    )
                )
            );

        $this->assertJsonStringEqualsJsonFile(__DIR__.'/fixtures/echo-swagger.json', json_encode($specification, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

    /**
     * Tests if Specification::jsonSerialize returns the expected JSON encoded result through the json_encode function with the Petstore (Simple) specification example.
     *
     * @link http://editor.swagger.io/ The editor containing the specification example
     *
     * @depends testJsonSerializeThroughJsonEncode
     */
    public function testJsonSerializeThroughJsonEncodeWithPetstoreSimpleSpecificationExample()
    {
        $info = Info::create('Swagger Petstore (Simple)', '1.0.0')
                ->setDescription('A sample API that uses a petstore as an example to demonstrate features in the swagger-2.0 specification')
                ->setTermsOfService('http://helloreverb.com/terms/')
                ->setContact(Contact::create('Swagger API team', 'http://swagger.io', 'foo@example.com'))
                ->setLicense(License::create('MIT', 'http://opensource.org/licenses/MIT'));

        $specification = Specification::create($info)
                ->setHost('petstore.swagger.io')
                ->setSchemes(array('http'))
                ->setBasePath('/api')
                ->setConsumes(array('application/json'))
                ->setProduces(array('application/json'));

        $specification->setPath('/pets', PathItem::create()
                ->setGet(
                    Operation::create(
                        Responses::create()
                            ->setDefault(
                                Response::create('unexpected error')
                                    ->setSchema(ReferenceElement::create('errorModel'))
                            )
                            ->setResponse(Response::HTTP_OK,
                                Response::create('pet response')
                                    ->setSchema(
                                        ArrayElement::create()
                                            ->setItems(
                                                ReferenceElement::create('pet')
                                            )
                                    )
                            )
                    )
                    ->setOperationId('findPets')
                    ->setDescription('Returns all pets from the system that the user has access to')
                    ->setProduces(array('application/json', 'application/xml', 'text/xml', 'text/html'))
                    ->addParameter(
                        QueryParameter::create('tags', ArrayElement::create()
                                ->setItems(StringElement::create())
                            )
                            ->setDescription('tags to filter by')
                    )
                    ->addParameter(
                        QueryParameter::create('limit', IntegerElement::create())
                            ->setDescription('maximum number of results to return')
                    )
                )
                ->setPost(
                    Operation::create(
                        Responses::create()
                            ->setDefault(
                                Response::create('unexpected error')
                                    ->setSchema(ReferenceElement::create('errorModel'))
                            )
                            ->setResponse(Response::HTTP_OK,
                                Response::create('pet response')
                                    ->setSchema(ReferenceElement::create('pet'))
                            )
                    )
                    ->setOperationId('addPet')
                    ->setDescription('Creates a new pet in the store.  Duplicates are allowed')
                    ->setProduces(array('application/json'))
                    ->addParameter(
                        BodyParameter::create('pet', ReferenceElement::create('newPet'))
                            ->setDescription('Pet to add to the store')
                            ->setRequired(true)
                    )
                ));

        $specification->setPath('/pets/{id}', PathItem::create()
                ->setGet(
                    Operation::create(
                        Responses::create()
                            ->setDefault(
                                Response::create('unexpected error')
                                    ->setSchema(ReferenceElement::create('errorModel'))
                            )
                            ->setResponse(Response::HTTP_OK,
                                Response::create('pet response')
                                    ->setSchema(
                                        ArrayElement::create()
                                            ->setItems(
                                                ReferenceElement::create('pet')
                                            )
                                    )
                            )
                    )
                    ->setOperationId('findPetById')
                    ->setDescription('Returns a user based on a single ID, if the user does not have access to the pet')
                    ->setProduces(array('application/json', 'application/xml', 'text/xml', 'text/html'))
                    ->addParameter(
                        PathParameter::create('id', LongElement::create())
                            ->setDescription('ID of pet to fetch')
                    )
                )
                ->setDelete(
                    Operation::create(
                        Responses::create()
                            ->setDefault(
                                Response::create('unexpected error')
                                    ->setSchema(ReferenceElement::create('errorModel'))
                            )
                            ->setResponse(Response::HTTP_NO_CONTENT,
                                Response::create('pet deleted')
                            )
                    )
                    ->setOperationId('deletePet')
                    ->setDescription('deletes a single pet based on the ID supplied')
                    ->addParameter(
                        PathParameter::create('id', LongElement::create('newPet'))
                            ->setDescription('ID of pet to delete')
                    )
                ));

        $specification->setDefinition('pet',
                ObjectElement::create()
                    ->addProperty('id', LongElement::create()
                        ->setRequired(true)
                    )
                    ->addProperty('name', StringElement::create()
                        ->setRequired(true)
                    )
                    ->addProperty('tag', StringElement::create())
            );

        $specification->setDefinition('newPet',
                ObjectElement::create()
                    ->addProperty('id', LongElement::create())
                    ->addProperty('name', StringElement::create()
                        ->setRequired(true)
                    )
                    ->addProperty('tag', StringElement::create())
            );

        $specification->setDefinition('errorModel',
                ObjectElement::create()
                    ->addProperty('code', IntegerElement::create()
                        ->setRequired(true)
                    )
                    ->addProperty('message', StringElement::create()
                        ->setRequired(true)
                    )
            );

        $this->assertJsonStringEqualsJsonFile(__DIR__.'/fixtures/petstore-simple-swagger.json', json_encode($specification, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}
