<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    use HasFactory;

    protected $fillable=[

        'Question',
        'quiz_id',
        'question_image'

    ];
    protected $table='question';
public $timestamps=false;

    public function user()
    {
        return $this->belongsTo(quiz::class);
    }



    public function answers(){


            return $this->hasMany(answers::class);

    }

}
