<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class rolesController extends Controller
{
    public function createRole(Request $request) {
        return $request->input('roleName');
    }
}
