<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResearchResource\Pages;
use App\Models\Research;
use Filament\Forms;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Table;

class ResearchResource extends Resource
{
	/**
	 * Model associated with the resource
	 */
	protected static ?string $model = Research::class;
	
	/**
	 * Navigation icon
	 */
	protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
	
	
	/**
	 * Define form fields
	 */
	public static function form(Form $form) : Form
	{
		return $form
			->schema([
				Forms\Components\Section::make('Research Details')
				                        ->schema([
					                        TextInput::make('title')
					                                 ->required()
					                                 ->maxLength(255)
					                                 ->label('Research Title'),
					                        
					                        MarkdownEditor::make('description')
					                                      ->required()
					                                      ->label('Research Description'),
				                        ]),
			]);
	}
	
	/**
	 * Define table columns
	 */
	public static function table(Table $table) : Table
	{
		return $table
			->columns([
				TextColumn::make('title')
				          ->sortable()
				          ->searchable()
				          ->label('Title')
				          ->width('150px'),
				
				TextColumn::make('description')
				          ->limit(50)
				          ->markdown()
				          ->label('Description')
				          ->width('250px'),
			])
			->filters([
				Filter::make('title')
				      ->form([
					      TextInput::make('title')
					               ->label('Search by Title'),
				      ])
				      ->query(function ($query, array $data) {
					      return $query->when($data['title'],
						      fn($query) => $query->where('title', 'like', '%'.$data['title'].'%'));
				      }),
			])
			->actions([
				Tables\Actions\EditAction::make(),
				Tables\Actions\ViewAction::make(),
				Tables\Actions\DeleteAction::make(),
			])
			->bulkActions([
				Tables\Actions\BulkActionGroup::make([
					Tables\Actions\DeleteBulkAction::make(),
				]),
			]);
	}
	
	/**
	 * Define page routes
	 */
	public static function getPages() : array
	{
		return [
			'index' => Pages\ListResearch::route('/'),
			'create' => Pages\CreateResearch::route('/create'),
			'edit' => Pages\EditResearch::route('/{record}/edit'),
		];
	}
}