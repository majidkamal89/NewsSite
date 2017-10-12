<?php

namespace Tests\Unit;

use App\News;
use App\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * Method to test all routes
     *
     */
    public function testAllRoutes()
    {
        $routeArray = [];
        $routeArray['GET'] = [
            '/' => 'Home Page',
            '/news' => 'List All News',
            '/news/create' => 'Create News Page',
            '/news/{id}' => 'News Detail Page',
            '/posts' => 'User\'s Posts Page',
            '/posts/delete/{id}' => 'User\'s Post Delete Page',
            '/Newsstand' => 'Newsstand page',
            '/Newsstand/pdf/{id}' => 'Newsstand PDF page',
            '/rss-feed' => 'RSS feed page',
        ];
        foreach($routeArray['GET'] as $key => $val){
            if($key == '/posts' || $key == '/posts/delete/{id}' || $key == '/news/create'){
                $user = User::orderBy('id', 'desc')->first();
                if(count($user) > 0){
                    $response = $this->actingAs($user)
                        ->call('GET', '/posts');
                } else {
                    $user = factory(User::class)->create();
                    $response = $this->actingAs($user)
                        ->call('GET', '/posts');
                }
            } else {
                $response = $this->call('GET', $key);
            }
            $routeArray['GET'][$key] = $val.' - Status '.$response->status();
            $this->assertEquals(200, $response->status());
        }
    }

    /*
     * Method to test user Register route
     */
    public function testUserRegisterRoute(){

        $data = [
            'name' => 'shine',
            'email' => 'shine@test.com',
            'password' => 'admin',
            'password_confirmation' => 'admin',
            'is_verified' => 1,
            'status' => 1,
        ];
        $response = $this->call('POST', '/register', $data);
        $this->assertEquals(302, $response->status());
    }

    /**
     * Test Method to create new user.
     *
     * @return void
     */
    public function testCreateNewUser()
    {
        $user = factory(User::class, 2)->create([
            'is_verified' => 1,
            'password' => bcrypt('admin')
        ]);
        dd($user->toArray());
        $this->assertTrue(true);
    }

    /**
     * Test Method to Test user login.
     *
     * @return void
     */
    public function testUserLogin()
    {
        $user = User::orderBy('id', 'desc')->first();
        if(!empty($user)){
            $login = Auth::loginUsingId($user['id']);
            dd($login);
        } else {
            dd(['No user found. Please first create new user']);
        }
        $this->assertTrue(true);
    }

    /**
     * Test Method to Save User News.
     *
     * @return void
     */
    public function testCreateUserNews()
    {
        $user = User::orderBy('id', 'desc')->first();
        if(!empty($user)){
            $news = new News();
            $result = $news->saveNews([
                'title' => 'Test News '.rand(10, 100).'',
                'description' => 'Test News '.rand(10, 100).' Description.',
                'image' => 'img-'.rand(10, 100).'.jpg',
                'user_id' => $user['id'],
                'status' => 1
            ]);
            dd($result);
        } else {
            dd(['No user found to create news. Please first create user']);
        }
    }

    /**
     * Test Method to List All News.
     *
     * @return void
     */
    public function testListAllNews()
    {
        $news = new News();
        $result = $news->getAllNews()->toArray();
        if(!empty($result['data'])){
            dd($result);
        } else {
            dd(['No News Found.']);
        }
        $this->assertTrue(true);
    }

    /**
     * Test Method to list latest news with Author name.
     *
     * @return void
     */
    public function testLatestNewsWithAuthor()
    {
        $news = new News();
        $result = $news->getLatestPosts()->toArray();
        if(!empty($result)){
            dd($result);
        } else {
            dd(['No latest News Found.']);
        }
        $this->assertTrue(true);
    }

    /**
     * Test Method to fetch news by user id.
     *
     * @return void
     */
    public function testGetNewsByUserId()
    {
        $user = User::orderBy('id', 'desc')->first();
        if(!empty($user)){
            $news = new News();
            $result = $news->getNewsByUserId($user['id'])->toArray();
            dd(!empty($result) ? $result : ['No News Found Against user '.$user['name'].'']);
        } else {
            dd(['No User Found to fetch News.']);
        }
        $this->assertTrue(true);
    }

    /**
     * Test Method to fetch news by id.
     *
     * @return void
     */
    public function testGetNewsById()
    {
        $news = new News();
        $result = $news->getNewsById(1)->toArray();
        if(!empty($result)){
            dd($result);
        } else {
            dd(['No News Found for News Id 1.']);
        }
        $this->assertTrue(true);
    }

    /**
     * Test Method to fetch all user and their news.
     *
     * @return void
     */
    public function testAllUserNews()
    {
        $user = new User();
        $result = $user->userNews();
        if(!empty($result)){
            dd($result);
        } else {
            dd(['No News Found of user.']);
        }
        $this->assertTrue(true);
    }

    /**
     * Test Method create news for all users.
     *
     * @return void
     */
    public function testCreateAllUserNews()
    {
        $users = User::get();
        if(count($users) > 0){
            foreach($users as $value){
                $value->News()->create([
                    'title' => 'Test News '.rand(10, 1000).'',
                    'description' => 'Test News '.rand(10, 1000).' Description.',
                    'image' => 'img-'.rand(10, 1000).'.jpg',
                    'status' => 1
                ]);
            }
            $user = new User();
            $result = $user->userNews();
            dd($result);
        } else {
            dd(['No Users Found to create news.']);
        }
        $this->assertTrue(true);
    }

    /**
     * Test Method to delete an user and their news.
     *
     * @return void
     */
    public function testDeleteSingleUser()
    {
        $user = User::orderBy('id', 'desc')->first();
        if(!empty($user)){
            $userObj = new User();
            $result = $userObj->deleteUserById($user['id']);
            dd($result);
        } else {
            dd(['No User Found to Delete.']);
        }
        $this->assertTrue(true);
    }

    /**
     * Test Method to delete All users and their news.
     *
     * @return void
     */
    public function testDeleteAllUser()
    {
        $users = User::get();
        if(!empty($users)){
            foreach($users as $value){
                $value->delete();
            }
            dd(['Users deleted successfully.']);
        } else {
            dd(['No Users Found to Delete.']);
        }
        $this->assertTrue(true);
    }
}
