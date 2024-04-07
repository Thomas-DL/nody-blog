<?php

namespace Nody\NodyBlog\Filament\Resources\PostResource\Pages;


use Filament\Actions;
use Nody\NodyBlog\Filament\Resources\PostResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
  protected static string $resource = PostResource::class;

  protected function getRedirectUrl(): string
  {
    return $this->getResource()::getUrl('index');
  }
}
