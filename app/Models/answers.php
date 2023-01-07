<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class answers extends Model
{
    use HasFactory;

    protected $fillable = [

        'answertitle',
        'iscorrect',
        'question_id'

    ];
    public $timestamps=false;

    protected $table='answer';


    public function question()
    {
        return $this->belongsTo(question::class);
    }

}
