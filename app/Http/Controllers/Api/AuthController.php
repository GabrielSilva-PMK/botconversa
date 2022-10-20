<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LibraryController;
use Exception;

class AuthController extends Controller
{
    public function authenticate()
    {
        try {

            return response()->json(env('KEY_API_BOTCONVERSA'));

        } catch (Exception $e) {
            return response()->json(LibraryController::responseApi([], $e->getMessage(), 1));
        }
    }

}
