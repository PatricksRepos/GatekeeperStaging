<?php

  namespace App\Models;

  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Database\Eloquent\Relations\BelongsTo;
  use Illuminate\Database\Eloquent\Relations\BelongsToMany;
  use Laravel\Jetstream\HasProfilePhoto;

  class Policy extends Model
  {

    use HasFactory; /*HasProfilePhoto*/

    protected $fillable = [
      'hash',
      'name',
      'description',
      'team_id',
      'user_id',
    ];

    protected $hidden = [
      'created_at',
      'updated_at',
    ];
// Removed , for user?
/*    protected $appends = [
      'profile_photo_url',
    ];*/


    public function team(): BelongsTo
    {
      return $this->belongsTo(Team::class);
    }

    public function user(): BelongsTo
    {
      return $this->belongsTo(User::class);
    }

    public function events(): BelongsToMany
    {
      return $this->belongsToMany(Event::class);
    }

  }
