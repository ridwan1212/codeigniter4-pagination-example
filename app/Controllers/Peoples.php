<?php

namespace App\Controllers;

use App\Models\PeoplesModel;

class Peoples extends BaseController
{
  public function index()
  {
    $peoples = new peoplesModel();

    $data['pageTitle'] = 'CI-4 | Peoples';

    $data['currentPage'] = $this->request->getVar('page_peoples') ? $this->request->getVar('page_peoples') : 1;

    // load table
    $data['table'] = $peoples->paginate(6, 'peoples');
    $data['pager'] = $peoples->pager;

    // load view
    return view('peoples/index', $data);
  }
}
