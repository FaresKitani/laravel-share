<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class File extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable  = [
        'file_path',
        'status',
        'file_name',
        'description',
        'user_id',
        'number_of_downloads',
        'number_of_people'
    ];

    public static function booted()
    {
        static::addGlobalScope('user-files', function(Builder $builder) {
            $builder->where('user_id', '=', Auth::user()->id);
        });

        static::created(function ($file) {

            
            $data = [
                'user_id' => Auth::user()->id,
                'file_id' => $file->id,
                'is_valid' => 1,
                'url' =>  Str::random(rand(5, 255)),
                'is_reusable' => 0,
            ];
            
            Url::create($data);
        });
    }

    public static function statusOptions()
    {
        return [
            'private' => 'badge bg-blue',
            'public' => 'badge bg-red',
            'accessible' => 'badge bg-green'
        ];
    }

    public function link()
    {
        return $this->hasOne(Url::class,'file_id','id');
    }

    public function getUrlAttribute()
    {
        return Url::where('file_id', '=', $this->id)->get();
    }
}
