<?php

declare(strict_types=1);

namespace App\Http\Controllers;


use App\Http\Requests\ProductFilteredRequest;
use App\Http\Resources\ProductFilterResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductController extends Controller
{

    public function index(ProductFilteredRequest $request): JsonResource
    {
        return ProductFilterResource::make($request->execute());
    }

}
