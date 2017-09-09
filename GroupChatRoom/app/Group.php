<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name'];

    public function users()
    {
        // created_at & updated_at
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function hasUser($user_id)
    {
        foreach ($this->users as $user)
        {
            if($user == $user_id)
            {
                return true;
            }
        }
    }
}
