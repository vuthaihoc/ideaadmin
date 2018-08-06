<?php
/**
 * Code generated using IdeaGroup
 * Help: lehung.hut@gmail.com
 * IdeaAdmin is open-sourced software licensed under the MIT license.
 * Developed by: Idea IT Solutions
 * Developer Website: http://ideagroup.vn
 */

namespace Idea\Ideaadmin\Commands;

use Illuminate\Console\Command;

use Idea\Ideaadmin\CodeGenerator;

/**
 * Class Migration
 * @package Idea\Ideaadmin\Commands
 *
 * Command to generation new sample migration file or complete migration file from DB Context
 * if '--generate' parameter is used after command, it generate migration from database.
 */
class Migration extends Command
{
    // The command signature.
    protected $signature = 'la:migration {table} {--generate}';
    
    // The command description.
    protected $description = 'Generate Migrations for IdeaAdmin';
    
    /**
     * Generate a Migration file either sample or from DB Context
     *
     * @return mixed
     */
    public function handle()
    {
        $table = $this->argument('table');
        $generateFromTable = $this->option('generate');
        if($generateFromTable) {
            $generateFromTable = true;
        }
        CodeGenerator::generateMigration($table, $generateFromTable, $this);
    }
}
