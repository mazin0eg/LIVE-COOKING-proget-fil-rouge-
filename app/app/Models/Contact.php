<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Contact extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'subject',
        'message',
        'is_chef_application',
        'status',
        'experience',
        'speciality',
        'user_id'
    ];

    /**
     * Get the user associated with the contact.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
