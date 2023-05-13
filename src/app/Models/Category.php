<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static firstOrCreate(mixed $data)
 * @method static findOrFail(int $id)
 * @method static paginate(int $int)
 * @method static where(string $string, string $string1, string $string2)
 * @method static orderBy(mixed $sortField, mixed $sortDirection)
 */
class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title'
    ];

    /**
     * Relationships of categories to posts.
     *
     * @return hasMany
     */
    public function posts(): hasMany
    {
        return $this->hasMany(Post::class);
    }
}
