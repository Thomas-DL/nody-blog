# A Nody package wich add blog module to Nody's boilerplate

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nody/nody-blog.svg?style=flat-square)](https://packagist.org/packages/nody/nody-blog)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/nody/nody-blog/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/nody/nody-blog/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/nody/nody-blog.svg?style=flat-square)](https://packagist.org/packages/nody/nody-blog)



Install a ready to use blog module for Nody boilerplate

## Installation

You can install the package via composer:

```bash
composer require nody/nody-blog
```

Use install command tu publish migrations ans config files:

```bash
php artisan nody-blog:install
```

Publish spatie media-library files and run migrate

```bash
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="medialibrary-migrations"

php artisan migrate
```

Setup media disk for posts thumbnails in filesystems.php config file:

```php
        'media' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images'),
            'url' => env('APP_URL') . '/storage/images',
            'visibility' => 'public',
            'throw' => false,
        ],
```

Create images folder in storage folder and make a symbolic link

```bash
php artisan storage:link
```

Make relation betwteen post and user model in User.php

```php
    use Nody\NodyBlog\Models\Post;

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
```

Define plugin in Filament AdminPanelProvider:

```php
    use Nody\NodyBlog\NodyBlogPlugin;

    ->plugin(new NodyBlogPlugin());
```

Define "Blog" group in navigation:

```php
    $builder->group('Blog', [
        ...CategoryResource::getNavigationItems(),
        ...PostResource::getNavigationItems(),
        ...TagResource::getNavigationItems(),
    ]);
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Thomas-DL](https://github.com/Thomas-DL)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
