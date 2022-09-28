<?php

namespace App\controllers;
use League\Plates\Engine;
use App\clasess\builder\QueryBuilder;
use JasonGrimes\Paginator;
use Delight\Auth\Auth;
use PDO;



class pageControllers{
    private $templates;
    private $db;
    private $auth;
    const viewDir = "../view/";
    const itemsPerPage = 5;

    public function __construct()
    {
        $this->templates = new Engine('../app/templates');
        $this->db = new QueryBuilder();
        $this->auth = new Auth(new PDO('mysql:host=localhost;dbname=simple;charset=utf8', "root", ""));


    }

    public function index(){
        $this->isLogined();
        $table = "tasks";
        $_SESSION['last_page'] = 1;
        $pagination = $this->pageCount($table, self::itemsPerPage, 1,'/page/(:num)');
        $posts = $this->db->getAllLimit($table, $pagination['itemsPerPage'], $pagination['offset'], $this->auth->getUserId());
        $data = [
            'posts' => $posts,
            'paginator' => $pagination['paginator'],
            'login' => $this->auth->getUsername()
        ];
        echo $this->templates->render(self::viewDir . 'main', $data);
    }
    public function page($vars){
        $this->isLogined();
        $table = "tasks";
        $_SESSION['last_page'] = $vars['id'];
        $pagination = $this->pageCount($table, self::itemsPerPage, $vars['id'],'(:num)');
        $posts = $this->db->getAllLimit($table, $pagination['itemsPerPage'], $pagination['offset'], $this->auth->getUserId());
        echo $this->templates->render(self::viewDir . 'main', ['posts' => $posts, 'paginator' => $pagination['paginator'], 'login' => $this->auth->getUsername()]);
    }
    public function add(){
        $this->isLogined();
        echo $this->templates->render(self::viewDir . 'add', ['login' => $this->auth->getUsername()]);
    }
    public function registerPage(){
        echo $this->templates->render(self::viewDir . 'register-page');
    }
    public function authPage(){
        echo $this->templates->render(self::viewDir . 'auth-page');
    }
    public function about(){
        $this->isLogined();
        echo $this->templates->render(self::viewDir . 'about', ['login' => $this->auth->getUsername()]);
    }
    public function user_page(){
        $this->isLogined();

        $data = [
            'login' => $this->auth->getUsername(),
            'user_id' => $this->auth->getUserId()
        ];
        echo $this->templates->render(self::viewDir . 'user-page', $data);
    }


    public function view($vars){
        $this->isLogined();
        $result = $this->db->getOneById('tasks', $vars['id']);
        echo $this->templates->render(self::viewDir . 'view', ['result' => $result, 'login' => $this->auth->getUsername()]);
    }


    #post handler && functions to work with
    private function isLogined(){
        if(!$this->auth->check()){
            header("Location: /auth");exit;
        }


    }
    public function pageCount($table, $itemsPerPage, $currentPage,$urlPattern){
        $count = $this->db->getCount($table);
        $totalItems = $count['COUNT(*)'];
        $offset = $itemsPerPage*$currentPage - 5;
        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
        return ['paginator' => $paginator, 'itemsPerPage' => $itemsPerPage, 'offset'=>$offset];
    }
    public function delete($vars){
        $table = "tasks";
        $this->db->delete($table, $vars['id']);
        if (isset($_SESSION['last_page'])){
            flash()->success("Запись удалена!");
            header("Location: /page/{$_SESSION['last_page']}");
        }
    }
    public function store(){
        if (isset($_POST['send'])){
            if($_POST['title'] == "" || $_POST['text'] == ""){
                flash()->error("Заполните все поля!");
                header("Location: /add");exit;
            }
            $data = [
                'title' => $_POST['title'],
                'text' => $_POST['text'],
                'user_id' => $this->auth->getUserId()
            ];
        }
        $id = $this->db->add("tasks", $data);
        flash()->success("Запись добавлена!");

        header("Location: /view/{$id}");
    }
    public function edit($vars){
        $this->isLogined();
        $result = $this->db->getOneById('tasks', $vars['id']);
        echo $this->templates->render(self::viewDir . 'edit', ['post' => $result, 'login' => $this->auth->getUsername()]);
    }
    public function update(){
        if (isset($_POST['send'])){
            $id = $_POST['id'];
            if($_POST['title'] == "" || $_POST['text'] == ""){
                flash()->error("Заполните все поля!");
                header("Location: /edit/{$id}");exit;
            }
            $data = [
                'title' => $_POST['title'],
                'text' => $_POST['text']
            ];
        }
        $this->db->update("tasks",$id, $data);
        flash()->success("Запись обновлена!");
        header("Location: /view/{$id}");
    }
    public function create_user(){
        try {
            $userId = $this->auth->registerWithUniqueUsername($_POST['email'], $_POST['password'], $_POST['username']);
            flash()->success("Регистрация прошла успешна! Войдите в свой аккаунт!");
            header("Location: /auth");exit;
        }catch (\Delight\Auth\DuplicateUsernameException $e) {
            flash()->error("Такой логин уже существует!");
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            flash()->error("Почта занята!");
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            flash()->error("Неверный пароль!");
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            flash()->error("Пользователь существует!");
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        }
        header("Location: /register");exit;
    }
    public function log_in(){
        try {
            $this->auth->login($_POST['email'], $_POST['password']);
            flash()->success("Добро пожаловать");
            header("Location: /");exit;
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            flash()->error("Пользователь с указанной почтой не зарегистрирован!!");
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            flash()->error("Ошибка пароля!");
        }
        catch (\Delight\Auth\EmailNotVerifiedException $e) {
            die('Email not verified');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        }
        header("Location: /auth");exit;
    }
    public function logout(){

        $this->auth->logOut();
        $this->isLogined();


    }

}