<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Interview;
use App\Permission;

class DataController extends Controller
{
    public function open()
    {
        $user = User::findOrFail(1);
        $data = "This data is open and can be accessed without the client being authenticated";
        return response()->json(compact('user'),200);

    }

    public function closed()
    {
        $data = Auth::user();
        $role = $data->roles;
        $data = $data->checkName('cyrus');
        return response()->json(compact('data','role'),200);
    }
}
