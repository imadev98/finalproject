<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

use Illuminate\Http\Request;


class Controller extends BaseController
{
    //
    
public function index()
{
    $utilisateur = test::table('utilisateur')->get();

    return view('utilisateur.index', ['utilisateur' => $utilisateur]);
}

}
