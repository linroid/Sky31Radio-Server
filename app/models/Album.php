<?php

/**
 * Album
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Album whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Album whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Album whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Album whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Album whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\Program[] $programs
 * @property string $cover
 * @method static \Illuminate\Database\Query\Builder|\Album whereCover($value)
 */
class Album extends \Eloquent {
	protected $fillable = ['name', 'type'];

    public static function seasons(){
        return Album::whereType('season');
    }
    public static function activities(){
        return Album::whereType('activity');
    }
    public function programs(){
        return $this->hasMany('Program', 'album_id', 'id')
            ->whereVisible(1)
            ->orderBy('created_at', 'desc');
    }

    public function getCoverAttribute(){
        return empty($this->attributes['cover']) ? null : url($this->attributes['cover']);
    }
}