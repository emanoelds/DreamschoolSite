<?php

namespace App\Models;

use Exception;
use MF\Model\Model;
use PDOException;

class RankingAlunos extends Model
{
    private $id;
    private $nome_aluno;
    private $pontuacao_aluno;

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    //salvar
    public function adicionarAluno()
    {
        if (empty($_POST['idAluno']) && ($this->id == '' || $this->id <= 0) || !is_numeric($this->id)) {
            header('Location: /editar_ranking?aluno=error');
            exit();
        }
    
        if (empty($_POST['nomeAluno']) || strlen($this->nome_aluno) < 3 || !is_numeric($this->pontuacao_aluno)) {
            header('Location: /editar_ranking?aluno=error');
            exit();
        }

        try {
            $query = '
                select id
                from user_alunos
                where id = :id
                limit 1
            ';
    
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            $aluno = $stmt->fetch(\PDO::FETCH_ASSOC);
    
            if ($aluno['id'] == $this->id) {
                header('Location: /editar_ranking?aluno=existe');
            } else {
                $query = '
                    insert into user_alunos(id, nome_aluno, pontuacao_aluno) 
                    values(:id, :nome_aluno, :pontuacao_aluno)
                ';

                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':id', $this->id);
                $stmt->bindParam(':nome_aluno', $this->nome_aluno);
                $stmt->bindParam(':pontuacao_aluno', $this->pontuacao_aluno);
                $stmt->execute();
                
                return header('Location: /editar_ranking?aluno=adicionado');
            }        
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function mostrarAlunos()
    {
        try {
            $query = '
                select nome_aluno, pontuacao_aluno 
                from user_alunos 
                order by pontuacao_aluno desc
                limit 10
            ';

            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $alunos = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $alunos;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function editarAluno()
    {
        if (empty($_POST['idAluno']) && ($this->id == '' || $this->id <= 0) || !is_numeric($this->id)) {
            header('Location: /editar_ranking?aluno=error');
            exit();
        }
    
        if (empty($_POST['nomeAluno']) || strlen($this->nome_aluno) < 3 || !is_numeric($this->pontuacao_aluno)) {
            header('Location: /editar_ranking?aluno=error');
            exit();
        }

        try {
            $query = '
                select id, nome_aluno 
                from user_alunos
                where id = :id and nome_aluno = :nome_aluno
                limit 1
            ';

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':nome_aluno', $this->nome_aluno);
            $stmt->execute();
            $aluno = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($stmt->rowCount() == 1 && isset($this->id) == $aluno['id'] || isset($this->nome_aluno) == $aluno['nome_aluno']) {
                $query = '
                    update user_alunos 
                    set id = :id, nome_aluno = :nome_aluno, 
                    pontuacao_aluno = :pontuacao_aluno
                    limit 1
                ';

                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':id', $this->id);
                $stmt->bindParam(':nome_aluno', $this->nome_aluno);
                $stmt->bindParam(':pontuacao_aluno', $this->pontuacao_aluno);
                $stmt->execute();

                return header('Location: /editar_ranking?aluno=editado');
            } else if (!isset($this->id) == $aluno['id'] && !isset($this->nome_aluno) == $aluno['nome_aluno']) {
                return header('Location: /editar_ranking?aluno=invalido');
                exit;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deletarAluno()
    {
        if (empty($this->id) && $this->id <= 0 || $this->id == null) {
            header('Location: /editar_ranking?excluir=error');
        }

        try {
            $query = '
                select id from user_alunos
                where id = :id limit 1
            ';

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            $aluno = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($stmt->rowCount() == 1 && isset($this->id) && $this->id == $aluno['id']) {
                $query = '
                    delete from user_alunos 
                    where id = :id
                ';

                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':id', $this->id);
                $stmt->execute();

                return header('Location: /editar_ranking?aluno=excluido');
            } else {
                return header('Location: /editar_ranking?excluir=error');
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
