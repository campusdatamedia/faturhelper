<?php

/**
 * @method static void login()
 */

namespace Ajifatur\Helpers;

use Illuminate\Support\Facades\Route;

class RouteExt
{
    /**
     * The default namespace.
     *
     * @var string
     */
    protected const NAMESPACE = '\Ajifatur\FaturHelper\Http\Controllers';

    /**
     * Set the login route.
     *
     * @return void
     */
    public static function login()
    {
        Route::group(['middleware' => ['guest']], function() {
            Route::get('/login', self::NAMESPACE.'\Auth\LoginController@show')->name('auth.login');
            Route::post('/login', self::NAMESPACE.'\Auth\LoginController@authenticate');
        });
    }

    /**
     * Set the logout route.
     *
     * @return void
     */
    public static function logout()
    {
        Route::group(['middleware' => ['guest']], function() {
            Route::post('/logout', self::NAMESPACE.'\Auth\LoginController@logout')->name('logout');
        });

        Route::group(['middleware' => ['admin']], function() {
            Route::post('/admin/logout', self::NAMESPACE.'\Auth\LoginController@logout')->name('admin.logout');
        });
    }

    /**
     * Set the dashboard route.
     *
     * @return void
     */
    public static function dashboard()
    {
        Route::group(['middleware' => ['admin']], function() {
            Route::get('/admin', self::NAMESPACE.'\DashboardController@index')->name('admin.dashboard');
        });
    }

    /**
     * Set the user profile and settings route.
     *
     * @return void
     */
    public static function user()
    {
        Route::group(['middleware' => ['admin']], function() {
            Route::get('/admin/profile', self::NAMESPACE.'\UserSettingController@index')->name('admin.profile');
            Route::get('/admin/settings/profile', self::NAMESPACE.'\UserSettingController@profile')->name('admin.settings.profile');
            Route::post('/admin/settings/profile/update', self::NAMESPACE.'\UserSettingController@updateProfile')->name('admin.settings.profile.update');
            Route::get('/admin/settings/account', self::NAMESPACE.'\UserSettingController@account')->name('admin.settings.account');
            Route::post('/admin/settings/account/update', self::NAMESPACE.'\UserSettingController@updateAccount')->name('admin.settings.account.update');
            Route::get('/admin/settings/password', self::NAMESPACE.'\UserSettingController@password')->name('admin.settings.password');
            Route::post('/admin/settings/password/update', self::NAMESPACE.'\UserSettingController@updatePassword')->name('admin.settings.password.update');
        });
    }
}