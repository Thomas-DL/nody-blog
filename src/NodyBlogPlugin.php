<?php

namespace Nody\NodyBlog;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Nody\NodyBlog\Filament\Resources\CategoryResource;
use Nody\NodyBlog\Filament\Resources\PostResource;
use Nody\NodyBlog\Filament\Resources\TagResource;

class NodyBlogPlugin implements Plugin
{
    public function getId(): string
    {
        return 'nody-blog';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                CategoryResource::class,
                PostResource::class,
                TagResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
