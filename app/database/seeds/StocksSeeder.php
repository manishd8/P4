<?php

class StocksSeeder extends Seeder {


	public function run() {


		$json = file_get_contents('app/database/seeds/companylist.csv');

		
		$data = explode("\n",$json);

		
		$data_count = count($data)-1;

		for($j=0; $j<$data_count; ++$j)
		{		
			$stock = new Stock;


			$data_stock = explode(",",$data[$j]);	

			$stock = new Stock;
			$stock->stock_symb    	 = $data_stock['0'];

			$data_stock_count = count($data_stock);
			
			$companyname = "";
			for($i=1; $i<$data_stock_count; ++$i)
			{
				$companyname.=$data_stock[$i];
			}

			$stock->stock_name    	 = $companyname;


			$stock->prev_day    	 = 10.0;
			$stock->week_avg    	 = 10.0;
			$stock->mon_avg    		 = 10.0;
			$stock->year_avg    	 = 10.0;
			
			$stock->save();
		
		}
	}
}
