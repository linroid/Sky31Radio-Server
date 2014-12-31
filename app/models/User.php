<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Pingpong\Admin\Entities\User as PingpongUser;

/**
 * User
 *
 * @property integer $id
 * @property string $nickname
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereNickname($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereRole($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereUpdatedAt($value)
 * @property string $avatar
 * @property-read \Program $programCountRelation
 * @property-read mixed $program_count
 * @method static \Illuminate\Database\Query\Builder|\User whereAvatar($value)
 */
class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

    protected $fillable = ['nickname', 'email', 'password', 'role'];

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
    protected $appends = ['program_count'];
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token', 'programCountRelation');

    public function is($role){
        return $this->attributes['role'] == $role;
    }

    public static function anchors(){
        return User::whereRole('anchor');
    }
    public static function administrators(){
        return User::whereRole('admin');
    }

    public static function normals(){
        return User::whereRole('normal');
    }

    public function setPasswordAttribute($password){
        $this->attributes['password'] = Hash::make($password);
    }
    public function getAvatarAttribute(){
        return empty($this->attributes['avatar']) ? null : url($this->attributes['avatar']);
    }
    public function programCountRelation(){
        return $this->hasOne('Program', 'user_id', 'id')
            ->selectRaw('user_id, count(*) as count')
            ->groupBy('user_id');
    }
    public function getProgramCountAttribute()
    {
        return intval($this->programCountRelation['count']);
    }
}
