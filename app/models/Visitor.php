<?php


/**
 * Visitor
 *
 * @property integer $id
 * @property string $ip
 * @property integer $hits
 * @property string $online
 * @property string $url
 * @property string $path
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Visitor whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Visitor whereIp($value)
 * @method static \Illuminate\Database\Query\Builder|\Visitor whereHits($value)
 * @method static \Illuminate\Database\Query\Builder|\Visitor whereOnline($value)
 * @method static \Illuminate\Database\Query\Builder|\Visitor whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\Visitor wherePath($value)
 * @method static \Illuminate\Database\Query\Builder|\Visitor whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Visitor whereUpdatedAt($value)
 * @method static \Visitor today()
 * @method static \Visitor selectTotalHits()
 * @property string $lucky_key
 * @method static \Illuminate\Database\Query\Builder|\Visitor whereLuckyKey($value)
 * @property-read mixed $today_position
 * @property string $name
 * @property string $phone
 * @property string $info
 * @property string $school
 * @method static \Illuminate\Database\Query\Builder|\Visitor whereName($value) 
 * @method static \Illuminate\Database\Query\Builder|\Visitor wherePhone($value) 
 * @method static \Illuminate\Database\Query\Builder|\Visitor whereInfo($value) 
 * @method static \Illuminate\Database\Query\Builder|\Visitor whereSchool($value) 
 */
class Visitor extends \Eloquent
{
    private static $luck_positions = array(
        50, 100, 200
    );

    /**
     * Fillable Property.
     *
     * @var array
     */
    protected $fillable = ['ip', 'hits', 'online', 'url', 'path', 'lucky_key', 'school', 'name', 'phone', 'info'];

    public $appends = ['today_position'];
    /**
     * Track hits online visitors.
     *
     * @return Visitor
     */
    public static function track()
    {
        $ip = Request::server('REMOTE_ADDR');
        $online = time();
        $url = URL::full();
        $path = Request::path();

        $visitor = null;
        if(Session::has('visitor_id')){
            $visited = Visitor::whereId(Session::get('visitor_id'))->whereIp($ip)->today()->first();
        }
        if (!empty($visited)) {
            $visited->update([
                'online' => $online,
                'hits' => $visited->hits + 1,
                'url' => $url,
                'path' => $path,
                'luck_key'=>$visited->lucky_key
            ]);
            $visitor = $visited;
        } else {
            $visitor = static::createNewVisitor();
            Session::set('visitor_id', $visitor->id);
        }
        return $visitor;
    }

    /**
     * Create new visitor.
     *
     * @return self
     */
    public static function createNewVisitor()
    {
        $visitor = static::create([
            'online' => time(),
            'ip' => Request::server('REMOTE_ADDR'),
            'hits' => 1,
            'url' => URL::full(),
            'path' => Request::path(),
            'lucky_key' => in_array(Visitor::todayTotal(), static::$luck_positions) ? strtoupper(str_random(5)) : null
//            'lucky_key' => strtoupper(str_random(5))
        ]);
        return $visitor = Visitor::find($visitor->id);
    }

    /**
     * @return Visitor
     */
    public static function obtain()
    {
        $visitor_id = Session::get('visitor_id');
        $visitor = static::findOrFail($visitor_id);
        return $visitor;
    }

    public function getTodayPositionAttribute(){
        $position = Visitor::where('id', '<', $this->id)->today()->count() + 1;
        return $position;
    }
    public static  function todayTotal(){
        return Visitor::today()->count();
    }
    // scopes
    /**
     * @param $query
     * @return mixed
     */
    public function scopeToday($query)
    {
        // mysql
        $raw = "date(created_at) = date(now())";

        return $query->whereRaw($raw);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeSelectTotalHits($query)
    {
        return $query->select('visitors.*', DB::raw("SUM(hits) as total_hits"));
    }

    /**
     * @return int
     */
    public static function getHitsToday()
    {
        $data = static::today()->selectTotalHits()->first();

        return isset($data->total_hits) ? $data->total_hits : 0;
    }

    /**
     * @return mixed
     */
    public static function getTotalVisitorsToday()
    {
        return static::today()->count();
    }

    /**
     * @return int
     */
    public static function getTotalHits()
    {
        $data = static::selectTotalHits()->first();

        return isset($data->total_hits) ? $data->total_hits : 0;
    }

    /**
     * @return int
     */
    public static function getOnlineUsers()
    {
        $time = time() - 300;

        $data = static::where('online', '>', $time)
            ->groupBy('ip')
            ->select('ip', DB::raw("count(*) as total_users"))
            ->first();

        return isset($data->total_users) ? $data->total_users : 0;
    }
}
