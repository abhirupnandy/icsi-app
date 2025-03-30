<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\Section;
use Illuminate\Validation\Rule;
use App\Filament\Resources\EventsResource\Pages;
use App\Models\Events;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\Filter;

class EventsResource extends Resource
{
	protected static ?string $model = Events::class;
	protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
	
	public static function form(Form $form) : Form
	{
		return $form
			->schema([
				Section::make('Event Details')
				       ->schema([
					       TextInput::make('title')
					                ->required()
					                ->maxLength(255)
					                ->live(onBlur: true)
					                ->afterStateUpdated(function (
						                $state,
						                callable $set,
						                callable $get
					                ) {
						                if (!$get('slug')) {
							                $slug = Str::slug(implode(' ',
								                array_slice(explode(' ', $state), 0, 5)));
							                $set('slug', $slug);
						                }
					                }),
					       
					       TextInput::make('slug')
					                ->required()
					                ->maxLength(255)
					                ->helperText('Auto-generated from title but can be edited manually.')
					                ->unique(ignoreRecord: true),
					       
					       Textarea::make('description')
					               ->required()
					               ->maxLength(500),
					       
					       MarkdownEditor::make('content')
					                     ->required()
					                     ->columnSpan('full'),
				       ]),
				
				Section::make('Event Media')
				       ->schema([
					       FileUpload::make('thumbnail')
					                 ->label('Thumbnail')
					                 ->image()
					                 ->directory('events-thumbnails')
					                 ->visibility('public')
					                 ->maxSize(1024)
					                 ->disk('public')
					                 ->preserveFilenames(false)
					                 ->getUploadedFileNameForStorageUsing(fn($file
					                 ) => 'thumbnail-'.uniqid().'.'.$file->getClientOriginalExtension()),
				       ]),
				
				Section::make('Event Schedule')
				       ->schema([
					       DatePicker::make('event_date')
					                 ->required(),
					       TextInput::make('location')
					                ->required()
					                ->maxLength(255),
				       ])->columns(2),
			]);
	}
	
	public static function table(Table $table) : Table
	{
		return $table
			->columns([
				TextColumn::make('event_date')
				          ->date()
				          ->sortable()
				          ->width('180px'),
				TextColumn::make('title')
				          ->searchable()
				          ->sortable()
				          ->width('250px'),
				TextColumn::make('location')
				          ->sortable()
				          ->searchable()
				          ->width('220px'),
				ImageColumn::make('thumbnail_url')
				           ->label('Thumbnail')
				           ->square()
				           ->width('150px'),
			])
			->filters([
				Filter::make('title')
				      ->form([
					      TextInput::make('title')->label('Search by Title'),
				      ])
				      ->query(fn($query, array $data) => $query->when($data['title'],
					      fn($query) => $query->where('title', 'like', '%'.$data['title'].'%'))),
				
				Filter::make('event_date')
				      ->form([
					      DatePicker::make('event_date_from')->label('From'),
					      DatePicker::make('event_date_to')->label('To'),
				      ])
				      ->query(fn($query, array $data) => $query
					      ->when($data['event_date_from'],
						      fn($query) => $query->whereDate('event_date', '>=',
							      $data['event_date_from']))
					      ->when($data['event_date_to'],
						      fn($query) => $query->whereDate('event_date', '<=',
							      $data['event_date_to']))),
			])
			->actions([
				Tables\Actions\EditAction::make(),
				Tables\Actions\ViewAction::make(),
			])
			->bulkActions([
				Tables\Actions\BulkActionGroup::make([
					Tables\Actions\DeleteBulkAction::make(),
				]),
			]);
	}
	
	public static function getRelations() : array
	{
		return [];
	}
	
	public static function getPages() : array
	{
		return [
			'index' => Pages\ListEvents::route('/'),
			'create' => Pages\CreateEvents::route('/create'),
			'edit' => Pages\EditEvents::route('/{record}/edit'),
		];
	}
}
