<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Image;

class NewsController extends Controller
{

    public function __construct()
    {
        $this->news = new News();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsData = $this->news->getAllNews();
        $latestPosts = $this->news->getLatestPosts();
        return view('news.index', compact('newsData','latestPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->is_verified == 1){
            return view('news.news_form');
        } else {
            return Redirect::route('listNews');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $rules = [
            'title' => 'required|min:6',
            'image' => 'required|image',
            'description' => 'required|min:50'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return Redirect::back()->withInput($request->all())->withErrors($validator);
        }
        try {
            $image = '';
            if($request->file('image')){
                $file = array('image' => $request->file('image'));
                $destinationPath = base_path('public/uploads/news/'); // upload path
                $extension = $file['image']->getClientOriginalExtension(); // getting image extension
                $fileName = strtotime(date('Y-m-d h:i:s')).'-'.$file['image']->getClientOriginalName(); // renameing image
                $file['image']->move($destinationPath, $fileName); // uploading file to given path
                \Image::make($destinationPath.$fileName)->resize(64, 64)->save(base_path('public/uploads/news/thumb/' . $fileName));
                $image = $fileName;
            }
            $dataArray = [
              'title' => $request->title,
              'image' => $image,
              'description' => $request->description,
              'user_id' => Auth::user()->id,
              'status' => 1,
            ];
            $result = $this->news->saveNews($dataArray);
            session()->flash('success', 'News Created Successfully.');
            return Redirect::back();
        } catch (\Exception $e){
            session()->flash('error', $e->getMessage());
            return Redirect::back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $newsDetail = $this->news->getNewsById($id);
        if(count($newsDetail) > 0){
            $latestPosts = $this->news->getLatestPosts();
            return view('news.news_detail', compact('newsDetail','latestPosts'));
        }
        return Redirect::to('/news');
    }

    /**
     * Method to list all user posts.
     *
     */
    public function userPosts()
    {
        $allPosts = $this->news->getNewsByUserId(Auth::user()->id);
        return view('news.post', compact('allPosts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        $delete_news = News::destroy($id);
        if (!empty($news->image)) {
            if (file_exists(base_path('public/uploads/news/') . $news->image)) {
                unlink(base_path('public/uploads/news/') . $news->image);
            }
            if (file_exists(base_path('public/uploads/news/thumb/') . $news->image)) {
                unlink(base_path('public/uploads/news/thumb/') . $news->image);
            }
        }
        return Redirect::route('userPosts');
    }

    /*
     * Method to get Rss Feed
     */
    public function getRssFeeds(){
        /* create new feed */
        $feed = \App::make("feed");
        /* creating rss feed with our most recent 20 posts */
        $posts = \DB::table('news')
            ->select('news.*', 'users.name as author', 'news.id as slug', 'news.description as content')
            ->join('users', 'news.user_id', '=', 'users.id')
            ->orderBy('created_at', 'desc')->take(10)->get();

        /* set your feed's title, description, link, pubdate and language */
        $feed->title = 'DrawYourThoughts Rss Feeds';
        $feed->description = 'Rss Feed';
        $feed->logo = '';
        $feed->link = url('feed');
        $feed->setDateFormat('datetime');
        $feed->pubdate = date('F d, Y');
        $feed->lang = 'en';
        $feed->setShortening(true);
        $feed->setTextLimit(1000);

        if(count($posts) > 0){
            foreach ($posts as $post)
            {
                $feed->add($post->title, $post->author, \URL::route('newsDetail', $post->slug), $post->created_at, $post->description, $post->content);
            }
        }

        return $feed->render('atom');
    }

    /*
     * Method the get NewsStand
     */
    public function newsStand(){
        $latestPosts = $this->news->getLatestPosts();
        return view('news.news_stand', compact('latestPosts'));
    }

    /*
     * Method to create PDF for single news
     */
    public function downloadPdf($id){
        $newsData = $this->news->getNewsById($id);
        //return view('news_stand_pdf', compact('newsData'));
        $pdf = \PDF::loadView('news_stand_pdf', compact('newsData'));
        return $pdf->download('NewsStand.pdf');
    }
}
