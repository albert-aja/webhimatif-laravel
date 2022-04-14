<?php

namespace App\ViewModels\Admin\Dashboard;

use App\Helpers\General;
use Spatie\ViewModels\ViewModel;

class NewsStatChartViewModel extends ViewModel
{
    public $data;

    public function __construct($data){
        $this->data = $data;
    }

    public function chart(){
        $startMonth = $this->data->first()['date']. '-01';
		$endMonth   = date('Y-m-d');

		$start    = new \DateTime($startMonth);
		$end      = new \DateTime($endMonth);
		$interval = new \DateInterval('P1M');
		$period   = new \DatePeriod($start, $interval, $end);

		$this->date_arr = [];
		$i = 0;

		foreach($period as $dt) {
			$this->date_arr[$i]['created_at']   = General::ambilBulanTahun($dt->format("Y-m-d"));
			$this->date_arr[$i]['total']        = '';
			$i++;
		}

        foreach($this->data as &$mt) {
            $mt['date'] = General::ambilBulanTahun($mt['date']. '-01');
            foreach($this->date_arr as &$date){
                if($date['created_at'] == $mt['date']){
                    $date['created_at'] = $mt['date'];
                    $date['total']      = $mt['total'];
                    break;
                }
            }
        }

		$jumlah_data = count($this->date_arr);
		$maks_data = 12;

        if($jumlah_data < $maks_data - 2){
            $this->date_arr = self::nullData($this->date_arr);
        }

        return $this->date_arr;
    }

    private function nullData($array){
		$data = [
			'created_at'    => '',
			'total'         => 'NaN',
		];

		array_unshift($array, $data);
		array_push($array, $data);

		return $array;
	}
}
