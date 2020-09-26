<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function __construct()
	{
		helper(['url', 'date']);
	}
	public function index()
	{

		$data['pageTitle'] = 'CI-4 | Home';

		return view('home/index', $data);
	}

	//--------------------------------------------------------------------

}
