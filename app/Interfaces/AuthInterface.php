<?php

namespace App\Interfaces;

interface AuthInterface
{
    public function login(array $credentials);
    public function logout();
    public function register(array $data);
    public function getUser();
}
