<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Author extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'avatar',
    ];
    protected $dates = [
        'deleted_at'
    ];
    public function albums() {
        return $this->hasMany(Album::class);
    }
}