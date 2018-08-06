<?php
/**
 * Code generated using IdeaGroup
 * Help: lehung.hut@gmail.com
 * IdeaAdmin is open-sourced software licensed under the MIT license.
 * Developed by: Idea IT Solutions
 * Developer Website: http://ideagroup.vn
 */

namespace Idea\Ideaadmin;

use Artisan;
use Illuminate\Support\Facades\Blade;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

use Idea\Ideaadmin\Helpers\BackendHelper;

/**
 * Class BackendProvider
 * @package Idea\Ideaadmin
 *
 * This is IdeaAdmin Service Provider which looks after managing aliases, other required providers, blade directives
 * and Commands.
 */
class BackendProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // @mkdir(base_path('resources/laraadmin'));
        // @mkdir(base_path('database/migrations/laraadmin'));
        /*
        $this->publishes([
            __DIR__.'/Templates' => base_path('resources/laraadmin'),
            __DIR__.'/config.php' => base_path('config/laraadmin.php'),
            __DIR__.'/Migrations' => base_path('database/migrations/laraadmin')
        ]);
        */
        //echo "Ideaadmin Migrations started...";
        // Artisan::call('migrate', ['--path' => "vendor/idea/ideaadmin/src/Migrations/"]);
        //echo "Migrations completed !!!.";
        // Execute by php artisan vendor:publish --provider="Idea\Ideaadmin\BackendProvider"
        
        /*
        |--------------------------------------------------------------------------
        | Blade Directives for Entrust not working in Laravel 5.5
        |--------------------------------------------------------------------------
        */
        if(BackendHelper::laravel_ver() == 5.5) {
            
            // Call to Entrust::hasRole
            Blade::directive('role', function ($expression) {
                return "<?php if (\\Entrust::hasRole({$expression})) : ?>";
            });
            
            // Call to Entrust::can
            Blade::directive('permission', function ($expression) {
                return "<?php if (\\Entrust::can({$expression})) : ?>";
            });
            
            // Call to Entrust::ability
            Blade::directive('ability', function ($expression) {
                return "<?php if (\\Entrust::ability({$expression})) : ?>";
            });
        }
    }
    
    /**
     * Register the application services including routes, Required Providers, Alias, Controllers, Blade Directives
     * and Commands.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__ . '/routes.php';
        
        // For BackendEditor
        if(file_exists(__DIR__ . '/../../laeditor')) {
            include __DIR__ . '/../../laeditor/src/routes.php';
        }
        
        /*
        |--------------------------------------------------------------------------
        | Providers
        |--------------------------------------------------------------------------
        */
        
        // Collective HTML & Form Helper
        $this->app->register(\Collective\Html\HtmlServiceProvider::class);
        // For Datatables
        $this->app->register(\Yajra\Datatables\DatatablesServiceProvider::class);
        // For Gravatar
        $this->app->register(\Creativeorange\Gravatar\GravatarServiceProvider::class);
        // For Entrust
        $this->app->register(\Zizaco\Entrust\EntrustServiceProvider::class);
        // For Spatie Backup
        $this->app->register(\Spatie\Backup\BackupServiceProvider::class);
        
        /*
        |--------------------------------------------------------------------------
        | Register the Alias
        |--------------------------------------------------------------------------
        */
        
        $loader = AliasLoader::getInstance();
        
        // Collective HTML & Form Helper
        $loader->alias('Form', \Collective\Html\FormFacade::class);
        $loader->alias('HTML', \Collective\Html\HtmlFacade::class);
        
        // For Gravatar User Profile Pics
        $loader->alias('Gravatar', \Creativeorange\Gravatar\Facades\Gravatar::class);
        
        // For IdeaAdmin Code Generation
        $loader->alias('CodeGenerator', \Idea\Ideaadmin\CodeGenerator::class);
        
        // For IdeaAdmin Form Helper
        $loader->alias('BackendFormMaker', \Idea\Ideaadmin\BackendFormMaker::class);
        
        // For IdeaAdmin Helper
        $loader->alias('BackendHelper', \Idea\Ideaadmin\Helpers\BackendHelper::class);
        
        // IdeaAdmin Module Model
        $loader->alias('Module', \Idea\Ideaadmin\Models\Module::class);
        
        // For IdeaAdmin Configuration Model
        $loader->alias('BackendConfigs', \Idea\Ideaadmin\Models\BackendConfigs::class);
        
        // For Entrust
        $loader->alias('Entrust', \Zizaco\Entrust\EntrustFacade::class);
        $loader->alias('role', \Zizaco\Entrust\Middleware\EntrustRole::class);
        $loader->alias('permission', \Zizaco\Entrust\Middleware\EntrustPermission::class);
        $loader->alias('ability', \Zizaco\Entrust\Middleware\EntrustAbility::class);
        
        /*
        |--------------------------------------------------------------------------
        | Register the Controllers
        |--------------------------------------------------------------------------
        */
        
        $this->app->make('Idea\Ideaadmin\Controllers\ModuleController');
        $this->app->make('Idea\Ideaadmin\Controllers\FieldController');
        $this->app->make('Idea\Ideaadmin\Controllers\MenuController');
        
        // For BackendEditor
        if(file_exists(__DIR__ . '/../../laeditor')) {
            $this->app->make('Idea\Laeditor\Controllers\CodeEditorController');
        }
        
        /*
        |--------------------------------------------------------------------------
        | Blade Directives
        |--------------------------------------------------------------------------
        */
        
        // BackendForm Input Maker
        Blade::directive('la_input', function ($expression) {
            if(BackendHelper::laravel_ver() == 5.5) {
                $expression = "(" . $expression . ")";
            }
            return "<?php echo BackendFormMaker::input$expression; ?>";
        });
        
        // BackendForm Form Maker
        Blade::directive('la_form', function ($expression) {
            if(BackendHelper::laravel_ver() == 5.5) {
                $expression = "(" . $expression . ")";
            }
            return "<?php echo BackendFormMaker::form$expression; ?>";
        });
        
        // BackendForm Maker - Display Values
        Blade::directive('la_display', function ($expression) {
            if(BackendHelper::laravel_ver() == 5.5) {
                $expression = "(" . $expression . ")";
            }
            return "<?php echo BackendFormMaker::display$expression; ?>";
        });
        
        // BackendForm Maker - Check Whether User has Module Access
        Blade::directive('la_access', function ($expression) {
            if(BackendHelper::laravel_ver() == 5.5) {
                $expression = "(" . $expression . ")";
            }
            return "<?php if(BackendFormMaker::la_access$expression) { ?>";
        });
        Blade::directive('endla_access', function ($expression) {
            return "<?php } ?>";
        });
        
        // BackendForm Maker - Check Whether User has Module Field Access
        Blade::directive('la_field_access', function ($expression) {
            if(BackendHelper::laravel_ver() == 5.5) {
                $expression = "(" . $expression . ")";
            }
            return "<?php if(BackendFormMaker::la_field_access$expression) { ?>";
        });
        Blade::directive('endla_field_access', function ($expression) {
            return "<?php } ?>";
        });
        
        /*
        |--------------------------------------------------------------------------
        | Register the Commands
        |--------------------------------------------------------------------------
        */
        
        $commands = [
            \Idea\Ideaadmin\Commands\Migration::class,
            \Idea\Ideaadmin\Commands\Crud::class,
            \Idea\Ideaadmin\Commands\Packaging::class,
            \Idea\Ideaadmin\Commands\BackendInstall::class
        ];
        
        // For BackendEditor
        if(file_exists(__DIR__ . '/../../laeditor')) {
            $commands[] = \Idea\Laeditor\Commands\BackendEditor::class;
        }
        
        $this->commands($commands);
    }
}
