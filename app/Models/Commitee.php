<?php

namespace App\Models;

use App\Models\Division;
use App\Models\Position;
use App\Models\Main_Model;

class Commitee extends Main_Model
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
    public function joinDivisi(){
        return $this->join('divisi', 'pengurus.divisi', '=', 'divisi.id');
    }

    public function getByDivisi($id){
        return $this->select('pengurus.*, jabatan.jabatan, divisi.divisi')
                    ->where('pengurus.divisi', $id)
                    ->join('jabatan', 'pengurus.jabatan', '=', 'jabatan.id')
                    ->joinDivisi();
    }

    public function getAnggotaHimatif(){
        return $this->select('divisi.*')
                    ->selectRaw('(jabatan = 6) as intern')
                    ->selectRaw('(jabatan != 6) as utama')
                    ->joinDivisi()
                    ->groupBy('divisi.divisi') 
                    ->orderBy('pengurus.divisi')
                    ->findAll();
    }
}
