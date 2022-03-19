<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Main_Model extends Model
{
    /**
     * Determines the alias name based on the table
     */
    protected function createAliasFromTable(string $item): string
    {
        if (strpos($item, '.') !== false) {
            $item = explode('.', $item);

            return end($item);
        }

        return $item;
    }

    public function getData($length, $start){
        return $this->skip($start)->take($length)->get();
    }

    public function getDataSearch($search, $length, $start){
        return $this->like('divisi', $search)->findAll($length, $start);
    }

    public function getTotal(){
        return $this->count() ?? 0;
    }

    public function getSearchTotal($search){
        return $this->like('divisi', $search)->count();
    }
}
