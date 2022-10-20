<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LibraryController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class SubscribersController extends Controller
{

    public $controller = 'SubscribersController';

    public function index(Request $request)
    {
        try {

            $page = $request->page;

            if ($page) {
                $validator = Validator::make($request->all(), [
                    'page' => 'integer',
                ]);

                if ($validator->fails()) {
                    return LibraryController::responseApi([], $validator->getMessageBag(), 1);
                }
            }

            $head = [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'API-KEY' => env('KEY_API_BOTCONVERSA')
            ];

            $controller = strtolower(str_replace("Controller", "", $this->controller));

            if ($page) {
                $url = env('URL_WEBHOOK_BOTCONVERSA').$controller.'/?page='.$page;
            }else{
                $url = env('URL_WEBHOOK_BOTCONVERSA').$controller.'/';
            }

            $response = Http::timeout(150)->withHeaders($head)->get($url);

            return response($response->json());

        } catch (Exception $e) {
            return response()->json(LibraryController::responseApi([], $e->getMessage(), 1));
        }
    }

}
