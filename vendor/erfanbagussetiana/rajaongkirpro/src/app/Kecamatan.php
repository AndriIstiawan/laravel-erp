<?php

namespace erfanbagussetiana\rajaongkirpro\app;

class Kecamatan extends Api {
    protected $method = "subdistrict";

    public function byKota($city_id){
        $this->parameters = "?city=".$city_id;
        return $this->GetData();
    }
}