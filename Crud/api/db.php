<?php
    class Db {
        public $Server;
        public $User;
        public $Pass;
        public $Database;

        protected static $connection;

        /**
         * Connect to the database
         *
         * @return bool false on failure / mysqli MySQLi object instance on success
         */
        public function __construct(){
            $this->Server = 'localhost';
            $this->Pass = '';
            $this->User = 'root';
            $this->Database = 'productos';
        }

        public function connect() {
            // Try and connect to the database
            if(!isset(self::$connection)) {
                self::$connection = mysqli_connect($this->Server,$this->User,$this->Pass);
                mysqli_select_db(self::$connection, $this->Database);
            }

            // If connection was not successful, handle the error
            if(self::$connection === false) {
                // Handle error - notify administrator, log to a file, show an error screen, etc.
                $ToReturn = false;
            }
            $ToReturn = self::$connection;
            return $ToReturn;
        }

        /**
         * Query the database
         *
         * @param $query The query string
         * @return mixed The result of the mysqli::query() function
         */
        public function query($query) {
            // Connect to the database
            $connection = $this->connect();
            // Query the database
            $ToReturn = mysqli_query($connection, $query);
            if (!$ToReturn){
                $ToReturn = mysqli_error($connection);
            }
            return $ToReturn;
        }

        public function insert($query){
            $connection = $this->connect();
            if ($connection) {
                $Result = mysqli_query($connection, $query);
                if ($Result) {
                    $ToReturn = mysqli_insert_id($connection); 
                }else{
                    $ToReturn = mysqli_error($connection);
                }
                return $ToReturn;
            }else{
                return 'No connection';
            }
        }

        public function update($query){
			$connection = $this->connect();
			if ($connection) {
				$ToReturn = mysqli_query($connection, $query);
				return $ToReturn;
			}else{
				return 'No connection';
			}
		}

        public function delete($query){
			$connection = $this->connect();
			if ($connection) {
				$ToReturn = mysqli_query($connection, $query);
				return $ToReturn;
			}else{
				return 'No connection';
			}
        }
        
        /**
         * Fetch rows from the database (SELECT query)
         *
         * @param $query The query string
         * @return bool False on failure / array Database rows on success
         */
        public function select($query) {
            $ToReturn = array();
            $rows = $this->query($query);
            if($rows === false) {
                return false;
            }
            while ($row = mysqli_fetch_assoc($rows)) {
                $ToReturn[] = $row;
            }
            
            return $ToReturn;
        }
    }
?>
