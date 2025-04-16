<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * Atributy, které mohou být hromadně přiřazeny.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Atributy, které by měly být skryty při serializaci.
     *
     * Tato vlastnost se používá k určení, které sloupce by měly být
     * skryty, když bude model konvertován na pole nebo JSON. V tomto
     * případě se skryjí atributy 'password' a 'remember_token'.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Získat atributy, které by měly být přetypovány.
     *
     * Tento accessor určuje, jak budou určité atributy přetypovány.
     * Například atribut 'email_verified_at' bude automaticky
     * přetypován na instanci `datetime` a atribut 'password' bude
     * přetypován na 'hashed', což znamená, že bude uchováván v
     * zašifrované podobě.
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
}
