<?php
/**
 * Model generated using IdeaGroup
 * Help: lehung.hut@gmail.com
 * IdeaAdmin is open-sourced software licensed under the MIT license.
 * Developed by: Idea IT Solutions
 * Developer Website: http://ideagroup.vn
 */

namespace App;

use Zizaco\Entrust\EntrustPermission;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends EntrustPermission
{
    use SoftDeletes;
	
	protected $table = 'permissions';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];
}
