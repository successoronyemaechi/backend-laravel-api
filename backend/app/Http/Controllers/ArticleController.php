<?php

namespace App\Http\Controllers;

use App\Models\Article;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ArticleController extends Controller
{

    public function fetchNews(Request $request)
    {
        $newsApiKey = getenv('NEWS_API_KEY');
        $keyword = $request->input('keyword');
        $category = $request->input('name');
        $date = $request->input('date');
        $source = $request->input('source');

        $client = new Client();

        $url = "https://newsapi.org/v2/everything?q=apple&apiKey=$newsApiKey";

        if ($request->isMethod('post')) {
            if ($keyword && $date && !$category && !$source) {
                $url = "https://newsapi.org/v2/everything?q=$keyword&from=$date&apiKey=$newsApiKey";
            } elseif ($category && $keyword && !$date && !$source) {
                $lower_cat = Str::lower($category);
                $url = "https://newsapi.org/v2/top-headlines?country=us&category=$lower_cat&apiKey=$newsApiKey";
            } elseif ($keyword && $category && $date && !$source) {
                $url = "https://newsapi.org/v2/everything?q=apple&from=$date&apiKey=$newsApiKey";
            }elseif (!$keyword && !$category && !$date && $source) {
                if ($source === "GuardianApi") {
                    $url = "https://newsapi.org/v2/everything?domains=theguardian.com&apiKey=$newsApiKey";
                } elseif ($source === "BBC") {
                    $url = "https://newsapi.org/v2/everything?domains=bbc.com&apiKey=$newsApiKey";
                } elseif ($source === "NewsApi") {
                    $url = "https://newsapi.org/v2/everything?q=apple&apiKey=$newsApiKey";
                }
            } elseif ($category && !$date && !$keyword && !$source) {
                $lower_cat = Str::lower($category);
                $url = "https://newsapi.org/v2/top-headlines?country=us&category=$lower_cat&apiKey=$newsApiKey";
            } elseif ($date && !$category && !$keyword) {
                $url = "https://newsapi.org/v2/everything?q=apple&from=$date&apiKey=$newsApiKey";
            }elseif ($keyword && !$date && !$category && !$source) {
                $url = "https://newsapi.org/v2/everything?q=$keyword&apiKey=$newsApiKey";
            }elseif ($keyword && !$date && $category && $source) {
                $lower_cat = Str::lower($category);
                $url = "https://newsapi.org/v2/top-headlines?country=us&category=$lower_cat&apiKey=$newsApiKey";
            }
        }

        try {
            $response = $client->get($url);
            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody()->getContents(), true);
                $articles = $data['articles'];
                return response()->json($articles);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch news'], 500);
        }

        return response()->json(['error' => 'Failed to fetch news'], 500);
    }
}
