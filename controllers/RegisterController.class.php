<?php
    if (!defined('ACCESS_ALLOWED')) {
    die('Direct access not allowed');
    }

    class RegisterController{
        private $pdo;
        private $userModel;


        public function __construct($pdo)
        {
            $this->pdo=$pdo;
            $this->userModel=new UserModel($pdo); //Khởi tạo Model và truyền db vào
        }

        private function validateInput($data){
            return htmlspecialchars(stripslashes(trim($data)));
        }

        public function registration(){
            $errors=[];
            $success='';

            if($_SERVER['REQUEST_METHOD']==='POST'){
                //Lấy và validate dữ liệu từ form
                $firstName=$this->validateInput($_POST['firstName']??'');
                $lastName=$this->validateInput($_POST['lastName']??'');
                $email=$this->validateInput($_POST['email']??'');
                $password= $_POST['password'] ?? '';
                $confirm_password= $_POST['confirmPassword'] ?? '';
                $agreeTerms = isset($_POST['agreeTerms']);

                if(empty($firstName))
                    $errors[]="First name is required";
                if(empty($lastName))
                    $errors[]="Last name is required";
                if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) 
                    $errors[] = "Valid email is required.";
                if(strlen($password)<8)
                    $errors[]="Password must be at least 8 characters";
                if($password !== $confirm_password)
                    $errors[]="Passwords do not match";
                if (!$agreeTerms) 
                    $errors[] = "You must agree to the Terms and Conditions";

                if(empty($errors)){

                    try{

                        if($this->userModel->checkEmail($email))
                            $errors[]="Email already exists";
                        else{
                            $hashedPassword=password_hash($password,PASSWORD_DEFAULT); //hàm mã hóa bcrypt mật khẩu một chiều, không thể giải mã ngược lại
                            $userID=$this->userModel->addUser($firstName,$lastName,$email,$hashedPassword);
                           $_SESSION['user_id']   = $userID;
                            $_SESSION['user_name'] = $firstName . ' ' . $lastName;
                            $_SESSION['user_email'] = $email;
                            $_SESSION['user_role']  = 'customer'; 

                            header("Location: home.php");
                            exit();
                    }
                    }catch (Exception $e) {
                        $errors[] ="Database error: " . $e->getMessage();
                    }
                }else{
                    $_SESSION['errors'] = $errors;
                    header("Location: register.php");
                    exit();
                }        
            }
        }
    }

?>