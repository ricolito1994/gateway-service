<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

class Logs extends Model
{
    //
    protected $fillable = [
        'activity',
        'done_by'
    ];

    public function scopeFilter($query, Request $request) 
    {
        return $query->when($request->done_by, function ($q) use ($request) {
            $q->where('done_by', $request->done_by);
        })->when($request->activity, function ($q) use ($request) {
            $q->where('activity', 'LIKE', "%{$request->activity}%");
        });
    }
}
