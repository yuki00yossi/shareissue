<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'detail',
        'assign_user_id',
        'responsible_user_id',
        'project_id',
        'timelimit',
        'status'
    ];

    public function projects() {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function assign_user() {
        return $this->belongsTo(User::class, 'assign_user_id');
    }
}
