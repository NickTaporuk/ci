<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Znakomster extends CI_Controller {

    public function index()
    {
        $this->load->view('znakomster/index');
    }

    public function about($id = 0)
    {
        $arr =[
            'name'  => 'NickTaporuk',
            'git'   => '1.9.1',
            'id'    => $id,
        ];
        $this->load->view('znakomster/aboute_view',$arr);
    }

    public function users() {
//        $db     = mysqli_connect('localhost','root','root','localhost');
//        $sql    = 'SELECT * FROM users';
//        $result = mysqli_query($db,$sql);
//        var_dump($result);
//            $users = mysql_fetch_all($result,MYSQL_ASSOC);
//        var_dump($users);
//        foreach($users as $user){
//            var_dump($user);
//        }
//        $users   = mysql_fetch_assoc($result);
//        var_dump($users);
//        var_dump($this->load);
        //db
//         $db = new PDO('mysql:host=127.0.0.1;port=3306;dbname=localhost','root','root');
//        user detail
//            $users = $db->prepare('SELECT * FROM users where id = :user_id');
//            $users->execute(['user_id'=>1]);
//            $res = $users->fetchObject();
//            var_dump($res);


//        $data = $this->load->model('users_model');
        $this->load->model('users_model');
        $data = [
            'name'  => 'test1',
            'email' => 'test1@test1.ru',
            'passw' => md5('111'),
            'last_tc'   => time(),
            'activate'  => time(),
        ];
        $this->users_model->insert_user($data);
//            var_dump($data);
//        error_log('[DEBUG]:'.print_r($res),1,'nictaporuk@yandex.ru');

//        error_log('[DEBUG]:'.print_r($res));

//        var_dump($this->users_model->get_users());
        $this->load->view('znakomster/users_view');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */