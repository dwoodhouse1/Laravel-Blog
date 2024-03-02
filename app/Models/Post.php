<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory; // Post::factory()

    protected $guarded = [];
    
    //protected $guarded = ['id']; // DOES NOT allow these attributes to be mass assigned to the user table when using Post::Create CAN ALSO BE EMPTY IF YOU DECIDE YOU NEVER WANT MASS ASSIGNMENT

    // protected $with = ['category', 'author'];

    // protected $fillable = ['category_id', 'slug', 'title', 'excerpt', 'body']; // allows these attributes to be mass assigned to the user table when using Post::Create

    public function scopeFilter($query, array $filters) // Post::newQuery()->fiter()
    {
        // if ($filters['search'] ?? false)
        // {
        //     $query
        //         ->where('title', 'like', '%' . request('search') . '%')
        //         ->orWhere('body', 'like', '%' . request('search') . '%');
        // }

        $query->when($filters['search'] ?? false, fn ($query, $search) => 
            $query->where(fn ($query) =>
                $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%'))
        );

        $query->when($filters['category'] ?? false, fn ($query, $category) => 
            $query->whereHas('category', fn ($query) => 
                $query->where('slug', $category)));

        $query->when($filters['author'] ?? false, fn ($query, $author) => 
            $query->whereHas('author', fn ($query) => 
                $query->where('username', $author)));
                

                
    }

    public function comments()
    {
        // hasOne, hasMany, belongsTo, belongsToMany
        return $this->hasMany(Comment::class);
    }

    public function category()
    {
        // hasOne, hasMany, belongsTo, belongsToMany
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
