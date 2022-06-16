<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Client extends Model
{
    use HasFactory, Sortable;
    public $timestamps= false;
    protected $guarded=[];

    public $sortable = ['name', 'surname'];

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}
