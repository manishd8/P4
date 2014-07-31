<?php

$httpreq = 'http://finance.yahoo.com/d/quotes.csv?s=';
	$stock1 = Input::get('Stock1');
	$stock2 = Input::get('Stock2');
	$httpreq.=$stock1;
	$httpreq.="+";
	$httpreq.=$stock2;
	$httpreq.="&f=snl1";

	$json = file_get_contents($httpreq);
	$data = explode("\n",$json);
	$data1 = explode(",",$data['0']);
	$data2 = explode(",",$data['1']);



	return $data1['2'];


