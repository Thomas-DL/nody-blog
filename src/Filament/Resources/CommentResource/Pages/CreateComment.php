<?php

namespace Nody\NodyBlog\Filament\Resources\CommentResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Nody\NodyBlog\Filament\Resources\CommentResource;

class CreateComment extends CreateRecord
{
  protected static string $resource = CommentResource::class;

  protected function getRedirectUrl(): string
  {
    return $this->getResource()::getUrl('index');
  }

  protected function mutateFormDataBeforeCreate(array $data): array
  {
    $data['user_id'] = auth()->id();

    return $data;
  }
}
