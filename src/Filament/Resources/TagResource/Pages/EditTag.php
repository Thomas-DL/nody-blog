<?php

namespace Nody\NodyBlog\Filament\Resources\TagResource\Pages;

use Filament\Actions;
use Nody\NodyBlog\Filament\Resources\TagResource;
use Filament\Resources\Pages\EditRecord;

class EditTag extends EditRecord
{
  protected static string $resource = TagResource::class;

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
