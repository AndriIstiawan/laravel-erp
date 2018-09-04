<?php

namespace erfanbagussetiana\rajaongkirpro;

use erfanbagussetiana\rajaongkirpro\app\Cost_luar;
use erfanbagussetiana\rajaongkirpro\app\Dikirim_dari;
use erfanbagussetiana\rajaongkirpro\app\International;
use erfanbagussetiana\rajaongkirpro\app\Kecamatan;
use erfanbagussetiana\rajaongkirpro\app\Provinsi;
use erfanbagussetiana\rajaongkirpro\app\Kota;
use erfanbagussetiana\rajaongkirpro\app\Cost;

class RajaOngkir {
	public function Provinsi(){
		return new Provinsi;
	}

	public function Kota(){
		return new Kota;
	}

    public function kecamatan(){
        return new Kecamatan;
    }

    public function international(){
	    return new International;
    }
    public function dikirim_dari(){
        return new Dikirim_dari;
    }
	public function Cost($attributes){
		return new Cost($attributes);
	}
	public function Cost_luar($attributes){
		return new Cost_luar($attributes);
	}
}