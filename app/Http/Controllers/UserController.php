<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::all('email', 'nama');
        return datatables()->of($users)
            ->addColumn('Actions', function ($data) {
                return '<button type="button" data-id="'.$data->id.'" data-toggle="modal" data-target="#DeleteUserModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }
}
