<?php

namespace Nody\NodyBlog\Filament\Resources;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Nody\NodyBlog\Filament\Resources\PostResource\Pages\CreatePost;
use Nody\NodyBlog\Filament\Resources\PostResource\Pages\EditPost;
use Nody\NodyBlog\Filament\Resources\PostResource\Pages\ListPosts;
use Nody\NodyBlog\Models\Post;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Title')
                    ->placeholder('Enter the title of the category')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->required(),

                TextInput::make('slug')
                    ->label('Slug')
                    ->placeholder('Enter the slug of the category')
                    ->required(),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Category')
                    ->preload()
                    ->searchable()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->label('Name')
                            ->placeholder('Enter the name of the category')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->required(),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->placeholder('Enter the slug of the category')
                            ->required(),
                    ])
                    ->required(),
                Select::make('tag_id')
                    ->relationship('tags', 'name')
                    ->label('Tags')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->required()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->label('Name')
                            ->placeholder('Enter the name of the category')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->required(),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->placeholder('Enter the slug of the category')
                            ->required(),
                    ]),
                Select::make('is_published')
                    ->label('Status')
                    ->options([
                        '0' => 'Draft',
                        '1' => 'Published',
                    ])
                    ->native(false)
                    ->default('0')
                    ->required(),
                Textarea::make('excerpt')
                    ->label('Excerpt')
                    ->placeholder('Enter the excerpt of the post (max 160 characters)')
                    ->autosize()
                    ->minLength(2)
                    ->required(),
                SpatieMediaLibraryFileUpload::make('post_thumbnail')
                    ->label('Post Thumbnail')
                    ->collection('Blog')
                    ->responsiveImages()
                    ->conversion('thumb')
                    ->disk('media')
                    ->required(),
                RichEditor::make('content')
                    ->label('Content')
                    ->columnSpan('full')
                    ->fileAttachmentsDisk('media')
                    ->fileAttachmentsDirectory('attachments')
                    ->fileAttachmentsVisibility('private')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('user.profile_photo_path')
                    ->label('Author')
                    ->default(function ($record) {
                        $initial = $record->user->name ? $record->user->name[0] : 'A';

                        return 'https://ui-avatars.com/api/?name=' . urlencode($initial) . '&color=7F9CF5&background=EBF4FF';
                    })
                    ->circular(),
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Categorie')
                    ->badge(),
                TextColumn::make('tags.name')
                    ->label('Tags')
                    ->badge(),
                IconColumn::make('is_published')
                    ->label('Status')
                    ->icon(fn (string $state): string => match ($state) {
                        '0' => 'heroicon-o-pencil',
                        '1' => 'heroicon-o-check-circle',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        '0' => 'info',
                        '1' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('stats')
                    ->label('Stats')
                    ->getStateUsing(function ($record) {
                        $likes = $record->likes()->count();
                        $comments = $record->comments()->count();
                        return "${likes} likes | ${comments}  comments";
                    }),
            ])
            ->filters([
                SelectFilter::make('is_published')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'reviewing' => 'Reviewing',
                        'published' => 'Published',
                    ]),
                SelectFilter::make('tag_id')
                    ->relationship('tags', 'name')
                    ->label('Tags')
                    ->preload()
                    ->multiple()
                    ->searchable(),
                SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Category')
                    ->preload()
                    ->searchable(),
            ])
            ->actions([
                EditAction::make(),
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'edit' => EditPost::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
