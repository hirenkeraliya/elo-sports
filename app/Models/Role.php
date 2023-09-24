<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    use HasFactory;
    protected $fillable =[
        'slug',
        'name'
    ];
    // this function will create the slug when we are creaeting ghe roles
    protected static function boot() {
        parent::boot();
    
        static::creating(function ($role) {
            $role->slug = Str::slug($role->name);
        });
    }
    
    // this function will show the number of permissions for this roels
    public function permissions() {

        return $this->belongsToMany(Permission::class,'roles_permissions');
            
     }
     
     // this function will shows the number of users who have this roles
     public function users() {
     
        return $this->belongsToMany(Users::class,'users_roles');
            
     }
}
