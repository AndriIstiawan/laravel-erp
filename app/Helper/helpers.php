<?php

//Method2 yg Global dipake taruh sini Guys.. biar ga bentar2 buat.. tinggal panggil aja.. Ciaoyouuuuu ^_^d
use Carbon\Carbon;

function formatPrice($price){
	return number_format($price,2,",",".");
}
function priceToInt($price){
	return (int) str_replace([',00','.'], '', $price);
}
function thisday(){
	$data = Carbon::now('Asia/Jakarta')->format('Y-m-d G:H:i');
	return $data;
}
?>
