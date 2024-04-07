<?php

namespace Nody\NodyBlog\Filament\Resources\PostResource\Pages;

use Filament\Actions;
use Nody\NodyBlog\Filament\Resources\PostResource;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
  protected static string $resource = PostResource::class;

  protected function getHeaderActions(): array
  {
    return [
      Actions\DeleteAction::make(),
    ];
  }

  protected function getRedirectUrl(): string
  {
    return $this->getResource()::getUrl('index');
  }
}
