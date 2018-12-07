<?php

//Method2 yg Global dipake taruh sini Guys.. biar ga bentar2 buat.. tinggal panggil aja.. Ciaoyouuuuu ^_^d
//Medivh as strong as Jody
use Carbon\Carbon;

function formatPrice($price){
	return number_format($price,2,",",".");
}
function priceToInt($price){
	//inibuat yg ada cent nya..
	return (int) str_replace([',00','.'], '', $price);
}
function rollbackPrice($price){
	//inibuat yg ga ada cent nya..
	return (int) str_replace(['.'], '', $price);
}
function thisday(){
	$data = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i');
	return $data;
}
?>
