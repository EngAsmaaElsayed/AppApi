<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\SubCategory;
use App\Models\User;
use App\Http\Traits\AppResponse;
use Illuminate\Http\Request;

class AppController extends Controller
{
    use AppResponse;

    /**
     * Get Activities
     * @return \Illuminate\Http\JsonResponse
     */
    public function category(){
        $category=Category::all();
        return $this->SuccessResponse($category,200);
    }

    /**
     * Get subCategoryWithItems
     * @return \Illuminate\Http\JsonResponse
     */

    public function subCategoryWithItems($categoryId){
        $items = SubCategory::with(['items' => function ($query) {
            $query->paginate(10);
        }])
            ->where('category_id', $categoryId)
            ->get();
        return $this->SuccessResponse($items,200);
    }
    /**
     * Get Items By SubCategoryId
     * @return \Illuminate\Http\JsonResponse
     */

    public function ItemsBySubCategory($subCategoryId){
        $item=Item::whereSubCategoryId($subCategoryId)->paginate(20);
        return $this->SuccessResponse($item,200);
    }
}
