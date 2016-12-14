<?php

Class ChartModel
{
	public static function chartdata($coin) 
	{
		
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection(); 
		
		//sql to run
		$sql = "SELECT trade_date, sum(trade_amount) AS amount, trade_time, avg(trade_price) AS price, 
				EXTRACT(YEAR from trade_date) AS year,
				EXTRACT(MONTH from trade_date) AS month,
				EXTRACT(DAY from trade_date) AS day,
				EXTRACT(HOUR from trade_date) AS hour,
				EXTRACT(MINUTE from trade_date) AS minute
				FROM trades 
				WHERE trade_market = ? 
				GROUP BY year, month, day, hour, minute;";
        
		//run sql
		$chartdata = $database->prepare($sql);
        $chartdata->execute(array($coin));
        
		//return the data
		return $chartdata->fetchAll();
    }
	
	public static function home($market)
	{
		//iniate the database
		$database = DatabaseFactory::getFactory()->getConnection(); 
		
		//sql to run
		$sql = "SELECT day(trade_date) 
					AS day, 
					trade_date, 
					sum(trade_amount) AS amount, 
					avg(trade_price) AS total 
				FROM trades 
				GROUP BY day(trade_date)";
				
		//run the sql
		$chart = $database->prepare($sql);
		$chart->execute(array($market));
		
		//return the results
		return $chart->fetchAll();
	}
}