<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Category;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function home()
    {
        // https://lumen.laravel.com/docs/6.x/database#basic-usage

        //$results = DB::select("SELECT * FROM tasks");
        //dump($results);

        $category = new Category();


        // https://laravel.com/docs/6.x/eloquent#retrieving-models
        //dump($category::all())

        //dump($category::find(1)); // WHERE ID =
        //dump($category::find([1,4]));
        //dump($category::where('id', 4)->get());

        $category->name = 'Titre pro';
        $category->save();

        //https://laravel.com/docs/6.x/eloquent#deleting-models
        //$category::destroy(6);
        //$category::destroy([4,5]);


    }

    //
}
