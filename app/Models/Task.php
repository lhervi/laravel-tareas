<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;
    //protected $fillable = ['title', 'description', 'status', 'due_date', 'user_id'];
    protected $fillable = ['title', 'description', 'status', 'due_date'];

    //protected $casts = ['status' => 'string'];
    const STATUSES = ['pending', 'in-progress', 'completed', 'canceled'];

    public function user():BelongsTo
    {
        return $this->belonsTo(User::class);
    }

}
