<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table    = 'article';
    protected $useTimestamps = true;
    protected $allowedFields = ['title', 'content', 'thumbnail'];

    public function getAll() {
        return $this->findAll();
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function getExcludeById($id) {
        return $this->where('id !=', $id)->findAll();
    }

    public function deleteById($id) {
        return $this->delete($id);
    }
}
