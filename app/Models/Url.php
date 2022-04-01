<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Url extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'url';

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';

    protected $fillable = [

    'user_id',
    'file_id' ,
    'is_valid',
    'url',
    'is_reusable',
    
    ];

    public function file()
    {
        return $this->belongsTo(File::class, 'id','file_id');
    }
}
