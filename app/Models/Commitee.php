<?php

namespace App\Models;

use App\Models\Division;
use App\Models\Position;
use Illuminate\Database\Eloquent\Model;

class Commitee extends Model
{
    protected $fillable = [
        'name', 'photo', 'position_id', 'division_id'
    ];

    //relations
    public function position(){
        return $this->belongsTo(Position::class);
    }

    public function division(){
        return $this->belongsTo(Division::class);
    }

    //functions
    public function getAnggotaHimatif(){
        return $this->select('division_id')
                    ->selectRaw('sum(position_id = 6) as intern')
                    ->selectRaw('sum(position_id != 6) as utama')
                    ->groupBy('division_id');
    }
}
