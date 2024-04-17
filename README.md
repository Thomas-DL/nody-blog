# A Nody package wich add blog module to Nody's boilerplate

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nody/nody-blog.svg?style=flat-square)](https://packagist.org/packages/nody/nody-blog)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/nody/nody-blog/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/nody/nody-blog/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/nody/nody-blog.svg?style=flat-square)](https://packagist.org/packages/nody/nody-blog)

Install a ready to use blog module for Nody boilerplate

## Features

-   CRUD Categories
-   CRUD Posts
-   CRUD Tags
-   CRUD Comments
-   Create categories or tags in create post view
-   Responsive Thumbnail
-   SEO Ready
-   Users can like or comment your post
-   Users can share your post by the link or on Twitter / Facebook / LinkedIn
-   Shortcut for the admin for go back on the dahsboard to edit a post
-   English 🇬🇧 & French 🇫🇷

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

You also can override the translation if you want or create a new by publish the lang folder:

```bash
php artisan vendor:publish --provider="Nody\NodyBlog\NodyBlogServiceProvider" --tag="nody-blog-translations"
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
    use Nody\NodyBlog\Livewire\PostComments;

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->belongsToMany(Post::class, 'post_like')->withTimestamps();
    }

    public function hasLiked(Post $post)
    {
        return $this->likes()->where('post_id', $post->id)->exists();
    }

    public function comments()
    {
        return $this->hasMany(PostComments::class);
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
        ...CommentResource::getNavigationItems(),
    ]);
```

Add this to your css files

```css
@layer components {
    #post-content {
        h2 {
            @apply text-2xl font-bold text-gray-800 dark:text-gray-200 mt-8 mb-4;
        }

        h3 {
            @apply text-xl font-bold text-gray-800 dark:text-gray-200 mt-8 mb-4;
        }

        blockquote {
            @apply border-l-4 border-gray-300 dark:border-gray-700 pl-4 my-4;
        }

        pre {
            @apply my-4 p-4 text-sm bg-gray-100 dark:bg-gray-800 rounded-lg;
        }

        ul {
            @apply list-disc list-inside;
        }

        ol {
            @apply list-decimal list-inside;
        }

        figure > a > img {
            @apply my-4 rounded-xl;
        }

        a {
            @apply text-indigo-500 dark:text-indigo-400 underline hover:no-underline;
        }
    }
}
```

Maybe you will restart vite for compile the css

```bash
npm run dev
```

Call your posts on custom view by this way:

```html
{{-- Posts section --}}
<div class="bg-white dark:bg-gray-900">
    <div class="container mx-auto">
        <h2
            class="text-3xl text-center font-semibold text-gray-900 dark:text-white"
        >
            The Blog section
        </h2>
        <livewire:get-posts
            postsCount="3"
            showLoadMore="0"
            showSearch="0"
            showFilters="0"
        />
    </div>
</div>
```

⚠️ Don't miss a parameter to the livewire component:

-   postsCount="3" ➡️ How many posts wish you show ?
-   showLoadMore="0" ➡️ Do you want a button for loading more posts ?
-   showSearch="0" ➡️ Do you want a search-bar for search post by title, content or excerpt ?
-   showFilter="0" ➡️ Do you want a filter-bar for search post by category or tags ?

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Thomas-DL](https://github.com/Thomas-DL)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

```

```
