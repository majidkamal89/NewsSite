<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    protected $table = 'news';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'image', 'user_id', 'status', 'created_at', 'updated_at'
    ];

    /*
     * Method to get all news with pagination
     */
    public function getAllNews(){
        $news = self::paginate(10);
        return $news;
    }

    /*
     * Method to get single news
     */
    public function getNewsById($id){
        $news = self::where('id', $id)->get();
        return $news;
    }

    /*
     * Method to get all news of user
     */
    public function getNewsByUserId($id){
        $news = self::where('user_id', $id)->get();
        return $news;
    }

    /*
     * Method to get latest posts
     */
    public function getLatestPosts(){
        $news = DB::table('news')
            ->select('news.*','users.name')
            ->join('users', 'news.user_id', '=', 'users.id')
            ->orderBy('news.created_at', 'desc')->take(10)->get();
        return $news;
    }

    /*
     * Method to Store news
     */
    public function saveNews($dataArray){
        $save = self::create($dataArray);
        return $save;
    }

    public function User(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
