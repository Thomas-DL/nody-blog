<?php

namespace Nody\NodyBlog\Filament\Resources\CategoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Nody\NodyBlog\Filament\Resources\CategoryResource;

class CreateCategory extends CreateRecord
{
  protected static string $resource = CategoryResource::class;

  protected function getRedirectUrl(): string
  {
    return $this->getResource()::getUrl('index');
  }
}
