<?php 

namespace App\Controllers;

use App\Models\LoginAlunos;
use MF\Controller\Action;
use MF\Model\Container;

session_start();

class CadastroController extends Action {
    public function cadastrar(){
        $usuario_novo = Container::getModel('LoginAlunos');
		$usuario_novo->__set('nome_aluno', $_POST['nomeAluno']);
		$usuario_novo->__set('aniver_aluno', $_POST['aniverAluno']);
		$usuario_novo->__set('usuario_aluno', $_POST['usuarioAluno']);
		$usuario_novo->__set('email_aluno', $_POST['emailAluno']);
		$usuario_novo->__set('senha_aluno', $_POST['senhaAluno']);
		$usuario_novo->verificaEmail();
    }
}

?>