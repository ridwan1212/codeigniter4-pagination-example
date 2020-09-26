<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model
{
    // your table
    protected $table = 'blog_article';
    // primary key
    protected $primaryKey = 'id';
    // table fields
    protected $allowedFields = ['author', 'title', 'description', 'status', 'date_create', 'publish_date', 'content', 'last_update'];

    // get table item
    public function getPost()
    {
        return $this->orderBy('date_create', 'DESC')->where(['status' => 1])->findAll();
    }
}
