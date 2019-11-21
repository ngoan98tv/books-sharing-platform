<?php

namespace controllers;
use Models;

class Uploader {

    public function sign_in() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $result = Models\Uploader::sign_in($username, $password);
        switch ($result) {
            case 0:
                header('Location: sign_in?state=3');
                break;
            case -1:
                header('Location: sign_in?state=2');
                break;
            case -2:
                header('Location: sign_in?state=4');
                break;
            default:
                $_SESSION['uploader'] = $result;
                header('Location: sign_in?state=1');
                break;
        }
    }

    public function sign_up() {
        $uploader = [
            'name'      => $_POST['name'],
            'username'  => $_POST['username'],
            'email'     => $_POST['email'],
            'password'  => $_POST['password']
        ];
        $comfirm_password = $_POST['comfirm-password'];
        if ($comfirm_password != $uploader['password']) {
            header('Location: sign_up?error=password-not-match');
        } else {
            $error = Models\Uploader::sign_up($uploader);
            if (!$error) {
                header('Location: /');
            } else {
                header('Location: sign_up?error='.$error);
            }
        }
    }

    public function sign_out() {
        $_SESSION['uploader'] = null;
        header('Location: /');
    }
}

?>