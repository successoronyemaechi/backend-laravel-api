<?php

namespace App\Http\Controllers;

use App\Models\Source;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SourceController extends Controller
{


    public function getSourceName() {
        $sourceName = Source::query()->get();
        if ($sourceName) {
            return response([
                $sourceName
            ], ResponseAlias::HTTP_OK);
        }
        return response([
            'error' => 'No source found!'
        ], ResponseAlias::HTTP_NOT_FOUND);
    }
}
