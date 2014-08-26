<?php
class Connection extends PDO {
	private $dsn = 'mysql:dbname=pma;host=localhost';
	private $user = 'root';
	private $password = '';
	public $handle = null;

	function __construct( ) {
		try {
			if ( $this->handle == null ) {
				$dbh = parent::__construct( $this->dsn , $this->user , $this->password );
				$this->handle = $dbh;
				return $this->handle;
			}
		}
		catch ( PDOException $e ) {
			echo 'Connection failed: ' . $e->getMessage( );
			return false;
		}
	}

	function __destruct( ) {
		$this->handle = NULL;
	}
	
	public function query($sqlQuery, $arrayExecute){
		$query = $this->prepare($sqlQuery);
		return $query->execute($arrayExecute);
	}
	public function selectQuery($sqlQuery, $arrayExecute){
		$query = $this->prepare($sqlQuery);
		$query->execute($arrayExecute);
		
		$fetch = $query->fetchAll();
		return $fetch;
	}
}
?>