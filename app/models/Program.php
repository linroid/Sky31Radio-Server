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
 */
class Program extends \Eloquent {
	protected $fillable = ['title', 'article', 'album_id', 'author'];

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
}