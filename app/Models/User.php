<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    public function getTableStructure()
    {
    return [
        'editRoute' => 'users_edit',
        'fields' => [
            ['key' => 'name', 'label' => 'Nombre'],
            ['key' => 'email', 'label' => 'Email'],
            ['key' => 'created_at', 'label' => 'Creado'],
            ['key' => 'updated_at', 'label' => 'Actualizado'],
        ],
    ];
    }

    public function getFormStructure()
    {
    return [
        ['name' => 'id', 'label' => '', 'type' => 'hidden'],
        ['name' => 'name', 'label' => 'Nombre', 'type' => 'text'],
        ['name' => 'email', 'label' => 'Email', 'type' => 'email'],
        ['name' => 'password', 'label' => 'Contraseña', 'type' => 'password'],
        ['name' => 'password_confirmation', 'label' => 'Confirmar contraseña', 'type' => 'password'],
    ];
    }
    
}
