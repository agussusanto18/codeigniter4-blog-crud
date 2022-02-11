<?php

namespace App\Controllers;

use App\Models\ArticleModel;

class Home extends BaseController
{
    protected $articleModel;

    public function __construct() {
        $this->articleModel = new ArticleModel();
        helper('text');
    }

    public function index()
    {
        // $articles = $this->articleModel->getAll();
        $articles = $this->articleModel->paginate(4);
        $pager = $this->articleModel->pager;

        $data = [
            'articles' => $articles,
            'pager' => $pager
        ];

        return view('home', $data);
    }

    public function detail($id) {
        $article = $this->articleModel->getById($id);
        $articles = $this->articleModel->getExcludeById($id);

        $data = [
            'article' => $article,
            'articles' => $articles
        ];

        return view('detail', $data);
    }

    public function create()
    {
        $data = [
            'validation' => \Config\Services::validation()
        ];

        return view('create', $data);
    }

    public function createSave()
    {
        if(!$this->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'max_size[thumbnail,1024]|is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]'
        ])){
            return redirect()->back()->withInput();
        }

        $thumbnail = $this->request->getFile('thumbnail');
        
        if ($thumbnail->getError() == 4) {
            $filename = 'default.jpeg';
        } else {
            $filename = $thumbnail->getRandomName();
            $thumbnail->move('img', $filename);
        }


        $this->articleModel->save([
            'title' => $this->request->getVar('title'),
            'content' => $this->request->getVar('content'),
            'thumbnail' => $filename
        ]);

        session()->setFlashdata('message', 'Successfully to added data');
        return redirect()->to('/');
    }

    public function update($id)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'article' => $this->articleModel->getById($id)
        ];

        return view('update', $data);
    }

    public function updateSave($id)
    {   
        if(!$this->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'max_size[thumbnail,1024]|is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]'
        ])){
            return redirect()->back()->withInput();
        }

        $article = $this->articleModel->getById($id);

        $thumbnail = $this->request->getFile('thumbnail');
        
        if ($thumbnail->getError() == 4) {
            $filename = $article['thumbnail'];
        } else {
            if ($article['thumbnail'] != 'default.jpeg') {
                unlink('img/' . $article['thumbnail']);
            }
            $filename = $thumbnail->getRandomName();
            $thumbnail->move('img', $filename);
        }

        $this->articleModel->save([
            'id' => $id,
            'title' => $this->request->getVar('title'),
            'content' => $this->request->getVar('content'),
            'thumbnail' => $filename
        ]);

        session()->setFlashdata('message', 'Successfully to updated data');
        return redirect()->to('/');
    }

    public function delete($id) {
        $article = $this->articleModel->getById($id);
       
        if (empty($article)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Artikel tidak ditemukan !');
        }

        if ($article['thumbnail'] != 'default.jpeg') {
            unlink('img/' . $article['thumbnail']);
        }

        $this->articleModel->deleteById($id);
        session()->setFlashdata('message', 'Successfully to deleted data');
        return redirect()->to('/');
    }
}
