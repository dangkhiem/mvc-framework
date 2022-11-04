<?php

namespace App\Models;

use App\Model;

class LoginForm extends Model
{
    public string $email;
    public string $password;

    /**
     * Rules validation
     * 
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => [
                self::RULE_REQUIRED,
                self::RULE_EMAIL,
            ],
            'password' => [
                self::RULE_REQUIRED,
                [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 20],
            ],
        ];
    }

    public function labels(): array
    {
        return [
            'email' => 'Your Email',
            'password' => 'Your Password',
        ];
    }

    public function login()
    {
        return false;
        $user = User::findOne(['email' => $this->email]);

        if (!$user) {
            $this->addError('email', 'Email doesn not exists');
            return false;
        }
        $passwordHash = $user['password'];
        if (!password_verify($this->password, $passwordHash)) {
            $this->addError('password', 'Password does not correct');
            return false;
        }
        return false;
    }
}
