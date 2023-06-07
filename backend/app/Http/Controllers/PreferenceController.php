<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Preference;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PreferenceController extends Controller
{
    public function addToPreference(Request $request)
    {
        $user = Auth::user(); // Assuming you want to add the preference for the authenticated user

        $preference = Preference::query()->updateOrCreate(['user_id' => $user->id]);

        $title = $request->input("title");

        $existingArticle = Article::query()
            ->where('preference_id', $preference->id) // Access the ID of the preference
            ->where('title', $title)
            ->first();

        if ($existingArticle) {
            // Article with the same title already exists for the preference
            // You can handle this case according to your requirements
            return response([
                "status" => 'duplicate',
                "message" => 'Already added to your preference!',
            ], ResponseAlias::HTTP_NOT_ACCEPTABLE);
        }

        Article::query()->create([
            'preference_id' => $preference->id,
            'title' => $title,
            'author' => $request->input("author"),
            'description' => $request->input("description"),
            'url' => $request->input("url"),
            'urlToImage' => $request->input("urlToImage"),
            'publishedAt' => $request->input("publishedAt"),
        ]);

        return response([
            "status" => 'success',
            "message" => 'Successfully added to your preference!'
        ], ResponseAlias::HTTP_OK);
    }

    public function getUserPreference(Request $request)
    {
        $user = Auth::user();
        $preference = Preference::query()->where('user_id', $user->id)->first();

        if ($preference) {
            $userPreferenceArticle = Article::with('preference')
                ->where('preference_id', $preference->id)
                ->orderBy('id', 'DESC')
                ->get();

            return response([
                'status' => 'success',
                'data' => $userPreferenceArticle,
            ], ResponseAlias::HTTP_OK);
        } else {
            return response([
                'status' => 'error',
                'message' => 'No preference yet! ',
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
    }


}
