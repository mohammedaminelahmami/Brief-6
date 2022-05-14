<?php
    class UserController extends Controller{

        public function __construct()
        {
            $this->userModel = $this->model('User');
        }

        public function register()
        {
            // empty field
            if(empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['age']))
            {
                echo json_encode("Fields are required !");
            }

            // RegEx
            if(!preg_match("/^[a-zA-Z-' ]*$/", $_POST['nom']))
            {
                echo json_encode("please enter correct 'nom' ");
            }
            elseif(!preg_match("/^[a-zA-Z-' ]*$/", $_POST['prenom']))
            {
                echo json_encode("please enter correct 'prenom' ");
            }
            elseif(!preg_match("/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/", $_POST['email']))
            {
                echo json_encode("please enter correct 'email' ");
            }elseif(!preg_match("/^[0-9]+$/", $_POST['age']))
            {
                echo json_encode("please enter correct 'age' ");
            }
            else{
                $this->userModel->insertUser();
                
                $selectCode = $this->userModel->selectUser();
                echo json_encode($selectCode);
            }
        }

        public function login()
        {
            // Validation
            if(empty($_POST['code']))
            {
                echo json_encode("Field required !");
            }
            if(!preg_match("/^[0-9]+$/", $_POST['code']))
            {
                echo json_encode("please enter correct 'code' ");
            }else
            {
                $codeField = $_POST['code'];
                return $this->userModel->validateCode($codeField);
            }

        }
    }