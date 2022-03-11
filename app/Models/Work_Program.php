<?php

namespace App\Models;

use App\Models\Division;
use App\Models\Main_Model;

class Work_Program extends Main_Model
{
    protected $fillable = [
        'program', 'description', 'division_id'
    ];

    //relations
    public function division(){
        return $this->belongsTo(Division::class);
    }

    //functions
    public function getByDivisi($id){
        return $this->select('progja.*, divisi.alias')
                    ->where('progja.divisi', $id)
                    ->join('divisi', 'divisi.id = progja.divisi');
    }
}
