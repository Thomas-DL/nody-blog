<?php

namespace Nody\NodyBlog\Filament\Resources;

use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Nody\NodyBlog\Models\PostComment;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Nody\NodyBlog\Filament\Resources\CommentResource\Pages\EditComment;
use Nody\NodyBlog\Filament\Resources\CommentResource\Pages\ListComments;
use Nody\NodyBlog\Filament\Resources\CommentResource\Pages\CreateComment;

class CommentResource extends Resource
{
  protected static ?string $model = PostComment::class;

  protected static ?string $navigationGroup = 'Blog';

  protected static ?int $navigationSort = 4;

  protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

  protected static ?string $recordTitleAttribute = 'title';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Select::make('user_id')
          ->relationship('user', 'name')
          ->searchable()
          ->preload()
          ->required(),
        Select::make('post_id')
          ->relationship('post', 'title')
          ->searchable()
          ->preload()
          ->required(),
        TextInput::make('comment')->required()->minLength(1)->maxLength(255)
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('id'),
        TextColumn::make('user.name'),
        TextColumn::make('post.title'),
        TextColumn::make('comment'),
      ])
      ->filters([
        //
      ])
      ->actions([
        EditAction::make(),
      ])
      ->bulkActions([
        BulkActionGroup::make([
          DeleteBulkAction::make(),
        ]),
      ]);
  }

  public static function getRelations(): array
  {
    return [
      //
    ];
  }

  public static function getPages(): array
  {
    return [
      'index' => ListComments::route('/'),
      'create' => CreateComment::route('/create'),
      'edit' => EditComment::route('/{record}/edit'),
    ];
  }
}
