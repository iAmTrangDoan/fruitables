<?php
class User extends Db
{
    // Đăng ký người dùng (returns inserted rows)
    public function register($email, $password, $name = '', $address = '', $phone = '')
    {
        $pwd = md5($password);
        $sql = "insert into users(email, password, name, address, phone) values(:email, :pwd, :name, :address, :phone)";
        return $this->insert($sql, array(':email' => $email, ':pwd' => $pwd, ':name' => $name, ':address' => $address, ':phone' => $phone));
    }

    // Đăng nhập: trả về user row hoặc null
    public function login($email, $password)
    {
        $pwd = md5($password);
        $r = $this->select("select * from users where email = :email and password = :pwd", array(':email' => $email, ':pwd' => $pwd));
        return isset($r[0]) ? $r[0] : null;
    }

    // Cập nhật thông tin người dùng
    public function updateUser($email, $data = array())
    {
        $sets = array();
        $params = array();
        foreach ($data as $k => $v) {
            if ($k == 'password') $v = md5($v);
            $sets[] = "$k = :$k";
            $params[":$k"] = $v;
        }
        if (empty($sets)) return 0;
        $params[':email'] = $email;
        $sql = "update users set " . implode(', ', $sets) . " where email = :email";
        return $this->update($sql, $params);
    }
}
