<?php

namespace App\Models;

use App\Models\Division;
use Illuminate\Database\Eloquent\Model;

class Work_Program extends Model
{
    protected $fillable = [
        'program', 'description', 'division_id'
    ];

    //relations
    public function division(){
        return $this->belongsTo(Division::class);
    }
}
