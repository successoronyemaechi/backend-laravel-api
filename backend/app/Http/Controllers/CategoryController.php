<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CategoryController extends Controller
{

    public function getCategoryName() {
        $categoryName = Category::query()->get();
        if ($categoryName) {
            return response([
                $categoryName
            ], ResponseAlias::HTTP_OK);
        }
        return response([
            'error' => 'No category found!'
        ], ResponseAlias::HTTP_NOT_FOUND);
    }

}
