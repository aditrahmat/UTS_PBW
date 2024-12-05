<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'level',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // Daftar level pengguna
    public const LEVELS = [
        'Administrator',
        'Project Director',
        'Project Manager',
        'Team Leader',
        'User',
    ];

    // Helper untuk cek level
    public function isLevel(string $level): bool
    {
        return $this->level === $level;
    }

    public function isAbove(string $level): bool
    {
        return array_search($this->level, self::LEVELS) < array_search($level, self::LEVELS);
    }

    public function isBelow(string $level): bool
    {
        return array_search($this->level, self::LEVELS) > array_search($level, self::LEVELS);
    }
}
