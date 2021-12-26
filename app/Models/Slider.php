<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'slider_name','slide_image','slider_status','slider_desc'
    ];
    protected $primaryKey = 'slider_id';
    protected $table = "tbl_slider";
}
