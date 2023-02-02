<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SampleStockResource;
use App\Http\Resources\VacationRequestResource;
use App\Models\Category;
use App\Models\SampleStock;
use App\Models\VacationRequest;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CategoryApiController extends Controller
{
    public function index()
    {
        // $category = Auth::user()->categories;
        // $data = CategoryResource::collection($category);
        $data = CategoryResource::collection(Category::all());

        return apiResponse($data);
    }

    public function sample_stock($id)
    {
        $data = SampleStockResource::collection(SampleStock::with(['category'])->where('status', 1)->where('category_id' , $id)->get());
        return apiResponse($data);

    }
}
