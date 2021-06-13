<?php

namespace App\Models;

// on importe le coreCodel de lumen
use Illuminate\Database\Eloquent\Model;

//ici mon modèle Category hérite du "coreModele "Model"

class Task extends Model {

    public function category(){
        // cette methode définit le lien / la relation entre les deux tables
        return $this->belongsTo('App\Models\Category');
    }
}
