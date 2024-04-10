<?php

namespace Nody\NodyBlog\Filament\Resources\PostResource\RelationManagers;

use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Resources\RelationManagers\RelationManager;

class CommentsRelationManager extends RelationManager
{
  protected static string $relationship = 'comments';

  public function form(Form $form): Form
  {
    return $form
      ->schema([
        TextInput::make('comment')
          ->required()
          ->maxLength(255),
        Select::make('user_id')
          ->relationship('user', 'name')
          ->searchable()
          ->preload()
          ->required(),
      ]);
  }

  public function table(Table $table): Table
  {
    return $table
      ->recordTitleAttribute('comment')
      ->columns([
        TextColumn::make('comment'),
        TextColumn::make('user.name'),
      ])
      ->filters([
        //
      ])
      ->headerActions([
        CreateAction::make(),
      ])
      ->actions([
        EditAction::make(),
        DeleteAction::make(),
      ])
      ->bulkActions([]);
  }
}
