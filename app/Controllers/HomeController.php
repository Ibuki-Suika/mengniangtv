<?php
namespace App\Controllers;
use App\Video;
use Clovers\Session\Session;
use Clovers\Session\Storage\File;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as DB;

class HomeController extends BaseController
{
    public function index()
    {
//        $users = User::find(2);
//        $users = User::all();
//        $user = new User;
//        $user->username = 'someone';
//        $user->email = 'some@overtrue.me';
//        $user->save();
//        $session = new Session(new File(STORAGE_PATH . '/session'));
//        $session->set("age",json_encode($this->test()));
//        $name = $session->get('age');
//        var_dump($_SESSION);
        // ��ѯidΪ2��
        $video = Video::all();
        var_dump($video);
//
//// ��ѯȫ��
//        $users = User::all();
//
//// ��������
//        $user = new User;
//        $user->username = 'someone';
//        $user->email = 'some@overtrue.me';
//        $user->save();

    }
    private function test()
    {
        return [
            'app_key'   =>"test2222key",
            'app_secret'=>"testsercret",
                'images'    =>[
                    'file'  =>'@/Users/donghai/Desktop/clover500.png'
                ]
        ];
    }



}