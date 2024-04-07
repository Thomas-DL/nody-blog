<?php

namespace Nody\NodyBlog\Filament\Resources;

use Filament\Forms\Set;
use Nody\NodyBlog\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Nody\NodyBlog\Filament\Resources\CategoryResource\Pages\EditCategory;
use Nody\NodyBlog\Filament\Resources\CategoryResource\Pages\CreateCategory;
use Nody\NodyBlog\Filament\Resources\CategoryResource\Pages\ListCategories;

class CategoryResource extends Resource
{
  protected static ?string $model = Category::class;

  protected static ?string $navigationGroup = 'Blog';

  protected static ?int $navigationSort = 1;

  protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
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
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('name'),
        TextColumn::make('slug')
      ])
      ->filters([
        //
      ])
      ->actions([
        EditAction::make(),
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
      'index' => ListCategories::route('/'),
      'create' => CreateCategory::route('/create'),
      'edit' => EditCategory::route('/{record}/edit'),
    ];
  }

  public static function getNavigationBadge(): ?string
  {
    return static::getModel()::count();
  }
}
