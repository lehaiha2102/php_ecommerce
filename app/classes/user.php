<?php
require_once('../../config/database.php');

class User{
    private $user_id;
    private $fullname;
    private $email;
    private $phone;
    private $password;
    private $address;
    private $role_id;

    public function __construct($user_id = null, $fullname = null, $email = null, $phone = null, $password = null, $address = null, $role_id = null){
        $this->user_id = $user_id;
        $this->fullname = $fullname;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->address = $address;
        $this->role_id = $role_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getFullname() {
        return $this->fullname;
    }

    public function getEmail() {
        return $this->email;
    }
    public function getPhone() {
        return $this->phone;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getAddress() {
        return $this->address;
    }
    public function getRoleId() {
        return $this->role_id;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function register($fullname, $email, $phone, $password, $address) {
        global $connection;
        $email_error = '';
        $phone_error = '';
        $hashed_password = '';
        $sql_check_email = 'SELECT user_id FROM users WHERE email = ?';
        $stmt_check_email = $connection->prepare($sql_check_email);
        $stmt_check_email->bind_param('s', $email);
        $stmt_check_email->execute();
        $result_check_mail = $stmt_check_email->get_result();
        if($result_check_mail->num_rows  > 0){
            return $email_error = 'Email already exists!';
        } else{
            $sql_check_phone = 'SELECT user_id FROM users WHERE phone = ?';
            $stmt_check_phone = $connection->prepare($sql_check_phone);
            $stmt_check_phone->bind_param('s', $phone);
            $stmt_check_phone->execute();
            $result_check_phone = $stmt_check_phone->get_result();
            if($result_check_phone->num_rows  > 0){
                return $phone_error = 'Phone already exists!';
            } else{
                $password = sha1($password);
                $sql_register = 'INSERT INTO users(fullname, email, phone, password, address) VALUES(?, ?, ?, ?, ?)';
                $stmt_register = $connection->prepare($sql_register);
                $stmt_register->bind_param('sssss', $fullname, $email, $phone, $password, $address);
                if($stmt_register->execute()){
                    return 'success';
                } else{
                    return 'failed';
                }
            }
        }
    }
    
    
    public function login($email, $password){
        global $connection;
        $password = sha1($password);
        $sql_check_email = 'SELECT * FROM users WHERE email = ? AND password = ?';
        $stmt_check_email = $connection->prepare($sql_check_email);
        $stmt_check_email->bind_param('ss', $email, $password);
        $stmt_check_email->execute();
        $result_check_email = $stmt_check_email->get_result();
        if($result_check_email->num_rows === 1){
            $row = $result_check_email->fetch_assoc();
            $_SESSION['user'] = array(
                'id' => $row['user_id'],
                'email' => $email,
                'role_id' => $row['role_id']
            );
            if($_SESSION['user']['role_id'] == 1){
                return 'admin';
            } else{
                return 'user';
            }
        } else{
            header('Location: ../views/auth/index.php');
            exit;
        }
    }
    
    
}

?>