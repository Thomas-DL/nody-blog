<?php

namespace Nody\NodyBlog;

use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Livewire\Livewire;
use Nody\NodyBlog\Commands\NodyBlogCommand;
use Nody\NodyBlog\Livewire\GetPosts;
use Nody\NodyBlog\Livewire\PostComments;
use Nody\NodyBlog\Livewire\PostLike;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class NodyBlogServiceProvider extends PackageServiceProvider
{
    public static string $name = 'nody-blog';

    public static string $viewNamespace = 'nody-blog';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasCommands($this->getCommands())
            ->hasRoute('web', $this->getRoutes())
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub('Thomas-DL/nody-blog');
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../database/migrations'))) {
            $package->hasMigrations($this->getMigrations());
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageRegistered(): void
    {
    }

    public function packageBooted(): void
    {

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        // Icon Registration
        FilamentIcon::register($this->getIcons());

        // Livewire components
        Livewire::component('get-posts', GetPosts::class);
        Livewire::component('post-like', PostLike::class);
        Livewire::component('post-comments', PostComments::class);
    }

    protected function getAssetPackageName(): ?string
    {
        return 'nody/nody-blog';
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            NodyBlogCommand::class,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [
            __DIR__ . '/../routes/web.php',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [
            'create_nody-blog_table',
        ];
    }
}
