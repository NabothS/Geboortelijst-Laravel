<?php

use App\Http\Controllers\Admin\ScrapeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BabyListController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Models\BabyList;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [BabyListController::class, "show"])->middleware(['auth'])->name('dashboard');

Route::post('/scrape/categories', [ScrapeController::class, 'whichScrape'])->middleware(['auth'])->name('scrape.categories');
Route::post('/scrape/articles', [ScrapeController::class, 'whichArticleScrape'])->middleware(['auth'])->name('scrape.articles');

Route::get('/scraper', [ScrapeController::class, "show"])->middleware(['auth'])->name('scraper');

Route::get('/makeList', function () {
    return view('make-a-list');
})->middleware(['auth'])->name('makeList');

Route::post('/makeList', [BabyListController::class, 'makeList'])->middleware(['auth'])->name('makeList');

Route::get('list/{id}', [BabyListController::class, 'isList'])->middleware(['auth']);

Route::post('/addArticles', [BabyListController::class, 'goToAddArticles'])->middleware(['auth'])->name('addArticles');
Route::post('/add', [BabyListController::class, 'add'])->middleware(['auth'])->name('add');
Route::post('list/delete/{id}', [BabyListController::class, 'delete'])->middleware(['auth']);

Route::get('showList/{listUrl}', [BabyListController::class, 'showValidation']);
Route::post('checkPass' , [BabyListController::class, 'checkPass'])->name('checkPass');

Route::post('deleteList/{id}', [BabyListController::class, 'deleteList']);

Route::post('/store', [BabyListController::class, 'store'])->name('store');

Route::get('/categories', [CategoryController::class, "show"])->middleware(['auth'])->name('categories');

Route::get('/articles', [ArticleController::class, "show"])->middleware(['auth'])->name('articles');
Route::post('/articles', [ArticleController::class, "showFiltered"])->middleware(['auth'])->name('articles.filter');


require __DIR__.'/auth.php';
