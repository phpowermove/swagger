# swagger

[![Build Status](https://travis-ci.org/gossi/swagger.svg?branch=master)](https://travis-ci.org/gossi/swagger)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gossi/swagger/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gossi/swagger)
[![Code Coverage](https://scrutinizer-ci.com/g/gossi/swagger/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/gossi/swagger)

A php library to manipulate [swagger](http://swagger.io)/[Open API](https://openapis.org) specifications.

## Installation

```
composer require gossi/swagger
```

## Usage

Read an `api.json` file:

```php
$swagger = Swagger::fromFile('api.json');

// or

$swagger = new Swagger($array);
```

### Collections

There are two major collections: `Paths` and `Definitions`. The API is similar for both:

```php
$paths = $swagger->getPaths();
$p = new Path('/user');

foreach ($paths as $path) {
	// adding
	$paths->add($a);
	
	// retrieving
	if ($paths->has('/user') || $paths->contains($p)) {
		$path = $paths->get('/user');
	}
	
	// removing
	$paths->remove('/user');
}
```

### Models

There are a lot of models, e.g. the mentioned `Path` above. The API is well written, so it works with the auto-completion of your IDE. It is straight forward and uses the same naming scheme as the OpenAPI specification.


## Contributing

Feel free to fork and submit a pull request (don't forget the tests) and I am happy to merge.


