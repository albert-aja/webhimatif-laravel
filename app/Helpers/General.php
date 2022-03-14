<?php 
    
namespace App\Helpers;

class General 
{
    /**
     * Convert the given datetime to Indonesia date format.
     * 
     * @param string $date
     * @param bool $useTime
     * 
     * @return string
     */
    public static function indonesia_date(string $date, bool $useTime = false){
        $day = substr($date, 8, 2);

        $month_name = [
            "Januari", "Februari", "Maret", 
            "April", "Mei", "Juni", "Juli", 
            "Agustus", "September", "Oktober", 
            "November", "Desember"
        ];

        $month = $month_name[substr($date, 5, 2) - 1];
        $year = substr($date, 0, 4);

        $time = ($useTime) ? ' '. substr($date, 11, 5) : '';

        return $day .' '. $month .' '. $year . $time;       
    }

    /**
     * Convert the given datetime to Indonesia month year format.
     * 
     * @param string $date
     * 
     * @return string
     */
    public static function ambilBulanTahun(string $date){
        $date = self::indonesia_date($date);

        return substr($date, 3);
    }
    
    /**
     * Convert the given datetime to Indonesia month year format.
     * 
     * @param string $date
     * @param string $slug
     * 
     * @return string
     */
    public static function getFolderPath($date, $slug){
        $first  = str_replace(' ', '-', strtolower(self::indonesia_date($date)));
        $second = $slug;

        return $first .'_'. $second;
    }

    //function untuk mendapatkan waktu membaca
    public static function readingTime($article){
        $word = str_word_count(strip_tags($article));
        $m    = floor($word / 200);
        $s    = floor($word % 200 / (200 / 60));

        if($s >= 20){
            $m += 1;
        }

        return '&plusmn; '  .$m . ' menit';
    }

    public static function convert_money($harga){
        return 'Rp. ' .substr(strrev(chunk_split(strrev($harga),3, '.')), 1);
    }

    // fungsi untuk random warna bootstrap
    public static function random_color(){
        $color = array("primary", "success", "danger", "warning", "info");

        $number = rand(0, count($color) - 1);

        return $color[$number];       
    }
}
?>