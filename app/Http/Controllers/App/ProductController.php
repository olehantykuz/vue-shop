<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * @param ProductService $service
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ProductService $service, Request $request)
    {
        /** @var \Illuminate\Contracts\Validation\Validator $validator */
        $validator = Validator::make($request->all(), [
            'count' => 'nullable|integer|min:1',
        ]);

        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()], 400);
        }
        $validator->validate();

        $products = $service->all($request->get('count'));

        return response()->json($products, 200);
    }

}
