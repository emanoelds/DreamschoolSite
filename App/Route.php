<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['index'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		$routes['quem_somos'] = array(
			'route' => '/quem_somos',
			'controller' => 'indexController',
			'action' => 'quemSomos'
		);

		$routes['contato'] = array(
			'route' => '/contato',
			'controller' => 'indexController',
			'action' => 'contato'
		);

		$routes['ranking'] = array(
			'route' => '/ranking',
			'controller' => 'indexController',
			'action' => 'ranking'
		);

		$routes['loja'] = array(
			'route' => '/loja',
			'controller' => 'indexController',
			'action' => 'loja'
		);

		$routes['meus_cursos'] = array(
			'route' => '/meus_cursos',
			'controller' => 'indexController',
			'action' => 'meusCursos'
		);

		$routes['error'] = array(
			'route' => '/page_error',
			'controller' => 'indexController',
			'action' => 'error'
		);

		$routes['login_admin'] = array(
			'route' => '/login_ds',
			'controller' => 'indexController',
			'action' => 'loginAdmin'
		);

		$routes['recuperar_senha_admin'] = array(
			'route' => '/recuperar_senha_admin',
			'controller' => 'indexController',
			'action' => 'recuperarSenhaAdmin'
		);

		$routes['indexController'] = array(
			'route' => '/indexController',
			'controller' => 'indexController',
			'action' => 'logarAdmin'
		);

		$routes['editar_ranking'] = array(
			'route' => '/editar_ranking',
			'controller' => 'indexController',
			'action' => 'editarRanking'
		);

		//RANKING ROUTES
		$routes['verifica_aluno'] = array(
			'route' => '/verifica_aluno',
			'controller' => 'rankingController',
			'action' => 'verificaAluno'
		);

		$routes['adicionar_aluno'] = array(
			'route' => '/adicionar_aluno',
			'controller' => 'rankingController',
			'action' => 'adicionarAluno'
		);

		$routes['mostrar_aluno'] = array(
			'route' => '/mostrar_aluno',
			'controller' => 'indexController',
			'action' => 'mostrarAlunos'
		);
		
		$routes['editar_aluno'] = array(
			'route' => '/editar_aluno',
			'controller' => 'rankingController',
			'action' => 'editarAluno'
		);
		
		$routes['deletar_aluno'] = array(
			'route' => '/deletar_aluno',
			'controller' => 'rankingController',
			'action' => 'deletarAluno'
		);

		//Edição de cursos
		$routes['editar_cursos'] = array(
			'route' => '/editar_cursos',
			'controller' => 'indexController',
			'action' => 'editarCursos'
		);

		//Cadastro/Login
		$routes['login'] = array(
			'route' => '/login',
			'controller' => 'indexController',
			'action' => 'logar'
		);

		$routes['cadastre_se'] = array(
			'route' => '/cadastre_se',
			'controller' => 'indexController',
			'action' => 'cadastreSe'
		);

		$routes['cadastrar'] = array(
			'route' => '/cadastrar',
			'controller' => 'cadastroController',
			'action' => 'cadastrar'
		);

		$routes['esqueceu_senha'] = array(
			'route' => '/esqueceu_senha',
			'controller' => 'indexController',
			'action' => 'esqueceuSenha'
		);

		$this->setRoutes($routes);
	}
}
?>