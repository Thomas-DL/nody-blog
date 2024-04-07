<?php

namespace Nody\NodyBlog\Filament\Resources\TagResource\Pages;

use Filament\Actions;
use Nody\NodyBlog\Filament\Resources\TagResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTag extends CreateRecord
{
  protected static string $resource = TagResource::class;

  protected function getRedirectUrl(): string
  {
    return $this->getResource()::getUrl('index');
  }
}
