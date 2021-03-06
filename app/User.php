<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
        'nome', 'email', 'password', 'cpf', 'ultimo_acesso', 'id_usuario', 'features'
    ];

    protected $primaryKey = 'id_usuario';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function __construct(array $attributes = [])
    {
        if (isset($attributes['password'])) {
            $attributes['password'] = bcrypt($attributes['password']);
            if (isset($attributes['features'])) {
                $attributes['features'] = json_encode($attributes['features']);
            }
        }
        parent::__construct($attributes);
    }

    public function updateRow(User $user)
    {
        return User::newQuery()->where('id_usuario', $user->id_usuario)->update($user->toArray());
    }

    public static function hasFeature($feature, $usuario)
    {
        $features = json_decode($usuario->features, true);
        if (isset($features['master'])) {
            return true;
        }
        return isset($features[$feature]) ? true : false;
    }

    public function save(array $options = [])
    {
        if (isset($options['master']) && $options['master'] == true) {
            return parent::save($options);
        }
        $this->password = bcrypt('einsteinfloripa');
        return parent::save($options);
    }
}
