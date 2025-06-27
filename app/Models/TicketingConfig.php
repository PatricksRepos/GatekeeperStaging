<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketingConfig extends Model
{
  use HasFactory;

  protected $fillable = [
    'status', // Active/Inactive
    'max_tickets', // max ticket limit
    // Add any other configuration you need
  ];
}
