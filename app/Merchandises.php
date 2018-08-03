<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merchandises extends Model
{
    //
    protected $table = 'merchandises';
    protected $primaryKey = 'id';

    protected $fillable = [
        "id",
        "status",
        "name",
        "name_en",
        "introduction",
        "introduction_en",
        "photo",
        "price",
        "remain_count"
    ];
}
