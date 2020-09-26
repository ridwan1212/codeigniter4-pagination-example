<?php

namespace App\Controllers;

use App\Models\ArticleModel;

class Article extends BaseController
{
    public function __construct()
    {
        helper(['form', 'date']);
    }

    public function index()
    {
        $article = new articleModel();

        $data['pageTitle'] = 'CI-4 | Article';

        // load table
        $data['table'] = $article->getList();

        // load view
        return view('article/index', $data);
    }

    public function newPost()
    {

        // session();

        $data = [
            'pageTitle' => 'Create a New Post',
            'validation' => \Config\Services::validation()
        ];


        return view('article/newpost', $data);
    }

    public function create()
    {
        // load model
        $article = new ArticleModel();

        // validation

        if (!$this->validate([
            'author' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please input the author name. The author name is required!'
                ]
            ],
            'title' => 'required|min_length[8]|is_unique[blog_article.title]',
            'description' => 'required|min_length[100]',
            'preview_image' => [
                'rules' => 'uploaded[preview_image]|max_size[preview_image,1024]|mime_in[preview_image,image/jpg,image/jpeg,image/svg,image/webp,image/png]|is_image[preview_image]',
                'errors' => [
                    'uploaded' => 'Preview image is required! Please choose an image first!',
                    'max_size' => 'The size of this image is too large. The image must have less than 1MB size',
                    'mime_in' => 'Your upload does not have a valid image format',
                    'is_image' => 'Your file is not allowed! Please use an image!'
                ]
            ],
            'content' => 'required'
        ])) {

            return redirect()->to('/article/newpost')->withInput();
        }

        // get image
        $previewImage = $this->request->getFile('preview_image');
        // name
        $imageName = $previewImage->getRandomName();
        // moving
        $previewImage->move('assets/img', $imageName);

        $slug = url_title($this->request->getPost('title'), '-', true);
        $article->save([
            'author' => $this->request->getPost('author'),
            'title' => $this->request->getPost('title'),
            'slug' => $slug,
            'description' => $this->request->getPost('description'),
            'date_create' => $this->request->getPost('date_create'),
            'preview_image' => $imageName,
            'content' => $this->request->getPost('content')
        ]);

        return $this->response->redirect(site_url('article'));
    }

    public function edit($id)
    {
        $article = new articleModel();

        $data = [
            'forEdit' => $article->getForEdit($id),
            'pageTitle' => 'Edit Post',
            'validation' => \Config\Services::validation()
        ];

        return view('article/edit', $data);
    }

    public function update()
    {
        $article = new articleModel();

        // old title
        $oldTitle = $article->getForEdit($this->request->getPost('id'));
        if ($oldTitle['title'] == $this->request->getPost('title')) {
            $titleRules = 'required';
        } else {
            $titleRules = 'required|min_length[8]|is_unique[blog_article.title]';
        }

        if (!$this->validate([
            'author' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Author name is required!'
                ]
            ],
            'title' => $titleRules,
            'description' => 'required|min_length[100]',
            'preview_image' => [
                'rules' => 'max_size[preview_image,1024]|mime_in[preview_image,image/jpg,image/jpeg,image/svg,image/webp,image/png]|is_image[preview_image]',
                'errors' => [
                    'max_size' => 'The size of this image is too large. The image must have less than 1MB size',
                    'mime_in' => 'Your upload does not have a valid image format',
                    'is_image' => 'Your file is not allowed! Please use an image!'
                ]
            ],
            'content' => 'required'
        ])) {

            // load validation
            // $validation = \Config\Services::validation();
            return redirect()->to('/article/edit/' . $this->request->getPost('id'))->withInput();
        }

        // get image
        $previewImage = $this->request->getFile('preview_image');
        // Check image if user have not uploaded image
        if ($previewImage->getError() == 4) {
            // name
            $imageName = $this->request->getPost('oldImage');
        } else {
            // generate name
            $imageName = $previewImage->getRandomName();
            // moving
            $previewImage->move('assets/img', $imageName);

            // delete old image
            unlink('assets/img/' . $this->request->getPost('oldImage'));
        }

        $slug = url_title($this->request->getPost('title'), '-', true);

        $article->update($this->request->getPost('id'), [
            'author' => $this->request->getPost('author'),
            'title' => $this->request->getPost('title'),
            'slug' => $slug,
            'description' => $this->request->getPost('description'),
            'last_update' => $this->request->getPost('last_update'),
            'preview_image' => $imageName,
            'content' => $this->request->getPost('content')
        ]);
        return $this->response->redirect(site_url('article'));
    }

    public function delete($id)
    {
        $article = new articleModel();

        // finding image
        $post = $article->find($id);

        // delete image
        unlink('assets/img/' . $post['preview_image']);

        $article->delete($id);
        return $this->response->redirect(site_url('article'));
    }

    public function publish($id)
    {
        $article = new articleModel();

        $article->update($id, ['status' => 1, 'publish_date' => date('D, d M H:i:s')]);
        return $this->response->redirect(site_url('article'));
    }

    public function unpublish($id)
    {
        $article = new articleModel();

        $article->update($id, ['status' => 0, 'publish_date' => 'Unpublished']);
        return $this->response->redirect(site_url('article'));
    }
}
