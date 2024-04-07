<?php

namespace Nody\NodyBlog\Filament\Resources\CategoryResource\Pages;

use Filament\Actions;
use Nody\NodyBlog\Filament\Resources\CategoryResource;
use Filament\Resources\Pages\ListRecords;

class ListCategories extends ListRecords
{
  protected static string $resource = CategoryResource::class;

  protected function getHeaderActions(): array
  {
    return [
      Actions\CreateAction::make(),
    ];
  }
}
