<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

//use Tiket API Controller
use App\Http\Controllers\TiketAPI\APIController as API;


class Reservasi extends Controller {

	public function flight()
	{
		//add airport data
		$s['airport'] = \App\Airport::all();
		//view reservasi/flight.blade.php with data
		return view('reservasi.flight')->with($s);
	}

	public function searchflight()
	{
		//inisiasi data parameter
		$data = [];
		$data['d'] = Input::get('from');
		$data['a'] = Input::get('to');
		//format date diubah ke YYYY-MM-DD
		$data['date'] = date_format(
							date_create(
								Input::get('depart_date')
							),"Y-m-d");

		if(Input::get('type')=="RT"){
			//format date diubah ke YYYY-MM-DD
			$data['ret_date'] = date_format(
									date_create(
										Input::get('return_date')
									),"Y-m-d");
		}
		$data['adult'] = Input::get('adult');
		$data['child'] = Input::get('child');
		$data['infant'] = Input::get('infant');
		$data['v'] = 1;

		//kosongkan session token untuk transaksi
		\Session::put('token','');
		//panggil class API
		$newapi = new API;

		//simpan data ke log
		$log = new \App\Logtrx;
		$log->request = json_encode($data);
		$log->token = session('token');
		$log->save();

		//simpan data ke search data
		$sd = new \App\Searchdata;
		$sd->depart_city = Input::get('from');
		$sd->arrive_city = Input::get('to');
		//ambil dari array data
		$sd->depart_date = $data['date'];
		if(Input::get('type')=="RT"){
			//ambil dari array data
			$sd->return_date = $data['ret_date'];
		}
		$sd->adult = Input::get('adult');
		$sd->child = Input::get('child');
		$sd->infant = Input::get('infant');
		$sd->ver = $data['v'];
		$sd->token = session('token');
		$sd->save();

		//panggil curl ke search/flight dengan 
		//parameter $data
		$hasil = $newapi->getCurl('search/flight',$data);

		//tampilkan hasil curl diubah ke json
		echo json_encode($hasil);

		//simpan hasil ke table searchdata
		$sd->result = json_encode($hasil);
		$sd->save();

		//simpan hasil ke tabel log
		$log->response = json_encode($hasil);
		$log->status_code = $hasil->diagnostic->status;
		$log->save();
	}
}
