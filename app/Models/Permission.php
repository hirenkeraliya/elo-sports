<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    // this function  permission has mnay roles
    public function roles() {

        return $this->belongsToMany(Role::class,'roles_permissions');
            
     }
     
     // this functuon will show the number of users who have this permission
     public function users() {
     
        return $this->belongsToMany(User::class,'users_permissions');
            
     }
}
