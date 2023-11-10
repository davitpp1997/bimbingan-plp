<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

use App\Models\Guru;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\ModelRoles;

class User extends Authenticatable implements JWTSubject
{
    use HasRoles;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'nomor_identitas',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        //tambahan
        // 'roles',
        // 'user_roles',
        'api_token',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // This will add `role_names` to your `User`, when converted to JSON/Array/etc
    // protected $appends = ['user_roles'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
 
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    // Accessible via `$user->role_names`, or `user.role_names` in JSON
    public function getUserRolesAttribute() {
        // return $this->roles->pluck('name'); 
        
        return $this->roles->map(function ($role) {
            return $role->only(['id', 'name']);
        }); 
    }

    // public function getRoles() {
    //     $r = $this->hasMany(ModelRoles::class, 'model_id');

    //     return $r->pluck('model_id');
    // }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'user_id');
    }

    public function dosen()
    {
        // return $this->hasOne(Dosen::class, 'user_id');
        return $this->hasOne('App\Models\Dosen');
    }

    public function guru()
    {
        return $this->hasOne(Guru::class, 'user_id')
                    ->join('sekolah','sekolah.kode','=', 'guru.kode_sekolah')
                    ->select(
                        'guru.user_id',
                        'guru.nomor_identitas',
                        'guru.kode_sekolah',
                        'sekolah.sekolah',
                        'guru.kode_jurusan'
                    );
    }
}
