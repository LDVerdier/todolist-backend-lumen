<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function list()
    {

        $categoriesList = Category::all()->load('tasks');
        //return response()->json($categoriesList, 200);
        //adding random comment
        return $this->sendJsonResponse($categoriesList, 200);

        //dump($categoriesList);

    }


    public function item($categoryId)
    {
        //$categoryId est un string
        //à nous de le convertir en int
        $categoryId = intval($categoryId);
        $categoriesList = [
            1 => [
                'id' => 1,
                'name' => 'Chemin vers O\'clock',
                'status' => 1
            ],
            2 => [
                'id' => 2,
                'name' => 'Courses',
                'status' => 1
            ],
            3 => [
             'id' => 3,
                'name' => 'O\'clock',
                'status' => 1
            ],
            4 => [
                'id' => 4,
                'name' => 'Titre Professionnel',
                'status' => 1
            ]
        ];

        // avant de récupérer la categorie pour l'id fourni
        // je dois verifier que cette id existe comme clé du tableau

        if(array_key_exists($categoryId, $categoriesList)){
            $category = $categoriesList[$categoryId];
            return response()->json($category);
        } else{
            // J'affiche une 404
            abort(404);
        }


    }

    //
}
