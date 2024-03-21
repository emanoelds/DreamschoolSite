<?php

namespace App\Models;

use Exception;
use MF\Model\Model;
use PDOException;

class UsuarioAdmin extends Model
{
    private $id_admin;
    private $usuario_admin;
    private $senha_admin;
    private $email_admin;

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function logarAdmin()
    {
        if(isset($_POST['usuario_admin']) && isset($_POST['senha_admin'])){
            $this->usuario_admin = $_POST['usuario_admin'];
            $this->senha_admin = $_POST['senha_admin'];
        }else{
            header('Location: /dreamschool_login_admin?login=error');
        }
        
        try {
            $query = '
                select usuario_admin, senha_admin 
                from user_admin where usuario_admin = :usuario_admin
            ';
            
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':usuario_admin', $this->usuario_admin);
            $stmt->execute(); 
            $admin = $stmt->fetch(\PDO::FETCH_ASSOC); 

            if ($admin !== false && sha1($this->senha_admin) == $admin['senha_admin']) {
                $_SESSION['login'] = $admin;
                header('Location: /editar_ranking');
                exit;
            }else{
                header('Location: /dreamschool_login_admin?login=error');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //recuperar o usuário por e-mail
    public function getUsuarioPorEmail()
    {
        $query = "select nome, email from user_admin where email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}