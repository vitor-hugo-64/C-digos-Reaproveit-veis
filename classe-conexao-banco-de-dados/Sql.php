<?php

	class Sql extends PDO {
		
		// FUNÇÃO CONTRUTORA DA CLASSE
		function __construct() {
			$this->conn = new PDO("mysql:host=localhost;dbname=teste", "root", "");
		}

		// FUNÇÃO QUE ASSOCIA UM DADO A UMA VARIÁVEL
		// NO PRIMEIRO PARAMETRO VAI A VARIÁVEL QUE ARMAZERNA A CONSULTA
		// A SEGUNDA ENTRADA É PARA INFORMAR O PARAMETRO
		public function setParam($statment, $key, $value) {

			// CHAMA A FUNÇÃO QUE IRÁ ATRIBUIR AS VARIAVEIS AOS ATRIBUTOS
			// O PRIMEIRO PARAMETRO É O NOME DO ATRIBUTO NA CONSULTA
			// O SEGUNDO PARAMETRO É A VARIÁVEL QUE ARMAZENA O DADO DA CONSULTA			
			$statment->bindParam($key, $value);

		}

		// FUNÇÃO QUE ASSOCIA OS AS VARIAVEIS QUE CONTEM OS DADOS AOS PARAMETROS QUE SERÃO USADOS NAS CONSULTAS
		// NO PRIMEIRO PARAMETRO VAI O COMANDO QUE JÁ ESTÁ ARMAZENADO NA VARIÁVEL '$statment'
		// NO SEGUNDO PARAMETRO VAI AS VARIAVEIS EM FORMA DE ARRAY, ONDE '$key' SERÁ O NOME DO ATRIBUTO NA CONSULTA E '$value' SERÁ O NOME DA VARIÁVEL QUE SERÁ ATRIBUÍDA AO ATRIBUTO
		public function setParams($statment, $parameters = Array())	{
			
			// O FOR EACH ATRIBUIRA CADA VARIÁVEL($value) AO ATRIBUTO($key) ASSIM QUE A FUNÇÃO QUE ESTÁ DENTRO DO ESCOPO FOR CHAMADA
			foreach ($parameters as $key => $value) {

				// CHAMA A FUNÇÃO QUE IRÁ ATRIBUIR AS VARIAVEIS AOS ATRIBUTOS
				// O PRIMEIRO PARAMETRO É O NOME DO ATRIBUTO NA CONSULTA
				// O SEGUNDO PARAMETRO É A VARIÁVEL QUE ARMAZENA O DADO DA CONSULTA
				$this->setParam($statment, $key, $value);

			}

		}

		// FUNÇÃO QUE EXECUTA UMA CONSULTA
		// NO PRIMEIRO PARAMETRO VAI A CONSULTA EM FORMA DE STRING
		// NO SEGUNDO PARAMETRO VAI OS PARAMETROS EM FORMA DE ARRAY
		public function query($rawQuery, $params = Array()) {

			// PREPARA A CONSULTA NA VARIÁVEL '$stmt'
			$stmt = $this->conn->prepare($rawQuery);

			// CHAMA A FUNÇÃO DA LINHA 25
			$this->setParams($stmt, $params);

			// EXECUTA A CUNSULTA
			$stmt->execute();

			// RETORNA A VARIÁVEL
			return $stmt;

		}

		// EXECUTA UM SELECT
		// NO PRIMEIRO PARAMETRO INFORMADO A CONSULTA EM FORMA DE STRING
		// NO SEGUNDO PARAMETRO É INFORMADO OS DADOS EM FORMA DE ARRAY
		public function select($rawQuery, $params = Array()):array {
			// AQUI A CONSULTA É EXECUTADA PELA FUNÇAÕ DA LINHA 42
			$stmt = $this->query($rawQuery, $params);
			// E AQUI É RETORNADO OS DADOS ATRAVÉS DE UM ARRAY
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

	}