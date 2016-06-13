<?php
namespace App\Controllers;
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
        $session = new Session(new File(STORAGE_PATH . '/session'));
        $session->set("age",json_encode($this->test()));
        $name = $session->get('age');
        var_dump($_SESSION);

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
    public function testSql()
    {
        DB::schema()->create('users', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('recommend_id');
            $table->string('username', 40)->unique();
            $table->string('mobile', 11)->unique();
            $table->string('nickname', 40);
            $table->string('signature', 100);
            $table->string('password', 60);
            $table->string('wechat_token', 200)->unique();
            $table->string('qq_token', 200)->unique();
            $table->string('weibo_token', 200)->unique();
            $table->smallInteger('avatar_status');
            $table->smallInteger('group_id');
            $table->smallInteger('status');//�û�״̬ 0���� 1���� 2������
            $table->ipAddress('reg_ip');
            $table->integer('vip');
            $table->timestamp('vip_due_time');
            $table->ipAddress('reg_source');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::schema()->create('user_profile', function(Blueprint $table)
        {
            $table->bigInteger('uid')->primary();
            $table->smallInteger('gender');
            $table->timestamp('birthday');
            $table->string('idcard_type');
            $table->string('idcard');
            $table->string('address');
            $table->string('affective_status', 5);//���״̬
            $table->smallInteger('occupation'); //ְҵ
            $table->smallInteger('birth_province');
            $table->smallInteger('birth_city');
            $table->smallInteger('reside_city');
            $table->smallInteger('birth_dist');
            $table->json('location'); //�û�����λ��γ��`����`����
            $table->string('site', 100);
        });
        DB::schema()->create('user_account', function(Blueprint $table)
        {
            $table->bigInteger('uid')->primary();
            $table->smallInteger('action');
            $table->bigInteger('video');
            $table->bigInteger('post');//����
            $table->bigInteger('weibo');
            $table->bigInteger('danma');
            $table->bigInteger('comment');
            $table->bigInteger('follow');
            $table->bigInteger('fan');
            $table->bigInteger('score');//���ֿ��ø�UP��ת�� ����ת�����֮������
            $table->bigInteger('favorite');
            $table->integer('level');
            $table->bigInteger('like');
            $table->bigInteger('hate');
            $table->bigInteger('reward');
            $table->decimal('charge_money', 15, 6);
            $table->decimal('frozen_money', 15, 6);//�����ʽ�
            $table->decimal('reward_money', 15, 6);
        });
        DB::schema()->create('user_log_action', function(Blueprint $table)
        {
            $table->bigInteger('uid')->primary();
            $table->smallInteger('action')->index(); //follow,fan,favorite_video,like_video,hate_video,reward_video charge
            $table->bigInteger('relation_id')->index();
            $table->decimal('affect_money'); //�����
            $table->string('source');//��Դ
            $table->string('uuid', 100);  //�ͻ���Ψһ��ʶ
            $table->string('agent', 200);
            $table->ipAddress('ip');
            $table->timestamps();
        });
        DB::schema()->create('videos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('uid')->index();
            $table->boolean('is_anonymous'); //����
            $table->smallInteger('type');
            $table->string('title', 200)->index();
            $table->longText('content');
            $table->string('url', 200);
            $table->string('time', 10);
            $table->string('img', 100);
            $table->smallInteger('status');
            $table->smallInteger('admin_status');
            $table->string('password', 60);
            $table->bigInteger('coin');
            $table->bigInteger('views');
            $table->bigInteger('favorites');
            $table->bigInteger('danma');
            $table->bigInteger('reward');
            $table->bigInteger('like');
            $table->bigInteger('hate');
            $table->smallInteger('comment_status');
            $table->bigInteger('comment');
            $table->string('agent', 200);
            $table->ipAddress('ip');
            $table->timestamps();
        });
        DB::schema()->create('posts', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('uid')->index();
            $table->boolean('is_anonymous'); //����
            $table->smallInteger('type');
            $table->string('title', 200)->index();
            $table->longText('content');
            $table->string('img', 100);
            $table->smallInteger('status');
            $table->smallInteger('admin_status');
            $table->string('password', 60);
            $table->bigInteger('views');
            $table->bigInteger('favorites');
            $table->bigInteger('reward');
            $table->bigInteger('like');
            $table->bigInteger('hate');
            $table->smallInteger('comment_status');
            $table->bigInteger('comment');
            $table->string('location', 60);
            $table->string('agent', 200);
            $table->ipAddress('ip');
            $table->timestamps();
        });
        DB::schema()->create('danmas', function(Blueprint $table)
        {
            $table->increments('id');
            $table->bigInteger('video_id')->index();
            $table->bigInteger('uid')->index();
            $table->json('info');
            $table->text('text');
            $table->timestamps();
        });
        DB::schema()->create('comments', function(Blueprint $table)
        {
            $table->increments('id');
            $table->bigInteger('post_id')->index();
            $table->bigInteger('uid')->index();
            $table->smallInteger('is_anonymous'); //����
            $table->text('text');
            $table->smallInteger('status');
            $table->longText('parent');
            $table->smallInteger('type');
            $table->string('agent', 200);
            $table->ipAddress('ip');
            $table->timestamps();
        });
        DB::schema()->create('tags', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 60);
            $table->string('img', 100);
            $table->text('description');
            $table->bigInteger('count');
        });
        DB::schema()->create('categorys', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('img', 100);
            $table->smallInteger('type');//��Ƶ���� /���·��� /������� /Ⱥ�����
            $table->bigInteger('parent');
            $table->text('description');
            $table->bigInteger('count');
        });
        DB::schema()->create('relationships', function(Blueprint $table)
        {
            $table->bigInteger('object_id')->index();//����ID
            $table->smallInteger('type');//0 tag 1 category
            $table->bigInteger('taxonomy_id')->index(); //��ϵID  ��post_id
        });

        DB::schema()->create('send_sms', function(Blueprint $table)
        {
            $table->increments('id');
            $table->bigInteger('uid')->index();
            $table->string('mobile', 11);
            $table->string('email', 40);
            $table->string('info');
            $table->string('source');
            $table->string('agent', 200);
            $table->ipAddress('ip');
            $table->timestamps();
        });
        DB::schema()->create('reports', function(Blueprint $table)
        {
            $table->increments('id');
            $table->bigInteger('uid')->index();
            $table->smallInteger('type');
            $table->smallInteger('progress');
            $table->bigInteger('relation_id');
            $table->bigInteger('reported_uid');
            $table->string('info');
            $table->ipAddress('ip');
            $table->timestamps();
        });
        DB::schema()->create('options', function(Blueprint $table)
        {
            $table->string('key', 32)->primary();
            $table->string('value');
            $table->smallInteger('status');
        });
        DB::schema()->create('user_pay', function(Blueprint $table)
        {
            $table->increments('id');
            $table->bigInteger('uid')->index();
            $table->smallInteger('status');//֧��״̬  0|δ֧����1|��ֵ�ɹ���2|ǩ������ȷ��3|��ֵʧ��
            $table->string('billno', 50)->index();
            $table->string('tran_id', 50)->index();
            $table->decimal('money', 15,6);
            $table->timestamp('notify_time');
            $table->smallInteger('source');
            $table->smallInteger('off_type'); //0|ǰ̨��ֵ��1|��̨����
            $table->string('off_certificate'); //����ƾ֤
            $table->string('info');
            $table->ipAddress('ip');
            $table->string('uuid', 100);  //�ͻ���Ψһ��ʶ
            $table->timestamps();
        });
        DB::schema()->create('user_log_moeny', function(Blueprint $table)
        {
            $table->increments('id');
            $table->bigInteger('uid')->index();
            $table->smallInteger('type');
            $table->string('billno', 50)->index();
            $table->decimal('affect_money', 15, 6);//Ӱ���ʽ�
            $table->decimal('charge_money', 15, 6);//��ֵ���ý��
            $table->decimal('frozen_money', 15, 6);//�����ʽ�
            $table->decimal('reward_money', 15, 6);//�������
            $table->bigInteger('relation_id');
            $table->string('info');
            $table->ipAddress('ip');
            $table->string('uuid', 100);  //�ͻ���Ψһ��ʶ
            $table->timestamp('create_time');
        });
        DB::schema()->create('orders', function(Blueprint $table)
        {
            $table->increments('id');
            $table->bigInteger('uid')->index();
            $table->bigInteger('action_id')->index();
            $table->string('order_sn', 20)->index();
            $table->smallInteger('order_status'); //����״̬��0��δȷ�ϣ�1����ȷ�ϣ�2����ȡ����3����Ч��4���˻���5������ɣ�
            $table->smallInteger('pay_status');//֧��״̬��0��δ���1�������У�2���Ѹ���',
            $table->decimal('goods_amount', 12, 2);//�������
            $table->decimal('charge_money', 12, 2);//����ʹ�ó�ֵ�ʽ�ؽ��
            $table->decimal('pay_money', 12, 2);//����֧�����
            $table->decimal('reward_moeny', 12, 2);//����ʹ�ý������
            $table->smallInteger('pay_id')->index(); //֧������user_pay���ID
            $table->timestamp('confirm_time'); //����ȷ��ʱ��
            $table->string('uuid', 100);  //�ͻ���Ψһ��ʶ
            $table->string('agent', 200);
            $table->ipAddress('ip');
            $table->timestamps();
        });
//drop table mn_categorys,mn_comments,mn_danmas,mn_options,mn_orders,mn_posts,mn_relationships,mn_reports,mn_send_sms,
//mn_tags,mn_user_account,mn_user_log_action,mn_user_log_moeny,mn_user_pay,mn_user_profile,mn_users,mn_videos;
    }



}