<?php

namespace App\Models;

use Exception;
use MF\Model\Model;
use PDOException;

class LoginAlunos extends Model
{
    private $nome_aluno;
    private $aniver_aluno;
    private $email_aluno;
    public $usuario_aluno;
    private $senha_aluno;
    public $curso;


    public function __get($attr)
    {
        return $this->$attr;
    }

    public function __set($attr, $value)
    {
        $this->$attr = $value;
    }

    public function logar()
    {
        if (empty($_POST['usuarioAluno']) || strlen($this->usuario_aluno) < 3) {
            header('location: /?login=error');
            exit();
        }

        if (empty($_POST['senhaAluno']) || strlen($this->senha_aluno) < 6) {
            header('location: /?login=error');
            exit();
        }
        
        try {
            $query = '
                SELECT usuario_aluno, senha_aluno 
                FROM login_alunos
                WHERE usuario_aluno = :usuario_aluno AND
                senha_aluno = :senha_aluno
            ';

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':usuario_aluno', $this->usuario_aluno);
            $stmt->bindParam(':senha_aluno', $this->senha_aluno);
            $stmt->execute();
            $aluno = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (($aluno == 1) || ($aluno == true) && ($aluno['senha_aluno']) == $this->senha_aluno) {
                $_SESSION['user_aluno'] = $this->usuario_aluno;
                //$_SESSION['curso_aluno'];
                header('location: /meus_cursos');
            }else{
                header('location: /?login=error');
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function cadastrar()
    {
        if (empty($_POST['nomeAluno']) || strlen($this->nome_aluno) < 3) {
            header('location: /cadastre_se?cadastrar=error');
            exit();
        }

        if (empty($_POST['usuarioAluno']) || strlen($this->usuario_aluno) < 3) {
            header('location: /cadastre_se?cadastrar=error');
            exit();
        }

        if (empty($_POST['senhaAluno']) || strlen($this->senha_aluno) < 6) {
            header('location: /cadastre_se?cadastrar=senha_invalida');
            exit();
        }

        $query = '
            SELECT usuario_aluno
            FROM login_alunos
            WHERE usuario_aluno = :usuario_aluno
        ';

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':usuario_aluno', $this->usuario_aluno);
        $stmt->execute();
        $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (($usuario == 1) || ($usuario == true)) {
            return header('location: /cadastre_se?cadastro=existe');
        } else if (($usuario == null) || ($usuario == false)) {
            if ($this->senha_aluno == $_POST['confirmaSenha']) {
                try {
                    $query = '
                        INSERT INTO login_alunos(nome_aluno, aniver_aluno, usuario_aluno, email_aluno, senha_aluno) 
                        VALUES(:nome_aluno, :aniver_aluno, :usuario_aluno, :email_aluno, :senha_aluno)
                    ';
        
                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(':nome_aluno', $this->nome_aluno);
                    $stmt->bindParam(':aniver_aluno', $this->aniver_aluno);
                    $stmt->bindParam(':usuario_aluno', $this->usuario_aluno);
                    $stmt->bindParam(':email_aluno', $this->email_aluno);
                    $stmt->bindParam(':senha_aluno', $this->senha_aluno);
                    $stmt->execute();
                    $aluno = $stmt->fetch(\PDO::FETCH_ASSOC);
        
                    if (isset($aluno) == 1) {
                        $_SESSION['user_aluno'] = $this->usuario_aluno;
                        //$_SESSION['curso_aluno'];
                        header('location: /meus_cursos');
                        exit();
                    } else {
                        header('location: /?error');
                        exit();
                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
        } else {
            header('location: /cadastre_se?senha=invalida');
        }
    }

    public function verificaEmail()
    {
        try{
            $query = '
                SELECT email_aluno 
                FROM login_alunos
                WHERE email_aluno = :email_aluno
            ';

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email_aluno', $this->email_aluno);
            $stmt->execute();
            $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($usuario['email_aluno'] == $this->email_aluno) {
                return header('location: /cadastre_se?cadastro=existe');
            } else if (($usuario == null) || ($usuario == false)) {
                LoginAlunos::cadastrar();
            } 
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
