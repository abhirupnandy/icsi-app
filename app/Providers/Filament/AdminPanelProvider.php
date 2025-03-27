<?php

namespace App\Providers\Filament;

use App\Livewire\UpdateProfileComponent;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
	        ->passwordReset()
	        ->profile()
            ->colors([
                'primary' => '#004aad'
            ])
	        ->brandLogo(fn() => view('components.app-logo'))
	        ->brandLogoHeight('10rem')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
	        ->userMenuItems([
		        'profile' => MenuItem::make()
		                             ->label(fn() => auth()->user()->name . ' (' . auth()->user()->id . ')')
		                             ->url(fn (): string => EditProfilePage::getUrl())
		                             ->icon('heroicon-s-user-circle')
	        ])
	        
	        ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
	        ->plugins([
		        FilamentEditProfilePlugin::make()
			        ->setTitle(fn() => auth()->user()->name . '\'s Profile || USER ID (' . auth()
					        ->user()->id . ')')
		            ->setIcon('heroicon-s-user-circle')
		            ->shouldShowDeleteAccountForm(false)
		            ->shouldRegisterNavigation(false)
		            ->customProfileComponents([
						UpdateProfileComponent::class
			            		            ])
	        ]);
    }
}

// vendor/filament/resources/views/components/logo.blade.php