<?php

namespace App\Livewire;

use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Joaopaulolndev\FilamentEditProfile\Concerns\HasSort;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UpdateProfileComponent extends Component implements HasForms
{
	use InteractsWithForms;
	use HasSort;
	
	public ?array $data = [];
	
	protected static int $sort = 0;
	
	public function mount(): void
	{
		$this->form->fill(Auth::user()->only(['bio', 'orcid_id', 'website_url', 'scholar_url']));
	}
	
	public function form(Form $form): Form
	{
		return $form
			->schema([
				Section::make('Your Profile')
				       ->aside()
				       ->description('Please update your profile here.')
				       ->schema([
					       Textarea::make('bio')
					               ->label('Bio')
					               ->placeholder('Please enter your bio here.')
					               ->helperText('Please enter your bio.'),
					       Fieldset::make('Links')
					               ->schema([
						               TextInput::make('orcid_id')
						                        ->label('ORCID ID')
						                        ->placeholder('0000-0000-0000-0000')
						                        ->helperText('Please enter your ORCID ID.'),
						               TextInput::make('website_url')
						                        ->label('Website URL')
						                        ->url()
						                        ->placeholder('https://example.com')
						                        ->helperText('Please enter your website URL.'),
						               TextInput::make('scholar_url')
						                        ->label('Google Scholar URL')
						                        ->placeholder('https://example.com')
						                        ->helperText('Please enter your Google Scholar URL.'),
					               ]),
				       ]),
			])
			->statePath('data');
	}
	
	public function save(): void
	{
		$user = Auth::user();
		$data = $this->form->getState();
		
		$user->update($data);
		Notification::make()
		            ->title('Your profile information has been saved successfully.')
		            ->success()
		            ->send();
	}
	
	public function render(): View
	{
		return view('livewire.update-profile-component');
	}
}
