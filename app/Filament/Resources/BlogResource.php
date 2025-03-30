<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Filament\Resources\BlogResource\RelationManagers;
use App\Filament\Resources\BlogResource\Widgets\BlogStats;
use App\Filament\Widgets\StatsOverview;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogResource extends Resource
{
	protected static ?string $model = Blog::class;
	
	protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';
	
	
	public static function form(Form $form) : Form
	{
		return $form
			->schema([
				Section::make('Basic Information')
				       ->description('Enter the core details of your blog post')
				       ->schema([
					       TextInput::make('title')
					                ->label('Title')
					                ->required()
					                ->maxLength(255)
						       ->columnSpanFull()
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
					                ->unique(table: Blog::class, column: 'slug', ignoreRecord: true)
					                ->maxLength(255)
					                ->columnSpanFull(),
					       Select::make('user_id')
					             ->label('Author')
					             ->options(User::pluck('name', 'id')->toArray())
					             ->default(Auth::id()) // Set the default to the current user
					             ->disabled() // Prevent users from changing it
					             ->dehydrated() // Ensure the value is still saved in the database
					             ->columnSpanFull(),
					       
					       Select::make('category_id')
					             ->label('Category')
					             ->options(Category::pluck('name', 'id')->toArray())
					             ->required()
					             ->searchable()
					             ->createOptionForm([
						             TextInput::make('name')
						                      ->label('Category Name')
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
						                      ->label('Slug')
						                      ->required()
							             ->helperText('Auto-generated from title but can be edited manually.')
						                      ->unique(table: Category::class, column: 'slug')
						                      ->maxLength(255),
					             ])
					             ->createOptionUsing(function (array $data) : int {
						             return Category::create($data)->id;
					             }),
					       TagsInput::make('tags')
					                ->label('Tags')
						       ->separator(',') // Ensures tags are separated by commas
						       ->splitKeys(['Enter', ',']) // Allows Enter key as well
						       ->helperText('Separate tags with commas or Enter.'),
				       
				       ])
				       ->columns(2)
				       ->collapsible(),
				
				Section::make('Content')
				       ->schema([
					       MarkdownEditor::make('content')
					                     ->label('Content')
					                     ->required()
					                     ->columnSpanFull(),
					       FileUpload::make('thumbnail')
					                 ->label('Thumbnail')
					                 ->image()
					                 ->directory('blog-thumbnails')
					                 ->visibility('public')
					                 ->disk('public')
					                 ->preserveFilenames(false)
					                 ->getUploadedFileNameForStorageUsing(function ($file) {
						                 return 'thumbnail-'.uniqid().'.'.$file->getClientOriginalExtension();
					                 }),
					       TextInput::make('thumbnail_alt')
					                ->label('Thumbnail Alt Text')
					                ->maxLength(255)
					                ->columnSpanFull(),
				       ])
				       ->collapsible(),
				
				Section::make('SEO Details')
				       ->description('Optimize your post for search engines and social media')
				       ->schema([
					       TextInput::make('seo_title')
					                ->label('SEO Title')
					                ->maxLength(70)
					                ->helperText('Recommended: 60-70 characters')
					                ->columnSpanFull(),
					       TextInput::make('meta_description')
					                ->label('Meta Description')
					                ->maxLength(160)
					                ->helperText('Recommended: 150-160 characters')
					                ->columnSpanFull(),
					       TextInput::make('focus_keyword')
					                ->label('Focus Keyword')
						       ->maxLength(255)
						       ->live(onBlur: true)
						       ->afterStateUpdated(function ($state, callable $set, callable $get) {
							       if (!$get('seo_slug')) {
								       $slug = Str::slug($state);
								       $set('seo_slug', $slug);
							       }
						       }),
					       
					       TextInput::make('seo_slug')
					                ->label('SEO Slug')
						       ->unique(table: Blog::class, column: 'seo_slug', ignoreRecord: true)
						       ->maxLength(255)
						       ->helperText('Auto-generated from Focus Keyword but can be edited manually.'),
					       
					       TextInput::make('og_title')
					                ->label('Open Graph Title')
					                ->maxLength(255)
					                ->columnSpanFull(),
					       TextInput::make('og_description')
					                ->label('Open Graph Description')
					                ->maxLength(255)
					                ->columnSpanFull(),
					       FileUpload::make('og_image')
					                 ->label('Open Graph Image')
					                 ->image()
					                 ->directory('blog-og-images')
					                 ->visibility('public')
					                 ->disk('public')
					                 ->preserveFilenames(false)
					                 ->getUploadedFileNameForStorageUsing(function ($file) {
						                 return 'og-'.uniqid().'.'.$file->getClientOriginalExtension();
					                 })
					                 ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif'])
					                 ->imageEditor()
					                 ->columnSpanFull(),
				       ])
				       ->columns(2)
				       ->collapsible(),
				
				Section::make('Publication Details')
				       ->schema([
					       Toggle::make('published')
					             ->label('Published')
					             ->default(false),
					       DatePicker::make('published_at')
					                 ->label('Publish Date')
					                 ->default(now())
					                 ->nullable(),
				       ])
				       ->columns(2)
				       ->collapsible(),
			]);
	}
	
	public static function table(Table $table) : Table
	{
		return $table
			->columns([
				TextColumn::make('title')
				          ->searchable()
				          ->sortable(),
				TextColumn::make('slug')
				          ->searchable(),
				TextColumn::make('category.name')
				          ->label('Category')
				          ->sortable(),
				TextColumn::make('user.name')
				          ->label('Author')
				          ->sortable()
				          ->toggleable(isToggledHiddenByDefault: true),
				TextColumn::make('seo_title')
				          ->label('SEO Title')
				          ->searchable()
				          ->toggleable(isToggledHiddenByDefault: true),
				TextColumn::make('focus_keyword')
				          ->label('Focus Keyword')
				          ->toggleable(isToggledHiddenByDefault: true),
				ToggleColumn::make('published')
					->label('Published'),
				TextColumn::make('published_at')
				          ->date()
				          ->sortable(),
				TextColumn::make('created_at')
				          ->dateTime()
				          ->sortable()
				          ->toggleable(isToggledHiddenByDefault: true),
			])
			->filters([
				Tables\Filters\TernaryFilter::make('published')
				                            ->label('Publication Status'),
				Tables\Filters\SelectFilter::make('category_id')
				                           ->label('Category')
				                           ->options(Category::pluck('name', 'id'))
				                           ->multiple(),
			])
			->actions([
				Tables\Actions\EditAction::make(),
				Tables\Actions\ViewAction::make(),
			])
			->bulkActions([
				Tables\Actions\BulkActionGroup::make([
					Tables\Actions\DeleteBulkAction::make(),
				]),
			])
			->defaultSort('published_at', 'desc');
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
			'index' => Pages\ListBlogs::route('/'),
			'create' => Pages\CreateBlog::route('/create'),
			'edit' => Pages\EditBlog::route('/{record}/edit'),
		];
	}
	
	public function mutateFormDataBeforeCreate(array $data) : array
	{
		// Set user_id to the current authenticated user's ID on creation
		$data['user_id'] = Auth::id();
		return $data;
	}
	
	public function mutateFormDataBeforeSave(array $data) : array
	{
		// Preserve the original user_id on update (since form can't change it)
		$record = $this->getRecord();
		$data['user_id'] = $record->user_id;
		return $data;
	}
}