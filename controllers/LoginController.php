<?php
     if (!defined('ACCESS_ALLOWED')) {
    die('Direct access not allowed');
    }
    
    class LoginController{
        private $pdo;
        private $userModel;

        public function __construct($pdo)
        {
            $this->pdo=$pdo;
            $this->userModel=new UserModel($pdo);
        }

        private function validateInput($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }

        public function login(){
            $errors=[];
            $success='';

            if($_SERVER['REQUEST_METHOD']==='POST'){
                $email=$this->validateInput($_POST['email']??'');
                $password=$_POST['password']??'';

                if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Valid email is required.";
                }
                if (empty($password)) {
                    $errors[] = "Password is required.";
                }

                if(empty($errors)){
                    try{
                        $user=$this->userModel->authenticateUser($email,$password);
                        if($user){
                            
                            $_SESSION['user_id']=$user['id'];
                            $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
                            $_SESSION['user_email'] = $user['email'];
                            $_SESSION['user_role'] = $user['role'];
                            $_SESSION['success'] = $success;
                            if ($_SESSION['user_role'] == 'customer') {
                                header("Location: home.php");
                                exit();
                            } elseif ($_SESSION['user_role'] == 'admin') { // Chỉ chuyển hướng 'admin' đến khu vực admin
                                header("Location: admin/index.php");
                                exit();
                            } else {
                                // Xử lý các vai trò không xác định hoặc không được phép (ví dụ: đăng xuất và thông báo lỗi)
                                $errors[] = "Role not recognized or authorized.";
                                $_SESSION['errors'] = $errors;
                                header("Location: login.php");
                                exit();
                            }
                            
                        }else {
                            $errors[] = "Invalid email or password.";
                        }
                    } catch (Exception $e) {
                        $errors[] = "Database error: " . $e->getMessage();
                    }
                }

                if(!empty($errors)){
                      // Lưu session và redirect
                    $_SESSION['errors'] = $errors;               
                    header("Location: login.php");
                    exit();
                }
            }
        }
    }

?>