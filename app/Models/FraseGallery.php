<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FraseGallery extends Model
{
    protected $table = 'frases_gallery';

    protected $fillable = ['titulo', 'texto', 'image'];

    public function getAll()
    {
        return $this->select('id', 'titulo', 'texto', 'image')->get();
    }

    public function store(array $data)
    {
        return $this->create($data);
    }

    public function deleteById(int $id): bool
    {
        return $this->where('id', $id)->delete();
    }
}
