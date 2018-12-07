# rajaongkir API For Laravel 5

API ini digunakan untuk type akun starter,basic dan pro

**Instalasi**

Download package dengan composer
```
composer require erfanbagussetiana/rajaongkirpro
```
atau
```
{
	"require": {
		"erfanbagussetiana/rajaongkirpro" : "dev-master"
	}
}
```

Tambahkan service provider ke config/app.php
```php
'providers' => [
	....
	
	erfanbagussetiana\rajaongkirpro\RajaOngkirServiceProvider::class,
]
```

Tambahkan juga aliasnya ke config/app.php
```php
'aliases' => [
	....
	
	'RajaOngkir' => erfanbagussetiana\rajaongkirpro\RajaOngkirFacade::class,
]
```

Buat file rajaongkir.php di folder config secara manual atau jalankan command artisan
```
php artisan vendor:publish
```
jika anda menggunakan command artisan diatas, anda akan dibuatkan file rajaongkir.php di folder config

Tambahkan kode berikut di file .env untuk konfigurasi API rajaongkir
```
RAJAONGKIR_ENDPOINTAPI=isi_base_url_api_akun_anda_disini
RAJAONGKIR_APIKEY=isi_api_key_anda_disini
```
atau anda juga dapat langsung melakukan konfigurasi di file rajaongkir.php di folder config seperti kode berikut.
```php
'end_point_api' => 'isi_base_url_api_akun_anda_disini',
'api_key' => 'isi_api_key_anda_disini',
```

**Penggunaan**

Ambil data provinsi
```php
$data = RajaOngkir::Provinsi()->all();
```

Ambil jumlah provinsi
```php
$data = RajaOngkir::Provinsi()->count();
```

Ambil data provinsi berdasarkan id provinsi
```php
$data = RajaOngkir::Provinsi()->find($id);
```

Ambil data provinsi berdasarkan nama provinsi
```php
$data = RajaOngkir::Provinsi()->search('province', $name = "ja")->get();
```

Ambil data kota
```php
$data = RajaOngkir::Kota()->all();
```

Ambil jumlah kota
```php
$data = RajaOngkir::Kota()->count();
```

Ambil data kota berdasarkan id kota
```php
$data = RajaOngkir::Kota()->find($id);
```

Ambil data kota berdasarkan nama kota
```php
$data = RajaOngkir::Kota()->search('city_name', $name = "banyu")->get();
```

Ambil data kota berdasarkan provinsi
```php
$data = RajaOngkir::Kota()->byProvinsi($provinsi_id)->get();
```

Ambil jumlah kota berdasarkan provinsi
```php
$data = RajaOngkir::Kota()->byProvinsi($provinsi_id)->count();
```

Ambil data kota berdasarkan nama kota di suatu provinsi
```php
$data = RajaOngkir::Kota()->byProvinsi($provinsi_id)->search('city_name', $name)->get();
```


Ambil data Kecamatan
```php
$data = RajaOngkir::Kecamatan()->byKota($city_id)->get();
```

Ambil jumlah Kecamatan
```php
$data = RajaOngkir::Kecamatan()->byKota($city_id)->count();
```

Ambil data Kecamatan berdasarkan id Kecamatan
```php
$data = RajaOngkir::Kecamatan()->find($subdistrict_id);
```

Ambil data Kecamatan berdasarkan nama Kecamatan di suatu kota
```php
$data = RajaOngkir::Kecamatan()->byKota($city_id)->search('subdistrict_name', $name)->get();
```

Ambil Biaya Pengiriman
```php
$data = RajaOngkir::Cost([
	'origin' 		=> 501, // id kota asal
	'destination' 	=> 114, // id kota tujuan
	'weight' 		=> 1700, // berat satuan gram
	'courier' 		=> 'jne', // kode kurir pengantar ( jne / tiki / pos )
])->get();
```


Kunjungi [rajaongkir](http://rajaongkir.com/)

Documentasi akun [starter](http://rajaongkir.com/dokumentasi/starter)<br>
Documentasi akun [basic](https://rajaongkir.com/dokumentasi/basic)<br>
Documentasi akun [pro](https://rajaongkir.com/dokumentasi/pro)
