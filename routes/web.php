<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MiguelController;
use App\Http\Controllers\Session;
use App\Models\Post;
use App\Models\User;
use App\Models\Country;
use App\Models\Photo;
use App\Models\Tag;
use App\Models\Video;

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

Route::get('/', function () {
    return view('welcome');
    // echo "Hola amigo";
});
Route::get('/hola/{id}', function (String $hola) {
    // return view('welcome');
    echo "Hola amigo " . $hola;
});


Route::get('/naming/routes', array("as" => "first.name.route", function () {
    return "Hola desde el nombre de mi ruta que es: " . route("first.name.route");
}));

// Route::get('/miguel', [MiguelController::class, 'index']);
Route::resource('/miguels', 'App\Http\Controllers\MiguelController');
Route::get('/miguel/{id}/{name}/{two}', [MiguelController::class, 'testingView']);

Route::get('/insert', function () {
    DB::insert('insert into posts(id, name, amount) values(?,?,?)', [1223, "hello 34", 3213.2]);
});

Route::get('/select', function () {
    $results = DB::select('select * from posts');
    foreach ($results as $result) {
        echo $result->id . "<br/>";
    }
});

Route::get('/all', function () {
    $posts = Post::all();
    foreach ($posts as $post) {
        echo $post->name . "<br/>";
    }
});


Route::get('/find/{id}', function ($id) {
    $post = Post::find($id);

    echo $post->name . "<br/>";
});
Route::get('/where', function () {
    $post = Post::where("name","LIKE","%hello%")->orderBy('name')->get();
    // var_dump($post);
    echo $post[0]->name . "<br/>";
});


Route::get('/createORM', function() {
    $post = new Post();
    $post->name = "From code";
    $post->amount = 423.4;
    $post->save();
});
Route::get('/updateORM', function() {
    $post = Post::find(1224);
    $post->name = "From other code";
    $post->amount = 111.4;
    $post->save();
});
Route::get('/createMass', function() {
    Post::create(["name" => "Nombre de masa", "amount"=>12.2]);
});
Route::get('/getAndUpdate', function() {
    Post::where('id',123)->where('amount',3213.20)->update(['name'=> "Hola Migue"]);
});


Route::get('/deleted', function() {
    Post::destroy([1224,1225]);
});


Route::get('/allTrashed', function () {
    $posts = Post::withTrashed()->where('amount', '>', 0)->get();
    foreach ($posts as $post) {
        echo $post->name . "<br/>";
    }
});

Route::get('/restore', function () {
    Post::withTrashed()->where('id', 1224)->restore();
});

Route::get('/forceDelete', function () {
    Post::onlyTrashed()->where('id', 1225)->forceDelete();
});

Route::get('/user/{id}/post_onlyOne', function ($id) {
    return User::find($id)->post->name;
});

Route::get('/posts/{id}/user', function($id){
    return Post::find($id)->user->name;
});

Route::get('/users/{id}/posts', function ($id) {
    $posts = User::find($id)->posts;
    foreach($posts as $post){
        echo $post->name."<br/>";
    }
});

Route::get('/users/{id}/roles', function($id){
    $roles = User::find($id)->roles()->orderBy('id','desc')->get();
    foreach($roles as $role){
        echo $role->name." - ".$role->pivot->created_at."<br/>";
    }
});

Route::get('/countries/{countryId}/posts', function($countryId){
    $country = Country::find($countryId);
    foreach($country->posts as $post){
        echo $post->name."<br/>";
    }
});

Route::get('/post/{postId}/photos', function($postId){
    $post = Post::find($postId);
    foreach($post->photos as $photo){
        echo $photo->path."<br/>";
    }
});
Route::get('/user/{userId}/photos', function($userId){
    $user = User::find($userId);
    foreach($user->photos as $photo){
        echo $photo->path."<br/>";
    }
});
Route::get('/photo/{id}/post', function($id){
    $photo = Photo::findOrFail($id);
    return $photo->imageable;
});

Route::get('/post/{id}/tags', function($id){
    $post = Post::findOrFail($id);
    return $post->tags;
});
Route::get('/videos/{id}/tags', function($id){
    $video = Video::findOrFail($id);
    return $video->tags;
});
Route::get('/tags/{id}/post', function($id){
    $tag = Tag::findOrFail($id);
    return $tag->posts;
});


Route::get('/middle',['middleware'=> 'role', function(){
    return "hola";
}]);

Route::get('/sessions', [Session::class,'session']);