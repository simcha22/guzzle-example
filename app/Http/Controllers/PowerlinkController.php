<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PowerlinkController extends Controller
{
    public function create()
    {
        $response = Http::withHeaders([
            'tokenid' => '93cdedde-091c-45d0-9ce8-e8001f52ab6f',
        ])->post('https://api.powerlink.co.il/api/record/1005', [
            'name' => 'מסמכים אילנס - שמחה בדיקה',
            'pcfsystemfield710' =>  1,
            'pcfsystemfield708' => 1,
        ]);

        return $response->json();
    }

    public function uploadFile()
    {
        $response = Http::withHeaders([
            'tokenid' => '93cdedde-091c-45d0-9ce8-e8001f52ab6f',
        ])->attach(
            'file',
            file_get_contents('C:\Users\simch\guzzle-example\storage\app\documents\address_26_343434343.pdf'),
            'file.pdf'
        )->post('https://api.powerlink.co.il/api/v2/record/1005/2f2fb227-1521-4bc2-9f09-b483cf7fa3da/files');

        return $response->json();
    }
}
