<?php

/**
 * Audio
 *
 * @property integer $id
 * @property integer $program_id
 * @property string $path
 * @property string $size
 * @property string $duration
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Audio whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Audio whereProgramId($value)
 * @method static \Illuminate\Database\Query\Builder|\Audio wherePath($value)
 * @method static \Illuminate\Database\Query\Builder|\Audio whereSize($value)
 * @method static \Illuminate\Database\Query\Builder|\Audio whereDuration($value)
 * @method static \Illuminate\Database\Query\Builder|\Audio whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Audio whereUpdatedAt($value)
 * @property-read mixed $src
 * @property-read mixed $url
 * @property-read \Program $program
 */
class Audio extends \Eloquent {
	protected $fillable = [];
    protected $appends = ['src'];
    protected $hidden = ['path'];

    public function getSrcAttribute(){
//        return 'http://radio.sky31.com/'.$this->path;
        return url('api/audio', $this->id.".mp3");
    }
    public function getUrlAttribute(){
        return url($this->attributes['path']);
    }
    public function delete(){
        File::delete('public/'.$this->path);
        return parent::delete();
    }
    public function program(){
        return $this->belongsTo('Program', 'program_id', 'id');
    }
}