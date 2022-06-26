<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Visit extends Model
{
    use HasFactory, Sortable;
    public $timestamps= false;
    protected $guarded=[];

    Public $sortable =['name', 'surname', 'start_time', 'end_time' ];


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
