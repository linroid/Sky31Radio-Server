<?php

/**
 * Contribution
 *
 * @property integer $id
 * @property string $name
 * @property string $contact
 * @property integer $program_id
 * @property string $passed_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Contribution whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Contribution whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Contribution whereContact($value)
 * @method static \Illuminate\Database\Query\Builder|\Contribution whereProgramId($value)
 * @method static \Illuminate\Database\Query\Builder|\Contribution wherePassedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Contribution whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Contribution whereUpdatedAt($value)
 * @property-read \Program $program
 */
class Contribution extends \Eloquent {
	protected $fillable = ['name', 'contact'];

    public function program(){
        return $this->hasOne('Program', 'id', 'program_id');
    }
    public function setPassed($passed, User $user){
        $this->program->user_id = $user->id;
        $this->attributes['passed_at'] = $passed ? new DateTime() : null;

        return $this->program->save() && $this->save();
    }
    public function delete(){
        return $this->program->delete() && parent::delete();
    }
}