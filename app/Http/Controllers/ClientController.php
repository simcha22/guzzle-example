<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClientController extends Controller
{
    public function getAllPost(){

        //https://jsonplaceholder.typicode.com/posts

        $response = Http::get('https://jsonplaceholder.typicode.com/posts');

        return $response->json();
    }
}
