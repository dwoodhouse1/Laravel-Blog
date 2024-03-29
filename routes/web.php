<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Services\Newsletter;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Symfony\Component\Yaml\Yaml;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('ping', function () {
//     $mailchimp = new \MailchimpMarketing\ApiClient();

//     $mailchimp->setConfig([
//         'apiKey' => config('services.mailchimp.key'),
//         'server' => 'us12'
//     ]);

//     $response = $mailchimp->lists->addListMember('44b1d49c31', [
//         'email_address' => 'dwoodhouse1@hotmail.co.uk',
//         'status' => 'subscribed'
//     ]);

//     ddd($response);
// });

// Route for user posting their email address via the "Subscribe" button
Route::post('newsletter', NewsLetterController::class);


// Route for the index (main) file
Route::get('/', [PostController::class, 'index'])->name('home');

// Route for the posts
Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store'] );

// Route for the registration page + Route for posting a registrated user
Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class,'store'])->middleware('guest');

// Route for logging out, returning to index page
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

// Admin Routes
Route::middleware('can:admin')->group(function () { // This function is so you don't need to add the '->middleware('can:admin');' to the end of the routes
    Route::post('admin/posts', [AdminPostController::class, 'store']);
    Route::get('admin/posts/create', [AdminPostController::class, 'create']);
    Route::get('admin/posts', [AdminPostController::class, 'index']);
    Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
    Route::patch('admin/posts/{post}', [AdminPostController::class, 'update']);
    Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy']);
});






// Route::get('categories/{category:slug}', function (Category $category){
//     return view('posts.show', [
//         'posts' => $category->posts,
//         'currentCategory' => $category, //$category->posts->load(['category', 'author'])
//         'categories' => Category::all()
//     ]);
// })->name('category');


// Route::get('authors/{author:username}', function (User $author) {
//     return view('posts.index', [
//         'posts' => $author->posts,
//     ]);
// });

