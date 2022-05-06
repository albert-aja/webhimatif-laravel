<?php 
    
namespace App\Helpers;

class General 
{
    /**
     * Convert the given datetime to Indonesia date format.
     * 
     * @param string $date
     * @param bool $useTime whether you want to return the time too 
     * (only works if the provided date actually have a time).
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
        return substr(self::indonesia_date($date), 3);
    }

    /**
     * Gets the COMMITEE folder path of an image.
     * 
     * @param string $slug
     * @param string $photo
     * 
     * @return string image folder path
     */
    public static function getCommiteePhoto($slug, $photo, $size = ''){
        return 'img/division/' .$slug. '/' .$photo. '/' .$size.$photo;
    }

    /**
     * Gets the SHOP ITEM folder path of an image.
     * 
     * @param string $category_slug
     * @param string $item_slug
     * @param string $photo
     * 
     * @return string image folder path
     */
    public static function getShopPhoto(string $category_slug, string $item_slug, string $filename, $size = ''){
    }

    /**
     * Fix the difference in photo size issue, 
     * by providing a width that matches the dimensions (w x h) of the photo.
     * Purpose: to ensure that all photos of the commitees are neatly arranged.
     * 
     *  ===========================
     *  |   formula : W/H * 34   |
     *  =========================
     * 
     * W   : photo's width
     * H   : photo's height
     * 34  : constant value set (change this value if you feel it doesnot fit)
     * 
     * @return string adjusted width.
     */
    public static function adjust_commitee_image($photo){
        $size = getimagesize("./" .$photo);

        return $size[0] / $size[1] * 34 .'rem';
    }

    /**
     * Calculate the estimated reading time (in minute) of the given text.
     * 
     * @param int $article The text to calculate the reading time for.
     * @param int $wpm The rate of words per minute to use.
     * 
     * @return string estimated reading time
     */
    public static function readingTime($article, $wpm = 200){
        $total_words = str_word_count(strip_tags($article));

        $minute = floor($total_words / $wpm);
        $second = floor($total_words % $wpm / ($wpm / 60));

        if($second >= 20){
            $minute += 1;
        }

        return '&plusmn; '  .$minute . ' menit';
    }

    /**
     * Convert the given params to Indonesian currency format.
     * e.g Rp. 100.000
     * 
     * @param int $money the value to be converted.
     * 
     * @return string converted currency format.
     */
    public static function convert_money(int $money){
        return 'Rp. ' .substr(strrev(chunk_split(strrev($money),3, '.')), 1);
    }

    /**
     * Randomize bootstrap color class.
     * 
     * @return string bootstrap class.
     */
    public static function random_color(){
        $color = array("primary", "success", "danger", "warning", "info");

        $number = rand(0, count($color) - 1);

        return $color[$number];       
    }

    /**
     * Function to remove file or directory.
     * 
     * @param string $target file/directory link.
     * 
     */
	public static function clearStorage($target){
		if(is_dir($target)){
			$files = glob($target. '/*', GLOB_MARK);

			foreach($files as $file){
				self::clearStorage($file);      
			}

			rmdir($target);
		} elseif(is_file($target)) {
			unlink($target);  
		}
	}
}
?>