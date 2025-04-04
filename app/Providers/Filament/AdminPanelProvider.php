<?php

namespace App\Providers\Filament;

use App\Filament\Resources\BlogResource\Widgets\BlogStats;
use App\Filament\Widgets\BoardRolesWidget;
use App\Filament\Widgets\EventStats;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\UserStats;
use App\Livewire\UpdateProfileComponent;
use Filament\Facades\Filament;
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
use Illuminate\Auth\Authenticatable;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;
use Yebor974\Filament\RenewPassword\RenewPasswordPlugin;
use Yebor974\Filament\RenewPassword\Traits\RenewPassword;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
	        ->darkMode(false)
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
	            StatsOverview::class,
	            UserStats::class,
	            EventStats::class,
	            BoardRolesWidget::class,
	            //                Widgets\FilamentInfoWidget::class,
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
		            ]),
		        RenewPasswordPlugin::make()
		                           ->forceRenewPassword()
		                           ->timestampColumn(),
	        ]);
    }
}

// vendor/filament/resources/views/components/logo.blade.php