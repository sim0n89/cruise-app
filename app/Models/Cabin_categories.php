<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabin_categories extends Model
{
    use HasFactory;

    protected $table ="cabin_categories";

    protected $fillable = [
        'ship_id',
        'vendor_code',
        'title',
        'type',
        'description',
        'photos',
        'ordering',
        'state'
    ];

    public function ships(){
        return $this -> belongsTo('App\Models\Ships', 'ship_id');
    }

}
