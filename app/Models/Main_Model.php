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
        return $this->findAll($length, $start);
    }

    public function getDataSearch($search, $length, $start){
        return $this->like('divisi', $search)->findAll($length, $start);
    }

    public function getTotal(){
        // $result = $this->countAll();

        // if(isset($result)){
        //     return $result;
        // }

        // return 0;
        return $this->countAll() ?? 0;
    }

    public function getSearchTotal($search){
        return $this->like('divisi', $search)->countAllResults();
    }
}
