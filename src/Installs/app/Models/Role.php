<?php
/**
 * Model generated using IdeaGroup
 * Help: lehung.hut@gmail.com
 * IdeaAdmin is open-sourced software licensed under the MIT license.
 * Developed by: Idea IT Solutions
 * Developer Website: http://ideagroup.vn
 */

namespace App;

use Zizaco\Entrust\EntrustRole;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends EntrustRole
{
    use SoftDeletes;
	
	protected $table = 'roles';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];
}
