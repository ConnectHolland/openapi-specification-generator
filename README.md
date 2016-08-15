# OpenAPI specification generator for PHP

[![Latest version on Packagist][ico-version]][link-version]
[![Latest pre-release version on Packagist][ico-pre-release-version]][link-version]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-build]][link-build]
[![Coverage Status][ico-coverage]][link-coverage]
[![SensioLabsInsight][ico-insight]][link-insight]

With the OpenAPI specification generator you're able to create an [OpenAPI][link-openapi] (or [Swagger][link-swagger])
specification for your REST API in an object-oriented way.


## Installation using Composer
Run the following command to add the package to the composer.json of your project:

``` bash
$ composer require connectholland/openapi-specification-generator
```


## Usage
It's advisable to read the [OpenAPI specification][link-swagger-specification] before starting with your own API specification,
so you will have a general understanding of the different items within the specification.

All required OpenAPI properties are added as constructor arguments, so you won't accidently forget them and generate an invalid specification.

### Basic usage
The following example of the most minimal possible specification you can create.
``` php

use ConnectHolland\OpenAPISpecificationGenerator\Info\Info;
use ConnectHolland\OpenAPISpecificationGenerator\Specification;

$info = Info::create('My awesome API', '1.0.0');

$specification = Specification::create($info);
```

To turn the `Specification` instance into a JSON specification you can insert the instance into `json_encode`.
``` php

use ConnectHolland\OpenAPISpecificationGenerator\Info\Info;
use ConnectHolland\OpenAPISpecificationGenerator\Specification;

$info = Info::create('My awesome API', '1.0.0');

$specification = Specification::create($info);

echo json_encode($specification, JSON_PRETTY_PRINT);
```

The above code will generate the following valid API specification in JSON.
``` json
{
    "swagger": "2.0",
    "info": {
        "title": "My awesome API",
        "version": "1.0.0"
    },
    "paths": {}
}
```

Although the above API specification is valid, it's not very useful as it does not contain API endpoints. So, let's try an actual example.


### Echo API example
The Echo API example is available within the [Swagger editor][link-swagger-editor]. The following code shows how to generate this example.
``` php

use ConnectHolland\OpenAPISpecificationGenerator\Info\Info;
use ConnectHolland\OpenAPISpecificationGenerator\Parameter\FormDataParameter;
use ConnectHolland\OpenAPISpecificationGenerator\Parameter\PathParameter;
use ConnectHolland\OpenAPISpecificationGenerator\Path\Operation;
use ConnectHolland\OpenAPISpecificationGenerator\Path\PathItem;
use ConnectHolland\OpenAPISpecificationGenerator\Path\Response\Response;
use ConnectHolland\OpenAPISpecificationGenerator\Path\Responses;
use ConnectHolland\OpenAPISpecificationGenerator\Schema\Primitive\StringElement;
use ConnectHolland\OpenAPISpecificationGenerator\Specification;

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
    )
);

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

echo json_encode($specification, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
```

The resulting API specification can be found [here](tests/fixtures/echo-swagger.json).

More examples can be found within the [`Specification` test class](tests/SpecificationTest.php#L223-L721).


## Credits
This package is written and maintained by [Niels Nijens][link-author].

Also see the list of [contributors][link-contributors] who participated in this project.


## License
This package is licensed under the MIT License. Please see the [LICENSE file](LICENSE.md) for details.


[ico-version]: https://img.shields.io/packagist/v/connectholland/openapi-specification-generator.svg
[ico-pre-release-version]: https://img.shields.io/packagist/vpre/connectholland/openapi-specification-generator.svg
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg
[ico-build]: https://travis-ci.org/ConnectHolland/openapi-specification-generator.svg?branch=master
[ico-coverage]: https://coveralls.io/repos/ConnectHolland/openapi-specification-generator/badge.svg?branch=master
[ico-insight]: https://img.shields.io/sensiolabs/i/2aec62e8-9593-4452-a32c-0e344879f978.svg

[link-version]: https://packagist.org/packages/connectholland/openapi-specification-generator
[link-build]: https://travis-ci.org/ConnectHolland/openapi-specification-generator
[link-coverage]: https://coveralls.io/r/ConnectHolland/openapi-specification-generator?branch=master
[link-insight]: https://insight.sensiolabs.com/projects/2aec62e8-9593-4452-a32c-0e344879f978
[link-openapi]: https://openapis.org/
[link-swagger]: http://swagger.io/
[link-swagger-specification]: http://swagger.io/specification/
[link-swagger-editor]: http://editor.swagger.io/
[link-author]: https://github.com/niels-nijens
[link-contributors]: https://github.com/ConnectHolland/openapi-specification-generator/contributors
