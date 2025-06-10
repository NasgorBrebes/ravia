<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Guest extends Model
{
    protected $fillable = ['user_id', 'guestName', 'guestAddress', 'guestStatus', 'slug'];

    // Fungsi untuk mendapatkan statistik tamu
    public static function getGuestStatistics()
    {
        return [
            'total' => self::count(),
            'hadir' => self::where('guestStatus', 'hadir')->count(),
            'tidak_hadir' => self::where('guestStatus', 'tidak_hadir')->count(),
            'belum_konfirmasi' => self::where('guestStatus', 'belum_konfirmasi')->count(),
        ];
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($guest) {
            $baseSlug = Str::slug($guest->guestName);
            $count = Guest::where('slug', 'like', "{$baseSlug}%")->count();
            $guest->slug = $count ? "{$baseSlug}-" . ($count + 1) : $baseSlug;
        });
    }
}
