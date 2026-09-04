<?php
// File: app/Http/Controllers/MemberController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return 'MemberController@index';
    }

    public function create()
    {
        return 'MemberController@create';
    }

    public function store(Request $request)
    {
        return 'MemberController@store';
    }

    public function show(string $id)
    {
        return "MemberController@show, id: {$id}";
    }

    public function edit(string $id)
    {
        return "MemberController@edit, id: {$id}";
    }

    public function update(Request $request, string $id)
    {
        return "MemberController@update, id: {$id}";
    }

    public function destroy(string $id)
    {
        return "MemberController@destroy, id: {$id}";
    }

    // File: app/Http/Controllers/LoanController.php
    public function kembalikan(string $id)
    {
        return "LoanController@kembalikan, id: {$id}";
    }
}