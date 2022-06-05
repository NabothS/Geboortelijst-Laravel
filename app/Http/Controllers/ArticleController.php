<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\ScrapedCategories;
use App\Models\Shop;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function show(){
        $mimiShopId = Shop::where('name', 'Mimi Baby')->firstOrFail();
        $mimiShopId = $mimiShopId->id;
        $kabineShopId = Shop::where('name', 'Kabine')->firstOrFail();
        $kabineShopId = $kabineShopId->id;
        $cornerShopId = Shop::where('name', 'Baby Corner')->firstOrFail();
        $cornerShopId = $cornerShopId->id;


        $mimiArticles = Article::where('shop_id', $mimiShopId)->get();
        $kabineArticles = Article::where('shop_id', $kabineShopId)->get();
        $cornerArticles = Article::where('shop_id', $cornerShopId)->get();

        $scrapedCategories = ScrapedCategories::all();

        return view('articles', compact('mimiArticles', 'kabineArticles', 'cornerArticles', 'scrapedCategories'));

    }

    public function showFiltered(Request $r){
        if($r->category == "Alles") return redirect("/articles");

        $mimiShopId = Shop::where('name', 'Mimi Baby')->firstOrFail();
        $mimiShopId = $mimiShopId->id;
        $kabineShopId = Shop::where('name', 'Kabine')->firstOrFail();
        $kabineShopId = $kabineShopId->id;
        $cornerShopId = Shop::where('name', 'Baby Corner')->firstOrFail();
        $cornerShopId = $cornerShopId->id;


        $mimiArticles = Article::where('shop_id', $mimiShopId)->where('category_id', $r->category)->get();
        $kabineArticles = Article::where('shop_id', $kabineShopId)->where('category_id', $r->category)->get();
        $cornerArticles = Article::where('shop_id', $cornerShopId)->where('category_id', $r->category)->get();

        $scrapedCategories = ScrapedCategories::all();

        return view('articles', compact('mimiArticles', 'kabineArticles', 'cornerArticles', 'scrapedCategories'));
    }

    public function deleteArticle($id){


        return redirect()->back();

    }
}
