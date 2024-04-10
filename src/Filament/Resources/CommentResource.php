<?php

namespace Nody\NodyBlog\Filament\Resources;

use Filament\Resources\Resource;
use Nody\NodyBlog\Models\PostComment;

class CommentResource extends Resource
{
    protected static ?string $model = PostComment::class;

    protected static ?string $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?string $recordTitleAttribute = 'title';
}
