<?php
namespace App\Models;
  
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

use Laravel\Sanctum\HasApiTokens;
use Exception;
use Mail;
use App\Mail\SendCodeMail;
use App\Mail\Welcome;

use Illuminate\Database\Eloquent\SoftDeletes;

  
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
  
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
  
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function generateCode()
    {
        $code = rand(100000, 999999);
  
        UserCode::updateOrCreate(
            [ 'user_id' => auth()->user()->id ],
            [ 'code' => $code ]
        );
    
        try {
  
            $details = [
                'title' => 'Data Management System',
                'code' => $code
            ];
             
            mail::to(auth()->user()->email)->send(new SendCodeMail($details));
    
        } catch (Exception $e) {
            info("Error: ". $e->getMessage());
        }
    }

    /**
     * Send welcome email with login details
     *
     * @return response()
     */
    public function sendWelcomeDetails($user)
    {
        try {
  
            $details = [
                'title' => 'Data Management System',
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
            ];
             
            mail::to($user['email'])->send(new Welcome($details));

        } catch (Exception $e) {
            info("Error: ". $e->getMessage());
            echo "email not sent: ".$e->getMessage();
            exit();
        }
    }
}