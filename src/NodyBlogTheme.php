<?php

namespace Nody\NodyBlog;

use Filament\Panel;
use Filament\Contracts\Plugin;
use Filament\Support\Assets\Theme;
use Filament\Support\Facades\FilamentAsset;



class NodyBlogTheme implements Plugin
{
  public function getId(): string
  {
    return 'nody-blog';
  }

  public function register(Panel $panel): void
  {
    FilamentAsset::register([
      Theme::make('nody-blog', __DIR__ . '/../resources/dist/nody-blog.css'),
    ]);
  }

  public function boot(Panel $panel): void
  {
    //
  }
}
