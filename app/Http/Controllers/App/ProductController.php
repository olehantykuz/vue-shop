<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product as ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * @param ProductService $service
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
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
        $products = $service->all($request->get('count'));

        return ProductResource::collection($products);
    }

    /**
     * @param ProductService $service
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function list(ProductService $service, Request $request)
    {
        /** @var \Illuminate\Contracts\Validation\Validator $validator */
        $validator = Validator::make($request->all(), [
            'ids' => 'required|array',
        ]);

        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()], 400);
        }
        $products = $service->getListByIds($request->get('ids'));

        return ProductResource::collection($products);
    }

}
