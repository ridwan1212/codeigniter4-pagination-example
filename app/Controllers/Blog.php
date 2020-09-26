<?php

namespace App\Controllers;

use App\Models\BlogModel;

class Blog extends BaseController
{
    public function index() {
        $blog = new BlogModel();

        $data['pageTitle'] = 'Blog';
        $data['post'] = $blog->getPost();

        echo view('blog/index', $data);

    }

}