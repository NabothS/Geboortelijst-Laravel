<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\BabyList;
use App\Models\ListArticle;
use App\Models\ScrapedCategories;
use App\Models\Shop;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;

class BabyListController extends Controller
{
    public function show(){
        if(auth()->user()->isAdmin == 1){
            $lists = BabyList::all();
            return view('dashboard', compact('lists'));

        }
        if(auth()->user()->isAdmin == 0){
            $lists = BabyList::where('userId', auth()->user()->id)->get();
            return view('dashboard', compact('lists'));
        }
    }

    public function makeList(Request $r){

        $currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $currentUrl = explode('makeList', $currentUrl);
        $currentUrl = $currentUrl[0];

        $listName = str_replace(' ', '_' , $r->name);

        $babyList = new BabyList();
        $babyList->userId = auth()->user()->id;
        $babyList->listName = $r->name;
        $babyList->listUrl = $currentUrl . 'showList/' . $listName . auth()->user()->id;
        $babyList->listPassword = $r->password;
        $babyList->save();

        return redirect("/dashboard");
    }

    public function isList($id){
        $babyList = BabyList::where('id', $id)->count();

        if ($babyList > 0 ){
            $babyList = BabyList::where('id', $id)->firstOrFail();
            $articles = ListArticle::where('listId', $id)->get();
            return view('listDetail', compact('babyList', 'articles'));
        }

        else return redirect("/dashboard");
    }

    public function goToAddArticles(Request $r){
        $id = $r->id;

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

        return view('addArticles', compact('mimiArticles', 'kabineArticles', 'cornerArticles', 'scrapedCategories', 'id'));
    }

    public function deleteList($id){
        $babyList = BabyList::where('id' , $id);

        $babyList->delete();

        return redirect()->back();
    }

    public function add(Request $r){

        $exists = ListArticle::where('listId', $r->id)->where('articleId', $r->articleId)->count();

        if ($exists == 0 ){
            $listArt = new ListArticle();
            $listArt->listId = $r->id;
            $listArt->articleId = $r->articleId;
            $listArt->save();
        }

            $id = $r->id;

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

            return view('addArticles', compact('mimiArticles', 'kabineArticles', 'cornerArticles', 'scrapedCategories', 'id'));

    }

    public function delete($id){
        $listArticle = ListArticle::where('id' , $id);

        $listArticle->delete();

        return redirect()->back();
    }



    public function showValidation(){
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        return view('validateList', compact('url'));

    }
    public function checkPass(Request $r){
        $list = BabyList::where('listUrl', $r->url)->firstOrFail();
        $password = $list->listPassword;

        if($r->password == $password){
            $listArticles = ListArticle::where('listId', $list->id)->get();
            return view('justShowList', compact('listArticles', 'list'));
        }
        else return redirect()->back();
    }

    /* public function store(Request $r){
        $listArticles = $r->listArticles;
        $list = $r->list;
        $cartItems = $r->cartItems;
        dd($list);

        $listItem = ListArticle::where('id', $r->itemId)->firstOrFail();
        $article = Article::where('id', $listItem->articleId)->firstOrFail();
        Cart::session(1)->add(array(
            'id' => $article->id,
            'name' => $article->name,
            'price' => $article->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $article
        ));



        return redirect()->back();


    } */

    public function store(Request $r){
        $itemId = $r->itemId;
        $article =  ListArticle::where('id', $itemId)->firstOrFail();
        $article->isBought = 1;
        $article->save();

        return redirect()->back();
    }
}
