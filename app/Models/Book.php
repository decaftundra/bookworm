<?php

  namespace App\Models;

  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Database\Eloquent\Relations\BelongsTo;

  class Book extends Model
  {
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
      'user_id',
      'title',
      'author',
      'rating',
      'price',
    ];

    /**
     * Get the user that owns the book.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
      return $this->belongsTo(User::class);
    }
  }
