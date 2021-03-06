<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
 

class UserActivation extends Model
{
    protected $table = 'user_activations';

    protected function getToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    public function createActivation($user)
    {
        // Lay thong tin kich hoat nguoi dung trong bang user_activations
        $activation = $this->getActivation($user);

        // Neu khong co, tao token nguoi dung moi (nguoi dung lan dau)
        if (!$activation) {
            return $this->createToken($user);
        }

        // Neu co, gan cho nguoi dung mot token moi (nguoi dung da dang ki nhung chua kich hoat token trong email)
        return $this->regenerateToken($user);
    }

    private function regenerateToken($user)
    {

        $token = $this->getToken();
        UserActivation::where('user_id', $user->id)->update([
            'token' => $token,
            'created_at' => new Carbon()
        ]);
        return $token;
    }

    private function createToken($user)
    {
        $token = $this->getToken();
        UserActivation::insert([
            'user_id' => $user->id,
            'token' => $token,
            'created_at' => new Carbon()
        ]);
        return $token;
    }

    public function getActivation($user)
    {
        return UserActivation::where('user_id', $user->id)->first();
    }

    public function getActivationByToken($token)
    {
        return UserActivation::where('token', $token)->first();
    }

    public function deleteActivation($token)
    {
        UserActivation::where('token', $token)->delete();
    }
}
