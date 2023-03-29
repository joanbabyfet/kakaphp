<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('ping', 'ctl_common@ping')->name('adminag.common.ping');
Route::get('ip', 'ctl_common@ip')->name('adminag.common.ip');
Route::post('login', 'ctl_index@login')->name('adminag.index.login');
Route::get('get_captcha', 'ctl_common@get_captcha')->name('adminag.common.get_captcha');
Route::get('reload_captcha', 'ctl_common@reload_captcha')->name('adminag.common.reload_captcha');

//目前改用jwt_auth
Route::group(['middleware' => ['assign_guard:agent', 'jwt_auth:agent', 'safe_ips']], function() {
    //Route::get('/', 'ctl_index@index')->name('adminag.index.index'); //首页
    //Route::get('test', 'ctl_test@index')->name('adminag.test.index');
    Route::post('logout', 'ctl_index@logout')->name('adminag.index.logout'); //退出
    Route::get('userinfo', 'ctl_index@detail')->name('adminag.index.detail'); //用户信息
    Route::post('edit_pwd', 'ctl_index@edit_pwd')->name('adminag.index.edit_pwd'); //修改用户密码
    Route::get('get_menu', 'ctl_index@get_menu')->name('adminag.index.get_menu');
    Route::get('get_role_options', 'ctl_common@get_role_options')->name('adminag.common.get_role_options');
    Route::get('get_user_options', 'ctl_common@get_user_options')->name('adminag.common.get_user_options');
    Route::post('upload', 'ctl_upload@upload')->name('adminag.upload.upload');

    Route::group(['middleware' => ['permission:agent']], function (){
        Route::get('user', 'ctl_user@index')->name('adminag.user.index');
        //Route::get('user/detail', 'ctl_user@detail')->name('adminag.user.detail');
        //Route::post('user/add', 'ctl_user@add')->name('adminag.user.add');
        Route::post('user/enable', 'ctl_user@enable')->name('adminag.user.enable');
        Route::post('user/disable', 'ctl_user@disable')->name('adminag.user.disable');
        Route::get('user/login_log', 'ctl_user@login_log')->name('adminag.user.login_log');
        Route::get('user_black_list', 'ctl_user@black_list')->name('adminag.user.black_list');
        Route::get('member_active_list', 'ctl_report@member_active_list')->name('adminag.report.member_active_list');
        //Route::get('member_active_list/export', 'ctl_report@export_member_active')->name('adminag.report.export_member_active');
        Route::get('member_retention_list', 'ctl_report@member_retention_list')->name('adminag.report.member_retention_list');
        Route::get('member_increase_list', 'ctl_report@member_increase_list')->name('adminag.report.member_increase_list');
        Route::get('member_online_list', 'ctl_report@member_online_list')->name('adminag.report.member_online_list');
        Route::get('member_online_list/export', 'ctl_report@export_member_online')->name('adminag.report.export_member_online');
        Route::get('agent', 'ctl_agent@index')->name('adminag.agent.index');
        Route::get('agent/detail', 'ctl_agent@detail')->name('adminag.agent.detail');
        Route::post('agent/add', 'ctl_agent@add')->name('adminag.agent.add');
        Route::post('agent/edit', 'ctl_agent@edit')->name('adminag.agent.edit');
        Route::post('agent/delete', 'ctl_agent@delete')->name('adminag.agent.delete');
        Route::post('agent/enable', 'ctl_agent@enable')->name('adminag.agent.enable');
        Route::post('agent/disable', 'ctl_agent@disable')->name('adminag.agent.disable');
    });
});
