<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeleteHandlerController extends Controller
{
    public function delete($table, $id)
{
    return view("delete.confirm", compact('table', 'id'));
}
}
