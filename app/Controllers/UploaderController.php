<?php

namespace App\Controllers;

use App\Models\Uploader;

class UploaderController {

    public function sign_in() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $result = Uploader::sign_in($username, $password);
        switch ($result) {
            case 'wrong-username':
            case 'wrong-passwd':
            case 'db-error':
                header('Location: sign_in?state='.$result);
                break;
            default:
                $_SESSION['uploader'] = $result;
                header('Location: sign_in?state=success');
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
            header('Location: sign_up?error=1');
        } else {
            $error = Uploader::sign_up($uploader);
            if (!$error) {
                header('Location: sign_up?error=0');
            } else {
                header('Location: sign_up?error='.$error);
            }
        }
    }

}

?>