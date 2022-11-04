<?php

namespace App\Models;

use App\DBModel;

class User extends DBModel
{
    public string $email;
    public string $firstname;
    public string $lastname;
    public string $password;
    public string $password_confirmation;

    public function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return ['email', 'firstname', 'lastname', 'password'];
    }

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 20]],
            'password_confirmation' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function labels(): array
    {
        return [
            'email' => 'Email',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'password' => 'Password',
            'password_confirmation' => 'Password Confirm',
        ];
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }
}
