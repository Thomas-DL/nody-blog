<?php

namespace Nody\NodyBlog\Filament\Resources\TagResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Nody\NodyBlog\Filament\Resources\TagResource;

class CreateTag extends CreateRecord
{
    protected static string $resource = TagResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
