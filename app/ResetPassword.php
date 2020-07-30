<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Carbon\Carbon;

class ResetPassword extends Model
{
    protected $table = 'password_resets';
    public $timestamps = false;

    public function getToken($email) 
    {
        return bcrypt(md5(time().$email));
    }

    public function createResetPassword($email)
    {
        // Lay thong tin email quen mat khau
        $reset = $this->getResetPassword($email);

        // Neu email khong ton tai trong bang password_resets thi tao mot ban ghi moi va tra ve ban ghi do
        if (!$reset) {
            return $this->createToken($email);
        }
        // Neu da ton tai trong bang thi update
        return $this->updateToken($email);
    }

    // Tao ra ban ghi trong bang password_resets khi nguoi dung lan dau quen mat khau
    public function createToken($email)
    {
        $token = $this->getToken($email);
        ResetPassword::insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        return $token;
    }

    // Tra ve ban ghi co email tuong ung
    public function getResetPassword($email)
    {
        return ResetPassword::where('email', $email)->first();
    }

    // Tra ve ban ghi co token tuong ung
    public function getResetPasswordByToken($token)
    {
        return ResetPassword::where('token', $token)->first();
    }
    
    // Update ban ghi khi da ton tai email, token trong bang password_resets
    public function updateToken($email) 
    {
        $token = $this->getToken($email);
        ResetPassword::where('email', $email)->update([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);
        return $token;
    }
}
