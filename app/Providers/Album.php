<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Album extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title', 'subtitle', 'cover', 'is_hot', 'details', 'author_id'
    ];
    protected $dates = [
        'deleted_at'
    ];
    public function author() {
        return $this->belongsTo(Author::class);
    }
}