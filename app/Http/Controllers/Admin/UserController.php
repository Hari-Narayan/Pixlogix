<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;

class UserController extends Controller {

    public function index() {
        $users = User::orderBy('id', 'DESC')->get();

        return view('admin.user.index', compact('users'));
    }

    public function create() {
        $roles = Role::get()->pluck('name', 'id')->prepend('', trans('admin.please_select'));

        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request) {
        //
    }

    public function show(User $user) {
        //
    }

    public function edit(User $user) {
        //
    }

    public function update(Request $request, User $user) {
        //
    }

    public function destroy(User $user) {
        //
    }
}