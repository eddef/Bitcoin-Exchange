<?php
namespace Filtration\Model;

Class TickerModel
{

    public static function btc($currency, $time) 
	{
		//get ingo
        $data = file_get_contents("https://btc-e.com/api/2/btc_" . strtolower($currency) . "/ticker");
        $data = json_decode($data, true);
        $spot_last = $data['ticker'][$time];
        return $spot_last;
    }
	
    public static function usd($currency, $time) 
	{
        $data = file_get_contents("https://btc-e.com/api/2/ltc_" . strtolower($currency) . "/ticker");
        $data = json_decode($data, true);
        $spot_last = $data['ticker'][$time];
        return $spot_last;
    }

}