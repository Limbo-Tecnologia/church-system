<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Church extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'document_number',
        'phone',
        'address',
        'geolocation',
        'foundation_date',
    ];

    /**
     * Define os atributos que devem ser convertidos.
     *
     * @var array<string>
     */
    protected $cast = [
        'name' => 'string',
        'foundation_date' => 'date',
    ];

    protected $appends = ['members_count', 'president'];


    /**
     * Define a relação de muitos para muitos com a model User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('role')->withTimestamps();
    }

    /**
     * Obtém o presidente da igreja.
     *
     * @return \App\Models\User|null
     */
    public function getPresidentAttribute(): ?User
    {
        return $this->users()->wherePivot('role', 'Pastor-Presidente')->first();
    }

    /**
     * Obtém os pastores da igreja.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function pastors()
    {
        return $this->users()->wherePivot('role', 'Pastor');
    }

    /**
     * Obtém a contagem de membros da igreja.
     *
     * @return int
     */
    public function getMembersCountAttribute(): int
    {
        return $this->users()->count();
    }
}
