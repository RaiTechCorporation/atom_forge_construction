<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\HasPermissions;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, HasPermissions, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'profile_picture',
        'password',
        'role',
        'two_factor_enabled',
        'two_factor_code',
        'two_factor_expires_at',
    ];

    public function generateTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(10);
        $this->save();
    }

    public function resetTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    public function isAdmin()
    {
        if ($this->role === 'super_admin') {
            return true;
        }

        if ($this->roles()->where('slug', 'admin')->exists()) {
            return true;
        }

        return in_array($this->role, ['super_admin', 'admin_staff', 'project_manager', 'tender_executive', 'site_supervisor', 'accountant']);
    }

    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    public function isAdminStaff()
    {
        return $this->role === 'admin_staff';
    }

    public function isProjectManager()
    {
        return $this->role === 'project_manager';
    }

    public function isTenderExecutive()
    {
        return $this->role === 'tender_executive';
    }

    public function isSiteSupervisor()
    {
        return $this->role === 'site_supervisor';
    }

    public function isAccountant()
    {
        return $this->role === 'accountant';
    }

    public function isClient()
    {
        return $this->role === 'client';
    }

    public function isInvestor()
    {
        return $this->role === 'investor';
    }

    public function investor()
    {
        return $this->hasOne(Investor::class);
    }

    public function siteManager()
    {
        return $this->hasOne(SiteManager::class);
    }

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
            'two_factor_expires_at' => 'datetime',
            'two_factor_enabled' => 'boolean',
        ];
    }
}
