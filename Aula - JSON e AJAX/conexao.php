<?php
	
	class Conexao extends PDO 
	{
 
	    private static $instancia;
            private static $instancia_ai;
	 
	    public function Conexao($dsn, $username = "", $password = "") {
	        parent::__construct($dsn, $username, $password);
	    }

		public static function anti_injection($sql)
		{
			$sql = preg_replace("/(union|from|into|select|insert|delete|where|drop table|show tables|--|#|\*|\\\\)/ism",'',$sql);
			$sql = strip_tags($sql);
			$sql = str_replace("\"", "",$sql);
			$sql = str_replace("\'", "",$sql);	
			$sql = addslashes($sql);
			//$sql = mysql_real_escape_string($sql); //Adiciona barras invertidas a uma string
			$sql = trim($sql);
			
			return $sql;
		}
	
	    public static function getInstance($tipo) {
	        
			if($tipo == 1){
				if(!isset( self::$instancia_ai )){
					try {
						self::$instancia_ai = new Conexao("mysql:host=localhost;dbname=curso_formacao_web_essencial", "root", "");
					} catch ( Exception $e ) {
						echo 'Erro ao conectar';
						exit ();
					}
				}
				return self::$instancia_ai;
			}
 	    }
	}
?>