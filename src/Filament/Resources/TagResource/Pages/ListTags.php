<?php

namespace Nody\NodyBlog\Filament\Resources\TagResource\Pages;

use Filament\Actions;
use Nody\NodyBlog\Filament\Resources\TagResource;
use Filament\Resources\Pages\ListRecords;

class ListTags extends ListRecords
{
  protected static string $resource = TagResource::class;

  protected function getHeaderActions(): array
  {
    return [
      Actions\CreateAction::make(),
    ];
  }
}
