<?php

/**
 * Program
 *
 * @property integer $id
 * @property string $title
 * @property string $article
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Program whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Program whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\Program whereArticle($value)
 * @method static \Illuminate\Database\Query\Builder|\Program whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Program whereUpdatedAt($value)
 * @property integer $user_id
 * @property integer $album_id
 * @property string $author
 * @method static \Illuminate\Database\Query\Builder|\Program whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Program whereAlbumId($value)
 * @method static \Illuminate\Database\Query\Builder|\Program whereAuthor($value)
 * @property-read \User $user
 * @property string $cover
 * @property-read \Audio $audio
 * @method static \Illuminate\Database\Query\Builder|\Program whereCover($value)
 * @property-read \Album $album
 * @property boolean $visible
 * @method static \Illuminate\Database\Query\Builder|\Program whereVisible($value)
 * @property-read \PlayLog $totalPlayRelation
 * @property-read mixed $total_play
 * @property string $thumbnail
 * @method static \Illuminate\Database\Query\Builder|\Program whereThumbnail($value)
 * @property string $background
 * @method static \Illuminate\Database\Query\Builder|\Program whereBackground($value)
 */
class Program extends \Eloquent {
	protected $fillable = ['title', 'article', 'album_id', 'author', 'user_id'];
    protected $appends = ['total_play'];
    public $hidden = ['totalPlayRelation', 'visible', 'article'];

    public function audio(){
        return $this->hasOne('Audio', 'program_id', 'id');
    }
    public function album(){
        return $this->belongsTo('Album', 'album_id', 'id');
    }
    public function user(){
        return $this->belongsTo('User', 'user_id', 'id');
    }
    public function getCoverAttribute(){
        return empty($this->attributes['cover']) ? null : url($this->attributes['cover']);
    }
    public function getThumbnailAttribute(){
        return empty($this->attributes['thumbnail']) ? null : url($this->attributes['thumbnail']);
    }
    public function getBackgroundAttribute(){
        return empty($this->attributes['background']) ? null : url($this->attributes['background']);
    }
    public function delete(){
        File::delete('public/'.$this->cover);
        return $this->audio->delete() && parent::delete();
    }
//    public function

    public function totalPlayRelation(){
        return $this->hasOne('PlayLog', 'program_id', 'id')
            ->selectRaw('program_id, count(*) as count')
            ->groupBy('program_id');
    }
    public function getTotalPlayAttribute()
    {
        return intval($this->totalPlayRelation['count']);
    }
//    public function getArticleAttribute(){
//        return htmlspecialchars_decode($this->attributes['article']);
//    }
}