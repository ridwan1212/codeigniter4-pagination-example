<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    // your table
    protected $table = 'blog_article';
    // primary key
    protected $primaryKey = 'id';
    // table fields
    protected $allowedFields = ['author', 'title', 'slug', 'description', 'status', 'date_create', 'publish_date', 'content', 'last_update', 'preview_image'];

    // get table item
    public function getList()
    {
        return $this->orderBy('date_create', 'DESC')->findAll();
    }

    public function createNew()
    {
        $this->insert($_POST);
    }

    public function getForEdit($id)
    {
        return $this->find($id);
    }
}
