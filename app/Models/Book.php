<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'photo_id',
        'description',
        'author_id',
        'category_id',
        'published_date',
        'status',
        'book'
    ];

    /**
     * Set the categories
     *
     */
    public function setAuthorAttribute($value)
    {
        $this->attributes['author_id'] = json_encode($value);
    }
  
    /**
     * Get the categories
     *
     */
    public function getAuthorAttribute($value)
    {
        return $this->attributes['author_id'] = json_decode($value);
    }

    /**
     * Set the categories
     *
     */
    public function setCategoryAttribute($value)
    {
        $this->attributes['category_id'] = json_encode($value);
    }
  
    /**
     * Get the categories
     *
     */
    public function getCategoryAttribute($value)
    {
        return $this->attributes['category_id'] = json_decode($value);
    }
}
