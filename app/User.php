<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\PHPMailer;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_verified', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
     * Method to register new user
     */
    public function register($request){
        try {
            $array = [
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'is_verified' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $user = $this->create($array);
            $login = Auth::attempt(['email' => $request['email'], 'password' => $request['password']]);
            return collect([
                'status' => 'success',
                'data' => $user
            ]);
        } catch(\Exception $e){
            return collect([
                'status' => 'failure',
                'message' => $e->getMessage()
            ]);
        }
    }

    /*
     * Method to get User News
     */
    public function userNews(){
        $user = self::with('News')->get()->toArray();
        return $user;
    }

    /*
     * Method to delete user by id
     */
    public function deleteUserById($id){
        $deleteUser = self::destroy($id);
        return $deleteUser;
    }

    public function News(){
        return $this->hasMany('App\News', 'user_id', 'id');
    }

    /**
     * Method to send email.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendEmail($email,$html,$subject)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME1');
            $mail->Password = env('MAIL_PASSWORD1');
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            //Recipients
            $mail->setFrom(env('MAIL_USERNAME1'), 'Mailer');
            $mail->addAddress($email);

            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $html;
            $mail->send();
            return ['success' => 'Email sent.'];
        } catch (Exception $e) {
            return ['error' => 'Message could not be sent.'];
        }
    }
}
