<?php
    // Ngăn truy cập trực tiếp
    if (!defined('ACCESS_ALLOWED')) {
        die('Direct access not allowed');
    }

    class UserModel{
        private $pdo;

        public function __construct($pdo)
        {
           $this->pdo=$pdo;
        }

        public function addUser($firstName, $lastName, $email, $hashedPassword, $role='customer')
        {
            try
            {
                $sql="INSERT INTO users (first_name, last_name, email, password, role) VALUES (?, ?, ?, ?, ?)";
                $stmt=$this->pdo->prepare($sql);
                $stmt->bindParam(1, $firstName, PDO::PARAM_STR);
                $stmt->bindParam(2, $lastName, PDO::PARAM_STR);
                $stmt->bindParam(3, $email, PDO::PARAM_STR);
                $stmt->bindParam(4, $hashedPassword, PDO::PARAM_STR);
                $stmt->bindParam(5, $role, PDO::PARAM_STR);
                $stmt->execute();
                return $this->pdo->lastInsertId(); // Trả về ID user mới
            } catch (PDOException $e) 
            {
                throw new Exception("Lỗi thêm user mới " . $e->getMessage());
            }
        }
        

        public function getUsers(){
            try{
                $sql="SELECT * FROM users";
                $stmt=$this->pdo->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                throw new Exception("Lỗi lấy danh sách users ". $e->getMessage());

            }
          
        }

        public function updateUser($id, $newFirstName, $newLastName, $newEmail){
            try{
                $sql="UPDATE users SET first_name = ?, last_name = ?, email = ? WHERE id = ?";
                $stmt=$this->pdo->prepare($sql);
                $stmt->bindParam(1,$newFirstName,PDO::PARAM_STR);
                $stmt->bindParam(2,$newLastName,PDO::PARAM_STR);
                $stmt->bindParam(3,$newEmail, PDO::PARAM_STR);
                $stmt->bindParam(4,$id,PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->rowCount(); //Trả về số row được update
            }catch(PDOException $e){
                throw new Exception("Lỗi cập nhật user ".$e->getMessage());
            }
        }

        public function deleteUser($id){
            try{
                $sql="DELETE * FROM users WHERE id =? ";
                $stmt=$this->pdo->prepare($sql);
                $stmt->bindParam(1,$id,PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->rowCount();
            }catch(PDOException $e){
                throw new Exception("Lỗi xóa người dùng ".$e->getMessage());
            }
        }

        //Kiểm tra email đã tồn tại
        public function checkEmail($email){
            try{
                $sql="SELECT id FROM users WHERE email = ?";
                $stmt=$this->pdo->prepare($sql);
                $stmt->bindParam(1,$email,PDO::PARAM_STR);
                return $stmt->rowCount() >0;
            }catch(PDOException $e){
                throw new Exception("Lỗi kiểm tra email người dùng ". $e->getMessage());
            }
        }
         
    }

?>