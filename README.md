# A Nody package wich add blog module to Nody's boilerplate

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nody/nody-blog.svg?style=flat-square)](https://packagist.org/packages/nody/nody-blog)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/nody/nody-blog/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/nody/nody-blog/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/nody/nody-blog/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/nody/nody-blog/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/nody/nody-blog.svg?style=flat-square)](https://packagist.org/packages/nody/nody-blog)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require nody/nody-blog
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="nody-blog-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="nody-blog-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="nody-blog-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$nodyBlog = new Nody\NodyBlog();
echo $nodyBlog->echoPhrase('Hello, Nody!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Nody](https://github.com/Thomas-DL)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
