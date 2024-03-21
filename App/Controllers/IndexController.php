<?php

namespace App\Controllers;

use App\Models\UsuarioAdmin;
use MF\Controller\Action;
use MF\Model\Container;

session_start();

class IndexController extends Action {

	public function index() {
		$this->render('index');
	}

	public function quemSomos(){
		$this->render('quem_somos', 'layout_qmsomos');
	}

	public function contato(){
		$this->render('contato', 'layout_contato');
	}

	public function ranking(){
		$usuario_admin = Container::getModel('RankingAlunos');
		$alunos = $usuario_admin->mostrarAlunos();
		$this->view->alunos = $alunos;
		$this->render('ranking', 'layout_ranking');
	}

	public function loja(){
		$this->render('loja', 'layout_loja');
	}

	public function meusCursos(){
		$this->render('aluno_meus_cursos', 'layout_aluno_meus_cursos');
	}

	public function error(){
		$this->render('error', 'layout_error');
	}

	public function loginAdmin(){
		$this->render('login_admin', 'layout_login_admin');
	}

	public function recuperarSenhaAdmin(){
		$this->render('recuperar_senha_admin', 'layout_recuperar_senha');
	}
	
	/* Controle do administrador */
	public function logarAdmin(){
		if(isset($_POST['btnLoginAdmin'])){
			$usuario_admin = Container::getModel('UsuarioAdmin');
			$usuario_admin->logarAdmin();
		}
	}

	public function editarRanking(){
		$usuario_admin = Container::getModel('RankingAlunos');
		$alunos = $usuario_admin->mostrarAlunos();
		$this->view->alunos = $alunos;
		$this->render('editar_ranking', 'layout_editar_ranking');
	}

	public function editarCursos(){
        $this->render('editar_cursos', 'layout_editar_cursos');
    }

	/* Controle de login */
	public function cadastreSe(){
		$this->render('cadastre_se', 'layout_cadastre_se');
	}

	public function logar(){
		if(isset($_POST['btn-login'])){
			$usuario_login = Container::getModel('LoginAlunos');
			$usuario_login->__set('usuario_aluno', $_POST['usuarioAluno']);
			$usuario_login->__set('senha_aluno', $_POST['senhaAluno']);
			$usuario_login->logar();
		}
	}

	/* Esqueceu senha usuário */
	public function esqueceuSenha(){
		$this->render('esqueceu_senha', 'layout_esqueceu_senha');
	}
}
?>