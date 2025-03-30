<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
	protected static ?string $model = Category::class;
	
	protected static ?string $navigationIcon = 'heroicon-o-folder';
	
	public static function form(Form $form) : Form
	{
		return $form
			->schema([
				TextInput::make('name')
				         ->label('Name')
					->required()
					->live(onBlur: true)
					->afterStateUpdated(function ($state, callable $set, callable $get) {
						if (!$get('slug')) {
							$slug = Str::slug(implode(' ',
								array_slice(explode(' ', $state), 0, 5)));
							$set('slug', $slug);
						}
					}),
				TextInput::make('slug')
				         ->label('Slug')
					->required()
					->helperText('Auto-generated from title but can be edited manually.')
					->unique(ignoreRecord: true),
			]);
	}
	
	public static function table(Table $table) : Table
	{
		return $table
			->columns([
				TextColumn::make('name'),
				TextColumn::make('slug'),
			])
			->filters([
				//
			])
			->actions([
				Tables\Actions\EditAction::make(),
			])
			->bulkActions([
				Tables\Actions\BulkActionGroup::make([
					Tables\Actions\DeleteBulkAction::make(),
				]),
			]);
	}
	
	public static function getRelations() : array
	{
		return [
			//
		];
	}
	
	public static function getPages() : array
	{
		return [
			'index' => Pages\ListCategories::route('/'),
			'create' => Pages\CreateCategory::route('/create'),
			'edit' => Pages\EditCategory::route('/{record}/edit'),
		];
	}
}
