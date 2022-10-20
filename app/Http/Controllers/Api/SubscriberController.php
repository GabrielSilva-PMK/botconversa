<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LibraryController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
{

    public $controller = 'SubscriberController';

    public function index(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'phone' => 'required',
            ]);

            if ($validator->fails()) {
                return LibraryController::responseApi([], $validator->getMessageBag(), 1);
            }

            $head = [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'API-KEY' => env('KEY_API_BOTCONVERSA')
            ];

            $phone = $request->phone;

            $controller = strtolower(str_replace("Controller", "", $this->controller));

            $url = env('URL_WEBHOOK_BOTCONVERSA').$controller.'/'.$phone;

            $response = Http::timeout(150)->withHeaders($head)->get($url);

            return response($response->json());

        } catch (Exception $e) {
            return response()->json(LibraryController::responseApi([], $e->getMessage(), 1));
        }
    }

}
