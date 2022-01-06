<?php

/**
 * @method static void auth()
 * @method static void admin()
 * @method static void login()
 * @method static void logout()
 * @method static void dashboard()
 * @method static void user()
 * @method static void menu()
 * @method static void roles()
 * @method static void permissions()
 * @method static void systems()
 * @method static void api()
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
    const NAMESPACE = '\Ajifatur\FaturHelper\Http\Controllers';

    /**
     * Group the auth route.
     *
     * @return void
     */
    public static function auth()
    {
        self::login();
        self::logout();
    }

    /**
     * Group the admin route.
     *
     * @return void
     */
    public static function admin()
    {
        self::dashboard();
        self::user();
        self::menu();
        self::roles();
        self::permissions();
        self::systems();
    }

    /**
     * Set the login route.
     *
     * @return void
     */
    public static function login()
    {
        Route::group(['middleware' => ['faturhelper.guest']], function() {
            // Login
            Route::get('/login', self::NAMESPACE.'\Auth\LoginController@show')->name('auth.login');
            Route::post('/login', self::NAMESPACE.'\Auth\LoginController@authenticate');

            // Login via (Socialite)
            if(config('faturhelper.auth.socialite') === true) {
                Route::get('/auth/{provider}', self::NAMESPACE.'\Auth\LoginController@redirectToProvider')->name('auth.login.provider');
                Route::get('/auth/{provider}/callback', self::NAMESPACE.'\Auth\LoginController@handleProviderCallback')->name('auth.login.provider.callback');
            }
        });
    }

    /**
     * Set the logout route.
     *
     * @return void
     */
    public static function logout()
    {
        Route::group(['middleware' => ['faturhelper.nonadmin']], function() {
            Route::post('/logout', self::NAMESPACE.'\Auth\LoginController@logout')->name('auth.logout');
        });

        Route::group(['middleware' => ['faturhelper.admin']], function() {
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
        Route::group(['middleware' => ['faturhelper.admin']], function() {
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
        Route::group(['middleware' => ['faturhelper.admin']], function() {
            Route::get('/admin/profile', self::NAMESPACE.'\UserSettingController@index')->name('admin.profile');
            Route::get('/admin/settings/profile', self::NAMESPACE.'\UserSettingController@profile')->name('admin.settings.profile');
            Route::post('/admin/settings/profile/update', self::NAMESPACE.'\UserSettingController@updateProfile')->name('admin.settings.profile.update');
            Route::get('/admin/settings/account', self::NAMESPACE.'\UserSettingController@account')->name('admin.settings.account');
            Route::post('/admin/settings/account/update', self::NAMESPACE.'\UserSettingController@updateAccount')->name('admin.settings.account.update');
            Route::get('/admin/settings/password', self::NAMESPACE.'\UserSettingController@password')->name('admin.settings.password');
            Route::post('/admin/settings/password/update', self::NAMESPACE.'\UserSettingController@updatePassword')->name('admin.settings.password.update');
        });
    }

    /**
     * Set the menu route.
     *
     * @return void
     */
    public static function menu()
    {
        Route::group(['middleware' => ['faturhelper.admin']], function() {
            // Menu
            Route::get('/admin/menu', self::NAMESPACE.'\MenuController@index')->name('admin.menu.index');

            // Menu Header
            Route::get('/admin/menu/header/create', self::NAMESPACE.'\MenuHeaderController@create')->name('admin.menu.header.create');
            Route::post('/admin/menu/header/store', self::NAMESPACE.'\MenuHeaderController@store')->name('admin.menu.header.store');
            Route::get('/admin/menu/header/edit/{id}', self::NAMESPACE.'\MenuHeaderController@edit')->name('admin.menu.header.edit');
            Route::post('/admin/menu/header/update', self::NAMESPACE.'\MenuHeaderController@update')->name('admin.menu.header.update');
            Route::post('/admin/menu/header/delete', self::NAMESPACE.'\MenuHeaderController@delete')->name('admin.menu.header.delete');
            Route::post('/admin/menu/header/sort', self::NAMESPACE.'\MenuHeaderController@sort')->name('admin.menu.header.sort');

            // Menu Item
            Route::get('/admin/menu/item/create/{header_id}', self::NAMESPACE.'\MenuItemController@create')->name('admin.menu.item.create');
            Route::post('/admin/menu/item/store', self::NAMESPACE.'\MenuItemController@store')->name('admin.menu.item.store');
            Route::get('/admin/menu/item/edit/{header_id}/{item_id}', self::NAMESPACE.'\MenuItemController@edit')->name('admin.menu.item.edit');
            Route::post('/admin/menu/item/update', self::NAMESPACE.'\MenuItemController@update')->name('admin.menu.item.update');
            Route::post('/admin/menu/item/delete', self::NAMESPACE.'\MenuItemController@delete')->name('admin.menu.item.delete');
            Route::post('/admin/menu/item/sort', self::NAMESPACE.'\MenuItemController@sort')->name('admin.menu.item.sort');
        });
    }

    /**
     * Set the roles route.
     *
     * @return void
     */
    public static function roles()
    {
        Route::group(['middleware' => ['faturhelper.admin']], function() {
            Route::get('/admin/role', self::NAMESPACE.'\RoleController@index')->name('admin.role.index');
            Route::get('/admin/role/create', self::NAMESPACE.'\RoleController@create')->name('admin.role.create');
            Route::post('/admin/role/store', self::NAMESPACE.'\RoleController@store')->name('admin.role.store');
            Route::get('/admin/role/edit/{id}', self::NAMESPACE.'\RoleController@edit')->name('admin.role.edit');
            Route::post('/admin/role/update', self::NAMESPACE.'\RoleController@update')->name('admin.role.update');
            Route::post('/admin/role/delete', self::NAMESPACE.'\RoleController@delete')->name('admin.role.delete');
            Route::post('/admin/role/sort', self::NAMESPACE.'\RoleController@sort')->name('admin.role.sort');
        });
    }

    /**
     * Set the permissions route.
     *
     * @return void
     */
    public static function permissions()
    {
        Route::group(['middleware' => ['faturhelper.admin']], function() {
            Route::get('/admin/permission', self::NAMESPACE.'\PermissionController@index')->name('admin.permission.index');
            Route::get('/admin/permission/create', self::NAMESPACE.'\PermissionController@create')->name('admin.permission.create');
            Route::post('/admin/permission/store', self::NAMESPACE.'\PermissionController@store')->name('admin.permission.store');
            Route::get('/admin/permission/edit/{id}', self::NAMESPACE.'\PermissionController@edit')->name('admin.permission.edit');
            Route::post('/admin/permission/update', self::NAMESPACE.'\PermissionController@update')->name('admin.permission.update');
            Route::post('/admin/permission/delete', self::NAMESPACE.'\PermissionController@delete')->name('admin.permission.delete');
            Route::post('/admin/permission/sort', self::NAMESPACE.'\PermissionController@sort')->name('admin.permission.sort');
            Route::post('/admin/permission/change', self::NAMESPACE.'\PermissionController@change')->name('admin.permission.change');
        });
    }

    /**
     * Set the systems route.
     *
     * @return void
     */
    public static function systems()
    {
        Route::group(['middleware' => ['faturhelper.admin']], function() {
            Route::get('/admin/system', self::NAMESPACE.'\SystemController@index')->name('admin.system.index');
        });
    }

    /**
     * Set the API route.
     *
     * @return void
     */
    public static function api()
    {
        // Update the system
        Route::post('/system/update', self::NAMESPACE.'\SystemController@update')->name('api.system.update');

        // Bootstrap Icons
        Route::get('/dataset/bootstrap-icons', function() {
            return response()->json(bootstrap_icons(), 200);
        })->name('api.bootstrap-icons');

        // Country Code
        Route::get('/dataset/country-code', function() {
            return response()->json(country(), 200);
        })->name('api.country-code');
    }
}