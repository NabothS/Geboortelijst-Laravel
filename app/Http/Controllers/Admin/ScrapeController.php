<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ShopController;
use App\Models\Article;
use App\Models\Category;
use App\Models\ScrapedCategories;
use App\Models\Shop;
use Goutte\Client;
use Illuminate\Http\Request;
use stdClass;

class ScrapeController extends Controller
{
    public function show(){

        if(auth()->user()->isAdmin == 0) return redirect("/dashboard");

        $shops = Shop::all();

        return view('scraper', compact('shops'));

    }
    public function whichScrape(Request $r){

        switch($r->shop){
            case 'https://www.thebabyscorner.be/nl-be/baby_spelen/' :
                $filter = '.column-facets  div .facets div:nth-child(3) .cnt ul li label a';
                $shop = 'Baby Corner';
                $this->scrapeCategories($r->shop, $filter, $shop);
                break;

            case 'https://www.mimibaby.be/nl/spelen':
                $filter = '.filter-panel-items-container .filter-select-category div ul li div a';
                $shop = 'Mimi Baby';
                $this->scrapeCategories($r->shop, $filter, $shop);
                break;

            case 'https://kabine.be/product-categorie/in-huis/speelkamer/':
                $filter = '.sidebar-container div .widget_product_categories .product-categories .cat-item-2094 .cat-item-2115 ul li a';
                $shop = 'Kabine';
                $this->scrapeCategories($r->shop, $filter, $shop);
                break;
        }

        return redirect("/scraper");

    }

    public function whichArticleScrape(Request $r) {

        switch($r->shop){
            case 'Mimi Baby' :
                $this->scrapeMimiArticles($r->url, $r->shop);
                $category = Category::where('url', $r->url)->firstOrFail();
                $scrapedCategory = new ScrapedCategories();
                $scrapedCategory->categoryId = $category->id;
                $scrapedCategory->category = $category->category;
                $scrapedCategory->save();
                return redirect("/categories");

                break;

            case 'Kabine':
                $this->scrapeKabineArticles($r->url, $r->shop);
                $category = Category::where('url', $r->url)->firstOrFail();
                $scrapedCategory = new ScrapedCategories();
                $scrapedCategory->categoryId = $category->id;
                $scrapedCategory->category = $category->category;
                $scrapedCategory->save();
                return redirect("/categories");
                break;

            case 'Baby Corner':
                $this->scrapeCornerArticles('https://www.thebabyscorner.be' . $r->url, $r->shop, $r->url);
                $category = Category::where('url', $r->url)->firstOrFail();
                $scrapedCategory = new ScrapedCategories();
                $scrapedCategory->categoryId = $category->id;
                $scrapedCategory->category = $category->category;
                $scrapedCategory->save();
                return redirect("/categories");
                break;
        }
    }

    public function scrapeCategories($url, $filter, $shop){
        $client = new Client();
        $craw = $client->request('GET', $url);

        $categories = $craw->filter($filter)
                            ->each(function($node) {
                                $category = $node->text();
                                $url = $node->attr('href');

                                $cat = new stdClass();
                                $cat->category = $category;
                                $cat->url = $url;
                                return $cat;
                            });

        foreach($categories as $scrapeCategory){
            $exists = Category::where('url', $scrapeCategory->url)->count();

            if ($exists > 0 ) continue;

            $categoryEntity = new Category();
            $categoryEntity->category = $scrapeCategory->category;
            $categoryEntity->url = $scrapeCategory->url;
            $categoryEntity->shopName = $shop;
            $categoryEntity->save();
        }
    }

    private function scrapeMimiArticles($url, $shop) {
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $articles = $this->scrapeMimiPageData($crawler);

        foreach($articles as $article){
            $exists = Article::where('name', $article->name)->count();

            if ($exists > 0 ) continue;


            $dbShop = Shop::where('name' , $shop)->firstOrFail();
            $dbShop = $dbShop->id;

            $dbCategory = Category::where('url' , $url)->firstOrFail();
            $dbCategory = $dbCategory->id;

            $priceExplode = explode('€', $article->price);
            $priceExplode = explode(',' , $priceExplode[1]);
            $priceExplode = $priceExplode[0] . '.' . $priceExplode[1];

            $articleEnt = new Article();
            $articleEnt->name = $article->name;
            $articleEnt->price = $priceExplode;
            $articleEnt->category_id = $dbCategory;
            $articleEnt->shop_id = $dbShop;
            $articleEnt->image = $article->image;
            $articleEnt->save();
        }

    }

    private function scrapeMimiPageData($crawler) {
        return $crawler->filter('.card-body')->each(function($node){
            $article = new stdClass();
            $article->name = $node->filter('.product-info a')->first()->text();
            $article->price = $node->filter('.product-info .product-price-info .product-price-wrapper span')->first()->text();
            $article->image = $node->filter('.product-image-wrapper a img')->first()->attr('src');
            return $article;
        });
    }

    private function scrapeKabineArticles($url, $shop){
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $articles = $this->scrapeKabinePageData($crawler);

        foreach($articles as $article){
            $exists = Article::where('name', $article->name)->count();

            if ($exists > 0 ) continue;


            $dbShop = Shop::where('name' , $shop)->firstOrFail();
            $dbShop = $dbShop->id;

            $dbCategory = Category::where('url' , $url)->firstOrFail();
            $dbCategory = $dbCategory->id;

            $priceExplode = explode('€', $article->price);
            $priceExplode = explode(',' , $priceExplode[1]);
            $priceExplode = $priceExplode[0] . '.' . $priceExplode[1];

            $articleEnt = new Article();
            $articleEnt->name = $article->name;
            $articleEnt->price = $priceExplode;
            $articleEnt->category_id = $dbCategory;
            $articleEnt->shop_id = $dbShop;
            $articleEnt->image = $article->image;
            $articleEnt->save();
        }
    }

    private function scrapeKabinePageData($crawler) {
        return $crawler->filter('.product-inner .woo-entry-inner')->each(function($node){
            $article = new stdClass();
            $article->name = $node->filter('.title h2 a')->first()->text();
            $article->price = $node->filter('.price-wrap .price span bdi')->first()->text();

            $link = $node->filter('.image-wrap div a img')->attr('data-srcset');
            $newLink = explode(' ', $link);
            $article->image = $newLink[0];
            return $article;
        });
    }

    private function scrapeCornerArticles($url, $shop, $categoryUrl){
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $articles = $this->scrapeCornerPageData($crawler);

        foreach($articles as $article){
            $exists = Article::where('name', $article->name)->count();

            if ($exists > 0 ) continue;


            $dbShop = Shop::where('name' , $shop)->firstOrFail();
            $dbShop = $dbShop->id;

            $dbCategory = Category::where('url' , $categoryUrl)->firstOrFail();
            $dbCategory = $dbCategory->id;

            $priceExplode = explode('€', $article->price);
            $priceExplode = explode(',' , $priceExplode[1]);
            $priceExplode = $priceExplode[0] . '.' . $priceExplode[1];

            $articleEnt = new Article();
            $articleEnt->name = $article->name;
            $articleEnt->price = $priceExplode;
            $articleEnt->category_id = $dbCategory;
            $articleEnt->shop_id = $dbShop;
            $articleEnt->image = $article->image;
            $articleEnt->save();
        }
    }

    private function scrapeCornerPageData($crawler) {
        return $crawler->filter('.l-products-item')->each(function($node){
            $article = new stdClass();
            $article->name = $node->filter('div .product-info .product-description h3 a span')->first()->text();
            $article->price = $node->filter('div .product-info .product-action span .lbl-price')->first()->text();
            $article->image = 'https://www.thebabyscorner.be' . $node->filter('div .product-img div .hyp-thumbnail span img')->first()->attr('data-src');
            return $article;
        });
    }
}
