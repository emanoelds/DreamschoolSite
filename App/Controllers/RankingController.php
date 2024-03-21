<?php

namespace App\Controllers;

use App\Models\RankingAlunos;
use MF\Controller\Action;
use MF\Model\Container;

session_start();

class RankingController extends Action {
    public function verificaAluno(){
        if(isset($_POST['btn-adicionar-aluno'])){
            $usuario_admin = Container::getModel('RankingAlunos');
            $usuario_admin->__set('id', $_POST['idAluno']);
            $usuario_admin->__set('nome_aluno', $_POST['nomeAluno']);
            $usuario_admin->__set('pontuacao_aluno', $_POST['pontuacaoAluno']);
            $usuario_admin->verificaAluno();
        }
    }

    public function adicionarAluno(){ 
        $usuario_admin = Container::getModel('RankingAlunos');
        $usuario_admin->__set('id', $_POST['idAluno']);
        $usuario_admin->__set('nome_aluno', $_POST['nomeAluno']);
        $usuario_admin->__set('pontuacao_aluno', $_POST['pontuacaoAluno']);
        $usuario_admin->adicionarAluno();
    }

    public function editarAluno(){
        if(isset($_POST['btn-alterar-aluno'])){
            $usuario_admin = Container::getModel('RankingAlunos');
            $usuario_admin->__set('id', $_POST['idAluno']);
            $usuario_admin->__set('nome_aluno', $_POST['nomeAluno']);
            $usuario_admin->__set('pontuacao_aluno', $_POST['pontuacaoAluno']);
            $usuario_admin->editarAluno();
        }
    }

    public function deletarAluno(){
        if(isset($_POST['btn-deletar-aluno'])){
            $usuario_admin = Container::getModel('RankingAlunos');
            $usuario_admin->__set('id', $_POST['idAluno']);
            $usuario_admin->deletarAluno();
        }
    }
}
?>