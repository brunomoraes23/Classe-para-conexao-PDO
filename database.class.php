<?php 


class Database{

	//variavel do banco
	protected static $database;

	 //construtor que gera a conexão
	private function __construct()
	{
        // Informações da conexão com o banco:
		$db_host = "localhost";
		$db_name = "banco";
		$db_user = "usuario";
		$db_password = "senha";
		$db_driver = "mysql";
		try
		{
            // Instacia o objeto PDO na variavel database.
			self::$database = new PDO("$db_driver:host=$db_host; dbname=$db_name", $db_user, $db_password);
            // Permite ao PDO lançar exceções durante erros.
			self::$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Codificação UFT-8.
			self::$database->exec('SET NAMES utf8');
		}
		catch (PDOException $e)
		{
            // Caso ocorra algum erro interrompe a execução
			die("Connection Error: " . $e->getMessage());
		}
	}

    //metodo que gera a conexão
	public static function conect()
	{
        // Garante uma única instância. Se não existe uma conexão, criamos uma nova.
		if (!self::$database)
			{
				new Database();
			}
        // Retorna a conexão.
			return self::$database;
		}
	}