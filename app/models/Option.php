<?php

/**
 * Option
 *
 * @property integer $id
 * @property string $key
 * @property string $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Option whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Option whereKey($value)
 * @method static \Illuminate\Database\Query\Builder|\Option whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\Option whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Option whereUpdatedAt($value)
 */
class Option extends \Eloquent {
	protected $fillable = [];
}