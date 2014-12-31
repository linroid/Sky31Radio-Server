<?php

/**
 * PlayLog
 *
 * @property integer $id
 * @property integer $program_id
 * @property string $ip
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\PlayLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\PlayLog whereProgramId($value)
 * @method static \Illuminate\Database\Query\Builder|\PlayLog whereIp($value)
 * @method static \Illuminate\Database\Query\Builder|\PlayLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\PlayLog whereUpdatedAt($value)
 * @property-read \Program $program
 */
class PlayLog extends \Eloquent {
	protected $fillable = [];
    public function program(){
        return $this->belongsTo('Program', 'program_id', 'id');
    }
}