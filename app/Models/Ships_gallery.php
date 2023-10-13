<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ships_gallery extends Model
{
    use HasFactory;
    protected $table = 'ships_gallery';
    protected $fillable = [
        'ship_id',
        'title',
        'url',
        'ordering'
    ];

    public function ships(){
        return $this -> belongsTo('App\Models\Ships', 'ship_id');
    }

}
