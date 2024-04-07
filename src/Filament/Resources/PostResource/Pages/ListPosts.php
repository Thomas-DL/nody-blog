<?php

namespace Nody\NodyBlog\Filament\Resources\PostResource\Pages;

use Filament\Actions;
use Nody\NodyBlog\Filament\Resources\PostResource;
use Filament\Resources\Pages\ListRecords;

class ListPosts extends ListRecords
{
  protected static string $resource = PostResource::class;

  protected function getHeaderActions(): array
  {
    return [
      Actions\CreateAction::make(),
    ];
  }
}
