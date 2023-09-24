<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersIndex extends Controller
{
    //
    public function __invoke(Request $request)
    {

        return view('admin.livestreams.index');
    }
}
