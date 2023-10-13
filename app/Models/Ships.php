<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ships_gallery;
use App\Models\Cabin_categories;

class Ships extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'spec',
        'description',
        'ordering',
        'state'
    ];

    public function category(){
        return $this->hasMany(Cabin_categories::class, 'ship_id');
    }

    public function gallery()  {
        return $this->hasMany(Ships_gallery::class, 'ship_id');
    }
}
