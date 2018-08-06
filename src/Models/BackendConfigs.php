<?php
/**
 * Code generated using IdeaGroup
 * Help: lehung.hut@gmail.com
 * IdeaAdmin is open-sourced software licensed under the MIT license.
 * Developed by: Idea IT Solutions
 * Developer Website: http://ideagroup.vn
 */

namespace Idea\Ideaadmin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Exception;
use Log;
use DB;
use Idea\Ideaadmin\Helpers\BackendHelper;

/**
 * Class BackendConfigs
 * @package Idea\Ideaadmin\Models
 *
 * Config Class looks after IdeaAdmin configurations.
 * Check details on http://laraadmin.com/docs
 */
class BackendConfigs extends Model
{
    protected $table = 'la_configs';
    
    protected $fillable = [
        "key", "value"
    ];
    
    protected $hidden = [
    
    ];
    
    /**
     * Get configuration string value by using key such as 'sitename'
     *
     * BackendConfigs::getByKey('sitename');
     *
     * @param $key key string of configuration
     * @return bool value of configuration
     */
    public static function getByKey($key)
    {
        $row = BackendConfigs::where('key', $key)->first();
        if(isset($row->value)) {
            return $row->value;
        } else {
            return false;
        }
    }
    
    /**
     * Get all configuration as object
     *
     * BackendConfigs::getAll();
     *
     * @return object
     */
    public static function getAll()
    {
        $configs = array();
        $configs_db = BackendConfigs::all();
        foreach($configs_db as $row) {
            $configs[$row->key] = $row->value;
        }
        return (object)$configs;
    }
}
