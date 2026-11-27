<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'gamertag', 'email', 'password', 'telefono', 'fecha_nacimiento'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $attributes = [
        'activo' => 1,
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function direcciones(): BelongsToMany
    {
        return $this->belongsToMany(Direccion::class, 'usuario_direcciones', 'usuario_id', 'direccion_id')
            ->withPivot('principal');
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('administrador');
    }

    public function hasRole(...$roles): bool
    {
        return $this->activo && $this->roles()->whereIn('nombre', $roles)->exists();
    }

    public function homeRoute(): string
    {
        if ($this->isAdmin()) {
            return 'admin.index';
        }

        return $this->hasRole('operador') ? 'operador.index' : 'inicio';
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
            'email_verified_at' => 'datetime',
            'fecha_nacimiento' => 'date',
            'password' => 'hashed',
        ];
    }
}
