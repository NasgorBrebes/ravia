<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = ['user_id', 'guestName', 'guestAddress', 'guestStatus'];

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
}
