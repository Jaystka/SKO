<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('login', function () {
    return view('session/loginuser');
});
Route::get('register', function () {
    return view('session/registeruser');
});
Route::get('blog', function () {
    return view('blog');
});
Route::get('ourstory', function () {
    return view('ourstory');
});
Route::get('profile', function () {
    return view('profile/profileuser');
});
Route::get('editprofile', function () {
    return view('profile/editprofileuser');
});
