<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'section',
        'count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function incrementCount($userId, $section)
    {
        $notification = self::firstOrCreate(
            ['user_id' => $userId, 'section' => $section],
            ['count' => 0]
        );
        $notification->increment('count');
    }

    public static function clearCount($userId, $section)
    {
        $notification = self::where('user_id', $userId)->where('section', $section)->first();
        if ($notification) {
            $notification->update(['count' => 0]);
        }
    }
}
