<?php

namespace Nody\NodyBlog\Filament\Resources\PostResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Nody\NodyBlog\Filament\Resources\PostResource;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
