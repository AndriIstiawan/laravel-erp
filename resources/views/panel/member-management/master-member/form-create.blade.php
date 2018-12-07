@extends('master') @section('content')
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<div class="container-fluid">
    <div class="animate fadeIn">
        <div class="row">
            <div class="col-md-12">
                <p>
                    <a class="btn btn-primary" href="{{route('master-client.index')}}">
                        <i class="fa fa-backward"></i>&nbsp; Back to List
                    </a>
                </p>
            </div>
        </div>
        <form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('master-client.index') }}">
            {{ csrf_field() }}
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="row">
                <!-- General information -->
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> General
                            <small>Information </small>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="input-group col-md-12">
                                    <input type="text" class="form-control" id="displayName" name="displayName" placeholder="Display Name" aria-describedby="displayName-error">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="ex: Ramawangi"></i>
                                        </span>
                                    </div>
                                    <em id="displayName-error" class="error invalid-feedback"></em>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="input-group col-md-12">
                                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Fullname" aria-describedby="fullname-error">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="ex: Ahmad Rusdi"></i>
                                        </span>
                                    </div>
                                    <em id="fullname-error" class="error invalid-feedback"></em>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="input-group col-md-8">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="ex: Bapak"></i>
                                        </span>
                                    </div>
                                    <select id="title" class="form-control" name="title" aria-describedby="title-error">
                                        <option value=""></option>
                                        <option value="Bapak">Bapak</option>
                                        <option value="Ibu">Ibu</option>
                                    </select>
                                    <em id="title-error" class="error invalid-feedback"></em>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="input-group col-md-8">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email (optional)" aria-describedby="email-error">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="ex: ahamd.rusdi@gmail.com"></i>
                                        </span>
                                    </div>
                                    <em id="email-error" class="error invalid-feedback"></em>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="input-group col-md-12">
                                    <div class="input-group-prepend" style="align-items:unset;">
                                        <span class="input-group-text">
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="ex: 081818827077"></i>
                                        </span>
                                    </div>
                                    <select id="mobile" class="form-control" name="mobile[]" multiple aria-describedby="mobile-error">
                                        <option value=""></option>
                                    </select>
                                    <em id="mobile-error" class="error invalid-feedback"></em>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <div class="input-group col-md-12">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            Rp
                                        </span>
                                    </div>
                                    <input type="text" class="form-control idr-currency" id="limit" name="limit" placeholder="Limit" aria-describedby="limit-error">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="ex: 10000"></i>
                                        </span>
                                    </div>
                                    <em id="limit-error" class="error invalid-feedback"></em>
                                </div>
                            </div>
                            <div class="form-group row col-md-12">
                                <div class="form-group" style="padding-left:30px;">
                                    <input class="form-check-input" type="checkbox" name="whiteLabel">Label Polos
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <!-- Order information -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Order
                            <small>Information </small>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="input-group col-md-12">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            Rp
                                        </span>
                                    </div>
                                    <input type="text" class="form-control idr-currency" id="limit" name="limit" placeholder="Limit Hutang" aria-describedby="limit-error">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="ex: 10000"></i>
                                        </span>
                                    </div>
                                    <em id="limit-error" class="error invalid-feedback"></em>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" style="padding-left:30px;">
                                        <input class="form-check-input" type="checkbox" name="whiteLabel">Label Polos
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="padding-left:30px;">
                                        <input class="form-check-input" type="checkbox" name="packkayu">Kemasan Kayu
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- End Order information -->
                </div>
                <!-- End General information -->

                <!-- Company Information -->
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Company
                            <small>Information </small>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="input-group col-md-12">
                                    <input type="text" class="form-control" id="company" name="company" placeholder="Company (optional)">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="ex: Toko Ramawangi"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="input-group col-md-8">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="ex: RETAIL"></i>
                                        </span>
                                    </div>
                                    <select id="segmenPasar" class="form-control" name="segmenPasar">
                                        <option value=""></option>
                                        <option value="RETAIL">RETAIL</option>
                                        <option value="INDUSTRI">INDUSTRI</option>
                                        <option value="EXPORT">EXPORT</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="input-group col-md-8">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="ex: INDONESIA"></i>
                                        </span>
                                    </div>
                                    <select id="negara" class="form-control" name="negara">
                                        <option value=""></option>
                                        <option value="INDONESIA">INDONESIA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="input-group col-md-8">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="ex: Bali"></i>
                                        </span>
                                    </div>
                                    <select class="form-control province" name="provinsi" id="provinsi">
                                        <option value=""></option>
                                        @foreach ($province as $info)
                                        <option value="{{ $info['province'] }}" data-prov="{{ $info['province_id'] }}">{{ $info['province'] }}</option>
                                        @endforeach
                                    </select>
                                    <!-- <select id="provinsi" class="form-control" name="provinsi">
                                        <option value=""></option>
                                        <option value="Bali">Bali</option>
                                        <option value="Bangka Belitung">Bangka Belitung</option>
                                        <option value="Banten">Banten</option>
                                        <option value="Bengkulu">Bengkulu</option>
                                        <option value="DI Yogyakarta">DI Yogyakarta</option>
                                        <option value="DKI Jakarta">DKI Jakarta</option>
                                        <option value="Gorontalo">Gorontalo</option>
                                        <option value="Jambi">Jambi</option>
                                        <option value="Jawa Barat">Jawa Barat</option>
                                        <option value="Jawa Tengah">Jawa Tengah</option>
                                        <option value="Jawa Timur">Jawa Timur</option>
                                        <option value="Kalimantan Barat">Kalimantan Barat</option>
                                        <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                                        <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                                        <option value="Kalimantan Timur">Kalimantan Timur</option>
                                        <option value="Kalimantan Utara">Kalimantan Utara</option>
                                        <option value="Kepulauan Riau">Kepulauan Riau</option>
                                        <option value="Lampung">Lampung</option>
                                        <option value="Maluku">Maluku</option>
                                        <option value="Maluku Utara">Maluku Utara</option>
                                        <option value="Nanggroe Aceh Darussalam (NAD)">Nanggroe Aceh Darussalam (NAD)</option>
                                        <option value="Nusa Tenggara Barat (NTB)">Nusa Tenggara Barat (NTB)</option>
                                        <option value="Nusa Tenggara Timur (NTT)">Nusa Tenggara Timur (NTT)</option>
                                        <option value="Papua">Papua</option>
                                        <option value="Papua Barat">Papua Barat</option>
                                        <option value="Riau">Riau</option>
                                        <option value="Sulawesi Barat">Sulawesi Barat</option>
                                        <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                                        <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                                        <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                                        <option value="Sulawesi Utara">Sulawesi Utara</option>
                                        <option value="Sumatera Barat">Sumatera Barat</option>
                                        <option value="Sumatera Selatan">Sumatera Selatan</option>
                                        <option value="Sumatera Utara">Sumatera Utara</option>
                                    </select> -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="input-group col-md-8">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="ex: Aceh Barat"></i>
                                        </span>
                                    </div>
                                    <select class="form-control city" name="kota" id="kota">
                                        <option value=""></option>
                                    </select>
                                    <!-- <select id="kota" class="form-control" name="kota">
                                        <option value=""></option>
                                        <option value='Aceh Barat'>Aceh Barat</option>
                                        <option value='Aceh Barat Daya'>Aceh Barat Daya</option>
                                        <option value='Aceh Besar'>Aceh Besar</option>
                                        <option value='Aceh Jaya'>Aceh Jaya</option>
                                        <option value='Aceh Selatan'>Aceh Selatan</option>
                                        <option value='Aceh Singkil'>Aceh Singkil</option>
                                        <option value='Aceh Tamiang'>Aceh Tamiang</option>
                                        <option value='Aceh Tengah'>Aceh Tengah</option>
                                        <option value='Aceh Tenggara'>Aceh Tenggara</option>
                                        <option value='Aceh Timur'>Aceh Timur</option>
                                        <option value='Aceh Utara'>Aceh Utara</option>
                                        <option value='Agam'>Agam</option>
                                        <option value='Alor'>Alor</option>
                                        <option value='Ambon'>Ambon</option>
                                        <option value='Asahan'>Asahan</option>
                                        <option value='Asmat'>Asmat</option>
                                        <option value='Badung'>Badung</option>
                                        <option value='Balangan'>Balangan</option>
                                        <option value='Balikpapan'>Balikpapan</option>
                                        <option value='Banda Aceh'>Banda Aceh</option>
                                        <option value='Bandar Lampung'>Bandar Lampung</option>
                                        <option value='Bandung'>Bandung</option>
                                        <option value='Bandung Barat'>Bandung Barat</option>
                                        <option value='Banggai'>Banggai</option>
                                        <option value='Banggai Kepulauan'>Banggai Kepulauan</option>
                                        <option value='Banggai Laut'>Banggai Laut</option>
                                        <option value='Bangka'>Bangka</option>
                                        <option value='Bangka Barat'>Bangka Barat</option>
                                        <option value='Bangka Selatan'>Bangka Selatan</option>
                                        <option value='Bangka Tengah'>Bangka Tengah</option>
                                        <option value='Bangkalan'>Bangkalan</option>
                                        <option value='Bangli'>Bangli</option>
                                        <option value='Banjar'>Banjar</option>
                                        <option value='Banjarbaru'>Banjarbaru</option>
                                        <option value='Banjarmasin'>Banjarmasin</option>
                                        <option value='Banjarnegara'>Banjarnegara</option>
                                        <option value='Bantaeng'>Bantaeng</option>
                                        <option value='Bantul'>Bantul</option>
                                        <option value='Banyuasin'>Banyuasin</option>
                                        <option value='Banyumas'>Banyumas</option>
                                        <option value='Banyuwangi'>Banyuwangi</option>
                                        <option value='Barito Kuala'>Barito Kuala</option>
                                        <option value='Barito Selatan'>Barito Selatan</option>
                                        <option value='Barito Timur'>Barito Timur</option>
                                        <option value='Barito Utara'>Barito Utara</option>
                                        <option value='Barru'>Barru</option>
                                        <option value='Batam'>Batam</option>
                                        <option value='Batang'>Batang</option>
                                        <option value='Batang Hari'>Batang Hari</option>
                                        <option value='Batu'>Batu</option>
                                        <option value='Batu Bara'>Batu Bara</option>
                                        <option value='Bau-Bau'>Bau-Bau</option>
                                        <option value='Bekasi'>Bekasi</option>
                                        <option value='Belitung'>Belitung</option>
                                        <option value='Belitung Timur'>Belitung Timur</option>
                                        <option value='Belu'>Belu</option>
                                        <option value='Bener Meriah'>Bener Meriah</option>
                                        <option value='Bengkalis'>Bengkalis</option>
                                        <option value='Bengkayang'>Bengkayang</option>
                                        <option value='Bengkulu'>Bengkulu</option>
                                        <option value='Bengkulu Selatan'>Bengkulu Selatan</option>
                                        <option value='Bengkulu Tengah'>Bengkulu Tengah</option>
                                        <option value='Bengkulu Utara'>Bengkulu Utara</option>
                                        <option value='Berau'>Berau</option>
                                        <option value='Biak Numfor'>Biak Numfor</option>
                                        <option value='Bima'>Bima</option>
                                        <option value='Binjai'>Binjai</option>
                                        <option value='Bintan'>Bintan</option>
                                        <option value='Bireuen'>Bireuen</option>
                                        <option value='Bitung'>Bitung</option>
                                        <option value='Blitar'>Blitar</option>
                                        <option value='Blora'>Blora</option>
                                        <option value='Boalemo'>Boalemo</option>
                                        <option value='Bogor'>Bogor</option>
                                        <option value='Bojonegoro'>Bojonegoro</option>
                                        <option value='Bolaang Mongondow'>Bolaang Mongondow</option>
                                        <option value='Bolaang Mongondow Selatan'>Bolaang Mongondow Selatan</option>
                                        <option value='Bolaang Mongondow Timur'>Bolaang Mongondow Timur</option>
                                        <option value='Bolaang Mongondow Utara'>Bolaang Mongondow Utara</option>
                                        <option value='Bombana'>Bombana</option>
                                        <option value='Bondowoso'>Bondowoso</option>
                                        <option value='Bone'>Bone</option>
                                        <option value='Bone Bolango'>Bone Bolango</option>
                                        <option value='Bontang'>Bontang</option>
                                        <option value='Boven Digoel'>Boven Digoel</option>
                                        <option value='Boyolali'>Boyolali</option>
                                        <option value='Brebes'>Brebes</option>
                                        <option value='Bukittinggi'>Bukittinggi</option>
                                        <option value='Buleleng'>Buleleng</option>
                                        <option value='Bulukumba'>Bulukumba</option>
                                        <option value='Bulungan'>Bulungan</option>
                                        <option value='Bungo'>Bungo</option>
                                        <option value='Buol'>Buol</option>
                                        <option value='Buru'>Buru</option>
                                        <option value='Buru Selatan'>Buru Selatan</option>
                                        <option value='Buton'>Buton</option>
                                        <option value='Buton Selatan'>Buton Selatan</option>
                                        <option value='Buton Tengah'>Buton Tengah</option>
                                        <option value='Buton Utara'>Buton Utara</option>
                                        <option value='Ciamis'>Ciamis</option>
                                        <option value='Cianjur'>Cianjur</option>
                                        <option value='Cilacap'>Cilacap</option>
                                        <option value='Cilegon'>Cilegon</option>
                                        <option value='Cimahi'>Cimahi</option>
                                        <option value='Cirebon'>Cirebon</option>
                                        <option value='Dairi'>Dairi</option>
                                        <option value='Deiyai'>Deiyai</option>
                                        <option value='Deli Serdang'>Deli Serdang</option>
                                        <option value='Demak'>Demak</option>
                                        <option value='Denpasar'>Denpasar</option>
                                        <option value='Depok'>Depok</option>
                                        <option value='Dharmasraya'>Dharmasraya</option>
                                        <option value='Dogiyai'>Dogiyai</option>
                                        <option value='Dompu'>Dompu</option>
                                        <option value='Donggala'>Donggala</option>
                                        <option value='Dumai'>Dumai</option>
                                        <option value='Empat Lawang'>Empat Lawang</option>
                                        <option value='Ende'>Ende</option>
                                        <option value='Ende'>Ende</option>
                                        <option value='Enrekang'>Enrekang</option>
                                        <option value='Fakfak'>Fakfak</option>
                                        <option value='Flores Timur'>Flores Timur</option>
                                        <option value='Flores Timur'>Flores Timur</option>
                                        <option value='Garut'>Garut</option>
                                        <option value='Gayo Lues'>Gayo Lues</option>
                                        <option value='Gianyar'>Gianyar</option>
                                        <option value='Gorontalo'>Gorontalo</option>
                                        <option value='Gorontalo Utara'>Gorontalo Utara</option>
                                        <option value='Gowa'>Gowa</option>
                                        <option value='Gresik'>Gresik</option>
                                        <option value='Grobogan'>Grobogan</option>
                                        <option value='Gunung Kidul'>Gunung Kidul</option>
                                        <option value='Gunung Mas'>Gunung Mas</option>
                                        <option value='Gunungsitoli'>Gunungsitoli</option>
                                        <option value='Halmahera Barat'>Halmahera Barat</option>
                                        <option value='Halmahera Selatan'>Halmahera Selatan</option>
                                        <option value='Halmahera Tengah'>Halmahera Tengah</option>
                                        <option value='Halmahera Timur'>Halmahera Timur</option>
                                        <option value='Halmahera Utara'>Halmahera Utara</option>
                                        <option value='Hulu Sungai Selatan'>Hulu Sungai Selatan</option>
                                        <option value='Hulu Sungai Tengah'>Hulu Sungai Tengah</option>
                                        <option value='Hulu Sungai Utara'>Hulu Sungai Utara</option>
                                        <option value='Humbang Hasundutan'>Humbang Hasundutan</option>
                                        <option value='Indragiri Hilir'>Indragiri Hilir</option>
                                        <option value='Indragiri Hulu'>Indragiri Hulu</option>
                                        <option value='Indramayu'>Indramayu</option>
                                        <option value='Intan Jaya'>Intan Jaya</option>
                                        <option value='Jakarta Barat'>Jakarta Barat</option>
                                        <option value='Jakarta Pusat'>Jakarta Pusat</option>
                                        <option value='Jakarta Selatan'>Jakarta Selatan</option>
                                        <option value='Jakarta Timur'>Jakarta Timur</option>
                                        <option value='Jakarta Utara'>Jakarta Utara</option>
                                        <option value='Jambi'>Jambi</option>
                                        <option value='Jayapura'>Jayapura</option>
                                        <option value='Jayawijaya'>Jayawijaya</option>
                                        <option value='Jember'>Jember</option>
                                        <option value='Jembrana'>Jembrana</option>
                                        <option value='Jeneponto'>Jeneponto</option>
                                        <option value='Jepara'>Jepara</option>
                                        <option value='Jombang'>Jombang</option>
                                        <option value='Kaimana'>Kaimana</option>
                                        <option value='Kampar'>Kampar</option>
                                        <option value='Kapuas'>Kapuas</option>
                                        <option value='Kapuas Hulu'>Kapuas Hulu</option>
                                        <option value='Karanganyar'>Karanganyar</option>
                                        <option value='Karangasem'>Karangasem</option>
                                        <option value='Karawang'>Karawang</option>
                                        <option value='Karimun'>Karimun</option>
                                        <option value='Karo'>Karo</option>
                                        <option value='Katingan'>Katingan</option>
                                        <option value='Kaur'>Kaur</option>
                                        <option value='Kayong Utara'>Kayong Utara</option>
                                        <option value='Kebumen'>Kebumen</option>
                                        <option value='Kediri'>Kediri</option>
                                        <option value='Keerom'>Keerom</option>
                                        <option value='Kendal'>Kendal</option>
                                        <option value='Kendari'>Kendari</option>
                                        <option value='Kepahiang'>Kepahiang</option>
                                        <option value='Kepulauan Anambas'>Kepulauan Anambas</option>
                                        <option value='Kepulauan Aru'>Kepulauan Aru</option>
                                        <option value='Kepulauan Mentawai'>Kepulauan Mentawai</option>
                                        <option value='Kepulauan Meranti'>Kepulauan Meranti</option>
                                        <option value='Kepulauan Sangihe'>Kepulauan Sangihe</option>
                                        <option value='Kepulauan Selayar'>Kepulauan Selayar</option>
                                        <option value='Kepulauan Seribu'>Kepulauan Seribu</option>
                                        <option value='Kepulauan Siau Tagulandang Biaro (Sitaro)'>Kepulauan Siau Tagulandang Biaro (Sitaro)</option>
                                        <option value='Kepulauan Sula'>Kepulauan Sula</option>
                                        <option value='Kepulauan Talaud'>Kepulauan Talaud</option>
                                        <option value='Kepulauan Yapen'>Kepulauan Yapen</option>
                                        <option value='Kerinci'>Kerinci</option>
                                        <option value='Ketapang'>Ketapang</option>
                                        <option value='Klaten'>Klaten</option>
                                        <option value='Klungkung'>Klungkung</option>
                                        <option value='Kolaka'>Kolaka</option>
                                        <option value='Kolaka Timur'>Kolaka Timur</option>
                                        <option value='Kolaka Utara'>Kolaka Utara</option>
                                        <option value='Konawe'>Konawe</option>
                                        <option value='Konawe Kepulauan'>Konawe Kepulauan</option>
                                        <option value='Konawe Selatan'>Konawe Selatan</option>
                                        <option value='Konawe Utara'>Konawe Utara</option>
                                        <option value='Kotabaru'>Kotabaru</option>
                                        <option value='Kotamobagu'>Kotamobagu</option>
                                        <option value='Kotawaringin Barat'>Kotawaringin Barat</option>
                                        <option value='Kotawaringin Timur'>Kotawaringin Timur</option>
                                        <option value='Kuantan Singingi'>Kuantan Singingi</option>
                                        <option value='Kubu Raya'>Kubu Raya</option>
                                        <option value='Kudus'>Kudus</option>
                                        <option value='Kulon Progo'>Kulon Progo</option>
                                        <option value='Kuningan'>Kuningan</option>
                                        <option value='Kupang'>Kupang</option>
                                        <option value='Kutai Barat'>Kutai Barat</option>
                                        <option value='Kutai Kartanegara'>Kutai Kartanegara</option>
                                        <option value='Kutai Timur'>Kutai Timur</option>
                                        <option value='Labuhanbatu'>Labuhanbatu</option>
                                        <option value='Labuhanbatu Selatan'>Labuhanbatu Selatan</option>
                                        <option value='Labuhanbatu Utara'>Labuhanbatu Utara</option>
                                        <option value='Lahat'>Lahat</option>
                                        <option value='Lamandau'>Lamandau</option>
                                        <option value='Lamongan'>Lamongan</option>
                                        <option value='Lampung Barat'>Lampung Barat</option>
                                        <option value='Lampung Selatan'>Lampung Selatan</option>
                                        <option value='Lampung Tengah'>Lampung Tengah</option>
                                        <option value='Lampung Timur'>Lampung Timur</option>
                                        <option value='Lampung Utara'>Lampung Utara</option>
                                        <option value='Landak'>Landak</option>
                                        <option value='Langkat'>Langkat</option>
                                        <option value='Lanny Jaya'>Lanny Jaya</option>
                                        <option value='Lebak'>Lebak</option>
                                        <option value='Lebong'>Lebong</option>
                                        <option value='Lembata'>Lembata</option>
                                        <option value='Lhokseumawe'>Lhokseumawe</option>
                                        <option value='Lima Puluh Kota'>Lima Puluh Kota</option>
                                        <option value='Lingga'>Lingga</option>
                                        <option value='Lombok Barat'>Lombok Barat</option>
                                        <option value='Lombok Tengah'>Lombok Tengah</option>
                                        <option value='Lombok Timur'>Lombok Timur</option>
                                        <option value='Lombok Utara'>Lombok Utara</option>
                                        <option value='Lubuk Linggau'>Lubuk Linggau</option>
                                        <option value='Lumajang'>Lumajang</option>
                                        <option value='Luwu'>Luwu</option>
                                        <option value='Luwu Timur'>Luwu Timur</option>
                                        <option value='Luwu Utara'>Luwu Utara</option>
                                        <option value='Madiun'>Madiun</option>
                                        <option value='Magelang'>Magelang</option>
                                        <option value='Magetan'>Magetan</option>
                                        <option value='Mahakam Ulu'>Mahakam Ulu</option>
                                        <option value='Majalengka'>Majalengka</option>
                                        <option value='Majene'>Majene</option>
                                        <option value='Makassar'>Makassar</option>
                                        <option value='Malaka'>Malaka</option>
                                        <option value='Malang'>Malang</option>
                                        <option value='Malinau'>Malinau</option>
                                        <option value='Maluku Barat Daya'>Maluku Barat Daya</option>
                                        <option value='Maluku Tengah'>Maluku Tengah</option>
                                        <option value='Maluku Tenggara'>Maluku Tenggara</option>
                                        <option value='Maluku Tenggara Barat'>Maluku Tenggara Barat</option>
                                        <option value='Mamasa'>Mamasa</option>
                                        <option value='Mamberamo Raya'>Mamberamo Raya</option>
                                        <option value='Mamberamo Tengah'>Mamberamo Tengah</option>
                                        <option value='Mamuju'>Mamuju</option>
                                        <option value='Mamuju Tengah'>Mamuju Tengah</option>
                                        <option value='Mamuju Utara'>Mamuju Utara</option>
                                        <option value='Manado'>Manado</option>
                                        <option value='Mandailing Natal'>Mandailing Natal</option>
                                        <option value='Manggarai'>Manggarai</option>
                                        <option value='Manggarai Barat'>Manggarai Barat</option>
                                        <option value='Manggarai Timur'>Manggarai Timur</option>
                                        <option value='Manokwari'>Manokwari</option>
                                        <option value='Manokwari Selatan'>Manokwari Selatan</option>
                                        <option value='Mappi'>Mappi</option>
                                        <option value='Maros'>Maros</option>
                                        <option value='Mataram'>Mataram</option>
                                        <option value='Maybrat'>Maybrat</option>
                                        <option value='Medan'>Medan</option>
                                        <option value='Melawi'>Melawi</option>
                                        <option value='Mempawah'>Mempawah</option>
                                        <option value='Merangin'>Merangin</option>
                                        <option value='Merauke'>Merauke</option>
                                        <option value='Mesuji'>Mesuji</option>
                                        <option value='Metro'>Metro</option>
                                        <option value='Mimika'>Mimika</option>
                                        <option value='Minahasa'>Minahasa</option>
                                        <option value='Minahasa Selatan'>Minahasa Selatan</option>
                                        <option value='Minahasa Tenggara'>Minahasa Tenggara</option>
                                        <option value='Minahasa Utara'>Minahasa Utara</option>
                                        <option value='Mojokerto'>Mojokerto</option>
                                        <option value='Morowali'>Morowali</option>
                                        <option value='Morowali Utara'>Morowali Utara</option>
                                        <option value='Muara Enim'>Muara Enim</option>
                                        <option value='Muaro Jambi'>Muaro Jambi</option>
                                        <option value='Muko Muko'>Muko Muko</option>
                                        <option value='Muna'>Muna</option>
                                        <option value='Muna Barat'>Muna Barat</option>
                                        <option value='Murung Raya'>Murung Raya</option>
                                        <option value='Musi Banyuasin'>Musi Banyuasin</option>
                                        <option value='Musi Rawas'>Musi Rawas</option>
                                        <option value='Musi Rawas Utara'>Musi Rawas Utara</option>
                                        <option value='Nabire'>Nabire</option>
                                        <option value='Nagan Raya'>Nagan Raya</option>
                                        <option value='Nagekeo'>Nagekeo</option>
                                        <option value='Natuna'>Natuna</option>
                                        <option value='Nduga'>Nduga</option>
                                        <option value='Ngada'>Ngada</option>
                                        <option value='Nganjuk'>Nganjuk</option>
                                        <option value='Ngawi'>Ngawi</option>
                                        <option value='Nias'>Nias</option>
                                        <option value='Nias Barat'>Nias Barat</option>
                                        <option value='Nias Selatan'>Nias Selatan</option>
                                        <option value='Nias Utara'>Nias Utara</option>
                                        <option value='Nunukan'>Nunukan</option>
                                        <option value='Ogan Ilir'>Ogan Ilir</option>
                                        <option value='Ogan Komering Ilir'>Ogan Komering Ilir</option>
                                        <option value='Ogan Komering Ulu'>Ogan Komering Ulu</option>
                                        <option value='Ogan Komering Ulu Selatan'>Ogan Komering Ulu Selatan</option>
                                        <option value='Ogan Komering Ulu Timur'>Ogan Komering Ulu Timur</option>
                                        <option value='Pacitan'>Pacitan</option>
                                        <option value='Padang'>Padang</option>
                                        <option value='Padang Lawas'>Padang Lawas</option>
                                        <option value='Padang Lawas Utara'>Padang Lawas Utara</option>
                                        <option value='Padang Panjang'>Padang Panjang</option>
                                        <option value='Padang Pariaman'>Padang Pariaman</option>
                                        <option value='Padang Sidempuan'>Padang Sidempuan</option>
                                        <option value='Pagar Alam'>Pagar Alam</option>
                                        <option value='Pakpak Bharat'>Pakpak Bharat</option>
                                        <option value='Palangka Raya'>Palangka Raya</option>
                                        <option value='Palembang'>Palembang</option>
                                        <option value='Palopo'>Palopo</option>
                                        <option value='Palu'>Palu</option>
                                        <option value='Pamekasan'>Pamekasan</option>
                                        <option value='Pandeglang'>Pandeglang</option>
                                        <option value='Pangandaran'>Pangandaran</option>
                                        <option value='Pangkajene Kepulauan'>Pangkajene Kepulauan</option>
                                        <option value='Pangkal Pinang'>Pangkal Pinang</option>
                                        <option value='Paniai'>Paniai</option>
                                        <option value='Parepare'>Parepare</option>
                                        <option value='Pariaman'>Pariaman</option>
                                        <option value='Parigi Moutong'>Parigi Moutong</option>
                                        <option value='Pasaman'>Pasaman</option>
                                        <option value='Pasaman Barat'>Pasaman Barat</option>
                                        <option value='Paser'>Paser</option>
                                        <option value='Pasuruan'>Pasuruan</option>
                                        <option value='Pati'>Pati</option>
                                        <option value='Payakumbuh'>Payakumbuh</option>
                                        <option value='Pegunungan Arfak'>Pegunungan Arfak</option>
                                        <option value='Pegunungan Bintang'>Pegunungan Bintang</option>
                                        <option value='Pekalongan'>Pekalongan</option>
                                        <option value='Pekanbaru'>Pekanbaru</option>
                                        <option value='Pelalawan'>Pelalawan</option>
                                        <option value='Pemalang'>Pemalang</option>
                                        <option value='Pematang Siantar'>Pematang Siantar</option>
                                        <option value='Penajam Paser Utara'>Penajam Paser Utara</option>
                                        <option value='Penukal Abab Lematang Ilir'>Penukal Abab Lematang Ilir</option>
                                        <option value='Pesawaran'>Pesawaran</option>
                                        <option value='Pesisir Barat'>Pesisir Barat</option>
                                        <option value='Pesisir Selatan'>Pesisir Selatan</option>
                                        <option value='Pidie'>Pidie</option>
                                        <option value='Pidie Jaya'>Pidie Jaya</option>
                                        <option value='Pinrang'>Pinrang</option>
                                        <option value='Pohuwato'>Pohuwato</option>
                                        <option value='Polewali Mandar'>Polewali Mandar</option>
                                        <option value='Ponorogo'>Ponorogo</option>
                                        <option value='Pontianak'>Pontianak</option>
                                        <option value='Poso'>Poso</option>
                                        <option value='Prabumulih'>Prabumulih</option>
                                        <option value='Pringsewu'>Pringsewu</option>
                                        <option value='Probolinggo'>Probolinggo</option>
                                        <option value='Pulang Pisau'>Pulang Pisau</option>
                                        <option value='Pulau Morotai'>Pulau Morotai</option>
                                        <option value='Pulau Taliabu'>Pulau Taliabu</option>
                                        <option value='Puncak'>Puncak</option>
                                        <option value='Puncak Jaya'>Puncak Jaya</option>
                                        <option value='Purbalingga'>Purbalingga</option>
                                        <option value='Purwakarta'>Purwakarta</option>
                                        <option value='Purworejo'>Purworejo</option>
                                        <option value='Raja Ampat'>Raja Ampat</option>
                                        <option value='Rejang Lebong'>Rejang Lebong</option>
                                        <option value='Rembang'>Rembang</option>
                                        <option value='Rokan Hilir'>Rokan Hilir</option>
                                        <option value='Rokan Hulu'>Rokan Hulu</option>
                                        <option value='Rote Ndao'>Rote Ndao</option>
                                        <option value='Sabang'>Sabang</option>
                                        <option value='Sabu Raijua'>Sabu Raijua</option>
                                        <option value='Salatiga'>Salatiga</option>
                                        <option value='Samarinda'>Samarinda</option>
                                        <option value='Sambas'>Sambas</option>
                                        <option value='Samosir'>Samosir</option>
                                        <option value='Sampang'>Sampang</option>
                                        <option value='Sanggau'>Sanggau</option>
                                        <option value='Sarmi'>Sarmi</option>
                                        <option value='Sarolangun'>Sarolangun</option>
                                        <option value='Sawah Lunto'>Sawah Lunto</option>
                                        <option value='Sekadau'>Sekadau</option>
                                        <option value='Seluma'>Seluma</option>
                                        <option value='Semarang'>Semarang</option>
                                        <option value='Seram Bagian Barat'>Seram Bagian Barat</option>
                                        <option value='Seram Bagian Timur'>Seram Bagian Timur</option>
                                        <option value='Serang'>Serang</option>
                                        <option value='Serdang Bedagai'>Serdang Bedagai</option>
                                        <option value='Seruyan'>Seruyan</option>
                                        <option value='Siak'>Siak</option>
                                        <option value='Sibolga'>Sibolga</option>
                                        <option value='Sidenreng Rappang'>Sidenreng Rappang</option>
                                        <option value='Sidoarjo'>Sidoarjo</option>
                                        <option value='Sigi'>Sigi</option>
                                        <option value='Sijunjung'>Sijunjung</option>
                                        <option value='Sikka'>Sikka</option>
                                        <option value='Simalungun'>Simalungun</option>
                                        <option value='Simeulue'>Simeulue</option>
                                        <option value='Singkawang'>Singkawang</option>
                                        <option value='Sinjai'>Sinjai</option>
                                        <option value='Sintang'>Sintang</option>
                                        <option value='Situbondo'>Situbondo</option>
                                        <option value='Sleman'>Sleman</option>
                                        <option value='Solok'>Solok</option>
                                        <option value='Solok Selatan'>Solok Selatan</option>
                                        <option value='Soppeng'>Soppeng</option>
                                        <option value='Sorong'>Sorong</option>
                                        <option value='Sorong Selatan'>Sorong Selatan</option>
                                        <option value='Sragen'>Sragen</option>
                                        <option value='Subang'>Subang</option>
                                        <option value='Subulussalam'>Subulussalam</option>
                                        <option value='Sukabumi'>Sukabumi</option>
                                        <option value='Sukamara'>Sukamara</option>
                                        <option value='Sukoharjo'>Sukoharjo</option>
                                        <option value='Sumba Barat'>Sumba Barat</option>
                                        <option value='Sumba Barat Daya'>Sumba Barat Daya</option>
                                        <option value='Sumba Tengah'>Sumba Tengah</option>
                                        <option value='Sumba Timur'>Sumba Timur</option>
                                        <option value='Sumbawa'>Sumbawa</option>
                                        <option value='Sumbawa Barat'>Sumbawa Barat</option>
                                        <option value='Sumedang'>Sumedang</option>
                                        <option value='Sumenep'>Sumenep</option>
                                        <option value='Sungaipenuh'>Sungaipenuh</option>
                                        <option value='Supiori'>Supiori</option>
                                        <option value='Surabaya'>Surabaya</option>
                                        <option value='Surakarta'>Surakarta</option>
                                        <option value='Tabalong'>Tabalong</option>
                                        <option value='Tabanan'>Tabanan</option>
                                        <option value='Takalar'>Takalar</option>
                                        <option value='Tambrauw'>Tambrauw</option>
                                        <option value='Tana Tidung'>Tana Tidung</option>
                                        <option value='Tana Toraja'>Tana Toraja</option>
                                        <option value='Tanah Bumbu'>Tanah Bumbu</option>
                                        <option value='Tanah Datar'>Tanah Datar</option>
                                        <option value='Tanah Laut'>Tanah Laut</option>
                                        <option value='Tangerang'>Tangerang</option>
                                        <option value='Tangerang Selatan'>Tangerang Selatan</option>
                                        <option value='Tanggamus'>Tanggamus</option>
                                        <option value='Tanjung Balai'>Tanjung Balai</option>
                                        <option value='Tanjung Jabung Barat'>Tanjung Jabung Barat</option>
                                        <option value='Tanjung Jabung Timur'>Tanjung Jabung Timur</option>
                                        <option value='Tanjung Pinang'>Tanjung Pinang</option>
                                        <option value='Tapanuli Selatan'>Tapanuli Selatan</option>
                                        <option value='Tapanuli Tengah'>Tapanuli Tengah</option>
                                        <option value='Tapanuli Utara'>Tapanuli Utara</option>
                                        <option value='Tapin'>Tapin</option>
                                        <option value='Tarakan'>Tarakan</option>
                                        <option value='Tasikmalaya'>Tasikmalaya</option>
                                        <option value='Tebing Tinggi'>Tebing Tinggi</option>
                                        <option value='Tebo'>Tebo</option>
                                        <option value='Tegal'>Tegal</option>
                                        <option value='Teluk Bintuni'>Teluk Bintuni</option>
                                        <option value='Teluk Wondama'>Teluk Wondama</option>
                                        <option value='Temanggung'>Temanggung</option>
                                        <option value='Ternate'>Ternate</option>
                                        <option value='Tidore Kepulauan'>Tidore Kepulauan</option>
                                        <option value='Timor Tengah Selatan'>Timor Tengah Selatan</option>
                                        <option value='Timor Tengah Utara'>Timor Tengah Utara</option>
                                        <option value='Toba Samosir'>Toba Samosir</option>
                                        <option value='Tojo Una-Una'>Tojo Una-Una</option>
                                        <option value='Tolikara'>Tolikara</option>
                                        <option value='Toli-Toli'>Toli-Toli</option>
                                        <option value='Tomohon'>Tomohon</option>
                                        <option value='Toraja Utara'>Toraja Utara</option>
                                        <option value='Trenggalek'>Trenggalek</option>
                                        <option value='Tual'>Tual</option>
                                        <option value='Tuban'>Tuban</option>
                                        <option value='Tulang Bawang'>Tulang Bawang</option>
                                        <option value='Tulang Bawang Barat'>Tulang Bawang Barat</option>
                                        <option value='Tulungagung'>Tulungagung</option>
                                        <option value='Wajo'>Wajo</option>
                                        <option value='Wakatobi'>Wakatobi</option>
                                        <option value='Waropen'>Waropen</option>
                                        <option value='Way Kanan'>Way Kanan</option>
                                        <option value='Wonogiri'>Wonogiri</option>
                                        <option value='Wonosobo'>Wonosobo</option>
                                        <option value='Yahukimo'>Yahukimo</option>
                                        <option value='Yalimo'>Yalimo</option>
                                        <option value='Yogyakarta'>Yogyakarta</option>
                                        <option value='Selangor'>Selangor</option>
                                    </select> -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="input-group col-md-12">
                                    <div class="input-group-prepend" style="align-items:unset;">
                                        <span class="input-group-text">
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="ex: 243551156"></i>
                                        </span>
                                    </div>
                                    <select id="phone" class="form-control" name="phone[]" multiple>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="input-group col-md-8">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="ex: ALAMSYAH"></i>
                                        </span>
                                    </div>
                                    <select id="sales" class="form-control" name="sales" aria-describedby="sales-error">
                                        <option value=""></option>
                                        @foreach($sales as $sales_list)
                                        <option value="{{$sales_list->id}}">{{$sales_list->name}}</option>
                                        @endforeach
                                    </select>
                                    <em id="sales-error" class="error invalid-feedback"></em>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="input-group col-md-12">
                                    <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks (optional)">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="ex: 'Sales : Alamsyah'"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Company Information -->

                <!-- Billing Information -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Billing
                            <small>Management </small>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="input-group col-md-12">
                                    <input type="text" class="form-control" id="billingAddress" name="billingAddress" placeholder="Billing Address" aria-describedby="billingAddress-error">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="ex: Jl. Kampung Duri Raya No. 5-A, Kelurahan Duri Selatan, Tambora, Jakarta Barat"></i>
                                        </span>
                                    </div>
                                    <em id="billingAddress-error" class="error invalid-feedback"></em>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="input-group col-md-12">
                                    <div class="input-group-prepend" style="align-items:unset;">
                                        <span class="input-group-text">
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="ex: Jl. Werkudoro No. 161, Tegal"></i>
                                        </span>
                                    </div>
                                    <select id="shippingAddress" class="form-control" name="shippingAddress[]" multiple aria-describedby="shippingAddress-error">
                                        <option value=""></option>
                                    </select>
                                    <em id="shippingAddress-error" class="error invalid-feedback"></em>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Company Information -->

                <!-- Division Information -->
                <!-- <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Division
                            <small>Management </small>
                        </div>
                        <div class="card-body">
                            <div class="division-list"></div>
                            <div class="row">
                                <div class=col-md-12>
                                    <button type="button" class="btn btn-primary pull-right" onclick="addDivision()">
                                        <i class="fa fa-plus"></i>&nbsp; Add Division
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- End Division Information -->

                <!-- Form Button Information -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i>&nbsp; Save
                            </button>
                            <a class="btn btn-secondary" href="{{route('master-client.index')}}"    >
                                <i class="fa fa-remove"></i>&nbsp; Cancel
                            </a>
                        </div>
                    </div>
                </div>
                <!-- End Form Button Information -->
            </div>
        </form>
    </div>
</div>
<div class="fade" style="display:none;">
    <div class="row div-items">
        <input type="hidden" class="arrDiv" name="arrDiv[]">
        <div class="col-md-4">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control div-name" id="divisiName" name="divisiName" placeholder="Divisi Name" aria-describedby="divisiName-error">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="ex: Product BP"></i>
                        </span>
                    </div>
                    <em id="divisiName-error" class="error invalid-feedback div-em-name"></em>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="ex: BP"></i>
                        </span>
                    </div>
                    <select id="divisiType" class="form-control div-type" name="divisiType" aria-describedby="divisiType-error">
                        <option value=""></option>
                    </select>
                </div>
                <em id="divisiType-error" class="error invalid-feedback div-em-type"></em>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group row">
                <div class="input-group col-md-10">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="ex: ALAMSYAH"></i>
                        </span>
                    </div>
                    <select id="divisiSales" class="form-control div-sales" name="divisiSales" aria-describedby="divisiSales-error">
                        <option value=""></option>
                        @foreach($sales as $sales_list)
                        <option value="{{$sales_list->id}}">{{$sales_list->name}}</option>
                        @endforeach
                    </select>
                    <em id="divisiSales-error" class="error invalid-feedback div-em-sales"></em>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger" onclick="$(this).closest('.div-items').remove();">
                        <i class="fa fa-remove"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection @section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
<script>
    $('.province').select2({
        theme: "bootstrap",
        placeholder: 'Location'
    }).change(function () {
        $(this).valid();
    });

    $('.city').select2({
        theme: "bootstrap",
        placeholder: 'Location'
    }).change(function () {
        $(this).valid();
    });
    $(document).ready(function() {
    $('select[name="provinsi"]').on('change', function() {
        var element = $(this).find('option:selected');
        var provinceID = element.attr('data-prov');
        /*console.log(provinceID);*/
            if(provinceID) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                url: '{{ route("master-client.index") }}/get-city-list/'+ provinceID,
                type: "POST",
                dataType: "json",
                data: {},
                success:function(data) {
                $('select[name="kota"]').empty();
                $.each(data, function(key, value) {
                    /*console.log(value);*/
                    $('select[name="kota"]').append('<option value="'+ (value['city_name']) +'">'+ (value['type']) + '  ' +(value['city_name']) +'</option>');
                    });
                }
            });
            }else{
            $('select[name="kota"]').empty();
              }
           });
        });

    var count = 0;
    var arrDiv = [];

    $('#title').select2({
        theme: "bootstrap",
        placeholder: 'Title',
        tags: true
    }).change(function () {
        $(this).valid();
    });

    $('#mobile').select2({
        theme: "bootstrap",
        placeholder: 'Mobile number',
        tags: true
    }).change(function () {
        $(this).valid();
    });

    $('#segmenPasar').select2({
        theme: "bootstrap",
        placeholder: 'Segmen Pasar (optional)',
        tags: true
    });
    $('#phone').select2({
        theme: "bootstrap",
        placeholder: 'Phone number (optional)',
        tags: true
    });
    $('#negara').select2({
        theme: "bootstrap",
        placeholder: 'Negara (optional)',
        tags: true
    });
    $('#provinsi').select2({
        theme: "bootstrap",
        placeholder: 'Provinsi (optional)',
        tags: true
    });
    $('#kota').select2({
        theme: "bootstrap",
        placeholder: 'Kota (optional)',
        tags: true
    });
    $('#sales').select2({
        theme: "bootstrap",
        placeholder: 'Sales'
    }).change(function () {
        $(this).valid();
    });

    $('#shippingAddress').select2({
        theme: "bootstrap",
        placeholder: 'Shipping Address',
        tags: true
    }).change(function(){
        $(this).valid();
        $(this).parent('.input-group').find('.select2-selection').css('height', '80px');
    });
    $('#shippingAddress').parent('.input-group').find('.select2-selection').css('height', '80px');

    //validation
    $('#jxForm').validate({
        rules: {
            displayName: {
                required: true
            },
            limit: {
                required: true
            },
            fullname: {
                required: true
            },
            title: {
                required: true
            },
            email: {
                email: true
            },
            "mobile[]": {
                required: true
            },
            sales: {
                required: true
            },
            billingAddress: {
                required: true
            },
            "shippingAddress[]": {
                required: true
            },
        },
        messages: {
            displayName: {
                required: 'Please enter display name'
            },
            limit: {
                required: 'Please enter limit'
            },
            fullname: {
                required: 'Please enter fullname'
            },
            title: {
                required: 'Please select title'
            },
            email: {
                email: 'Please input valid email'
            },
            "mobile[]": {
                required: 'Please input mobile number'
            },
            sales: {
                required: 'Please select sales'
            },
            billingAddress: {
                required: 'Please enter billing address'
            },
            "shippingAddress[]": {
                required: 'Please input 1 shipping address'
            },
        },
        errorElement: 'em',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
            $(element).parent('.input-group').find('.select2-selection').attr('style',
                'border-color:#f86c6b');
            if($(element).attr('id')=='shippingAddress'){
                $(element).parent('.input-group').find('.select2-selection').css('height', '80px');
            }
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass('is-valid').removeClass('is-invalid');

            $(element).parent('.input-group').find('.select2-selection').attr('style',
                'border-color:#4dbd74');
        }
    });

    function addDivision() {
        count++;
        //set array divisi
        $('.fade').find('.arrDiv').val(count);
        //set divisi name
        $('.fade').find('.div-name').attr('id', 'divisiName' + count).attr('name', 'divisiName' + count).attr(
            'aria-describedby', 'divisiName' + count + '-error');
        $('.fade').find('.div-em-name').attr('id', 'divisiName' + count + '-error');
        //set divisi type
        $('.fade').find('.div-type').attr('id', 'divisiType' + count).attr('name', 'divisiType' + count).attr(
            'aria-describedby', 'divisiType' + count + '-error');
        $('.fade').find('.div-em-type').attr('id', 'divisiType' + count + '-error');
        //set divisi sales
        $('.fade').find('.div-sales').attr('id', 'divisiSales' + count).attr('name', 'divisiSales' + count).attr(
            'aria-describedby', 'divisiSales' + count + '-error');
        $('.fade').find('.div-em-sales').attr('id', 'divisiSales' + count + '-error');

        $('.division-list').append($('.fade').html());

        //set select2 divisi type
        $('#divisiType' + count).select2({
            theme: "bootstrap",
            placeholder: 'Divisi type',
            tags: true
        }).change(function () {
            $(this).valid();
        });

        //set select2 divisi sales
        $('#divisiSales' + count).select2({
            theme: "bootstrap",
            placeholder: 'Sales',
        }).change(function () {
            $(this).valid();
        });

        //validate divisi name
        $('#divisiName' + count).rules("add", {
            required: true,
            messages: {
                required: "Please input divisi name"
            }
        });
        //validate divisi sales
        $('#divisiSales' + count).rules("add", {
            required: true,
            messages: {
                required: "Please input sales for divisi"
            }
        });

        //validate divisi type
        $('#divisiType' + count).rules("add", {
            required: true,
            messages: {
                required: "Please input divisi type"
            }
        });
    }
</script>
@endsection