<?php 
    
namespace App\Helpers;

class General 
{
    // fungsi untuk mengubah format tanggal mejadi format tanggal Indonesia
    public static function tgl_indonesia($tgl){
        $tanggal = substr($tgl, 8, 2);

        $nama_bulan = array("Januari", "Februari", "Maret", "April", "Mei", 
                            "Juni", "Juli", "Agustus", "September", 
                            "Oktober", "November", "Desember");

        $bulan = $nama_bulan[substr($tgl, 5, 2) - 1];
        $tahun = substr($tgl, 0, 4);

        return $tanggal .' '. $bulan .' '. $tahun;       
    }

    public static function ambilBulanTahun($tgl){
        $date = General::tgl_indonesia($tgl);

        return substr($date, 3);
    }

    //function untuk mendapatkan folder path berita
    public static function getFolderPath($date, $slug){
        $first  = str_replace(' ', '-', strtolower(General::tgl_indonesia($date)));
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