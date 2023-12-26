<?php



class db
{
	private static $mcache = '';

	public function __construct()
	{

		global $config;

			/**
			 * set db configuration
			 */
			$this->config =  array
			(
				'host'			=> $config["db"]["host"],
				'username'		=> $config["db"]["username"],
				'password'		=> $config["db"]["password"],
				'dbname'		=> $config["db"]["database"],
			);
	}

	/**
	 * connect to db.
	 *
	 * @access public
	 * @return bool
	 */
	public static function connect() {

		global $config,$conn;

		$conn = new mysqli($config["db"]["host"],$config["db"]["username"],$config["db"]["password"], $config["db"]["database"]);
		mysqli_set_charset($conn,'UTF8MB4');
		//echo mysql_error();


		if ($conn->connect_errno) {
			printf("Connect failed: %s\n", $conn->connect_error);
			exit();
}



		return true;
	}


	/**
	 * close database function.
	 *
	 * @access public
	 * @return
	 */
	public function close() {
		mysqli_close();
	}


	/**
	 * fetch_array function.
	 *
	 * @access public
	 * @param object $req
	 * @return array
	 */
	public function fetch_array($req) {

		global $log;

		$response = @mysql_fetch_array();

		if (mysqli_error())	{
			/* log error
			$log::line(mysql_error(),$this->last_query);*/
		}

		return $response;

	}


	/**
	 * fetch_assoc function.
	 *
	 * @access public
	 * @param object $req
	 * @return array
	 */
	static public function fetch_assoc($req)	{

		global $log, $config, $conn;

		$response = mysqli_fetch_assoc($req);

		return $response;
	}


	/**
	 * num_rows function.
	 *
	 * @access public
	 * @param object $req
	 * @return int
	 */
	static public function num_rows($req)  {

		global $conn;
		return mysqli_num_rows($req);
	}


	static public function insert_id($req)  {

		global $conn;
		return mysqli_insert_id($conn);
	}


	/**
	 * return affected rows.
	 *
	 * @access public
	 * @param object $req
	 * @return int
	 */
	public function affected_rows($req) {
		return @mysqli_affected_rows();
	}


	/**
	 * escape string.
	 *
	 * @access public
	 * @param mixed $value

	 * @param bool $html_entities (default: false)
	 * @return void
	 */
	static public function escape($value,$html_entities = false) {

		global $log, $config, $conn;


		if ($html_entities) {
			return mysqli_real_escape_string($conn,htmlentities($value));
		}
		else
		{
			return mysqli_real_escape_string($conn,$value);
		}
	}





	/**
	 * run sql query.
	 *
	 * @access public
	 * @param string $query

	 * @param bool $output_as_array (default: false)
	 * @return object / array
	 */
	static public function query($query,$array = '', $limit = false)	{

		global $log, $config, $conn,$req;

		$query = str_replace("INTO ", "INTO ".$config["db"]["prefix"],$query);
		$query = str_replace("FROM ", "FROM ".$config["db"]["prefix"],$query);
		$query = str_replace("UPDATE ", "UPDATE ".$config["db"]["prefix"],$query);

			$req = mysqli_query($conn,$query);

			if (mysqli_error($conn)) {

				//if (isset($_GET["test"])) {

				echo mysqli_error($conn)." QUERY".$query;

				//}

				//slack::msg(mysqli_error($conn)." | ".$query);
			}




		return $req;

	}

	static public function lastID() {
		global $log, $config, $conn,$req;
		return mysqli_insert_id($conn);
	}




  public static function num($table, $conditions, $required = ["id"]) {

    $build_query = "SELECT ".implode(",",$required)." FROM ".db::escape($table)." WHERE ";

    $i = 0;

    foreach ($conditions as $name => $value) {

      $name = \db::escape($name);
      $value = \db::escape($value);

      $i++;

      if ($i < count($conditions) ) {
        $build_query .= $name."='".$value."' AND ";
      }
      else
      {
        $build_query .= $name."='".$value."'  ";
      }
    }


    // @TODO Check IF LIMIT is number AND SKIP function
    $req = \db::query($build_query);

    // Return true or false
    return \db::num_rows($req);

  }





  public static function select($table, $conditions = false,  $limit = [ 100 ], $required = ["*"]) {

      $build_query = "SELECT ".implode(",",$required)." FROM ".db::escape($table)." ";


			if (is_array($conditions)) {

				$build_query .= " WHERE ";

      $i = 0;

      foreach ($conditions as $name => $value) {

        $name = \db::escape($name);
        $value = \db::escape($value);

        $i++;

        if ($i < count($conditions) ) {
          $build_query .= $name."='".$value."' AND ";
        }
        else
        {
          $build_query .= $name."='".$value."'  ";
        }
      }
		}


      // @TODO Check IF LIMIT is number AND SKIP function
      $req = \db::query($build_query." LIMIT ".$limit[0]);
      while ($row = \db::fetch_assoc($req)) {
        $arr[] = $row;
      }


      // Return true or false
      return $arr;

  }






    public static function insert ($table, $array) {

        $build_query = "INSERT INTO ".db::escape($table)."  ";

        $i = 0;

        foreach ($array as $name => $value) {
          $columns[] = "".\db::escape($name)."";
          $values[] = "'".\db::escape($value)."'";
        }

        // @TODO Check IF LIMIT is number
        $req = \db::query($build_query." (".implode(",",$columns).") VALUES (".implode(",",$values).")");


        // Return User ID or False (MIXED)
        return \db::lastID($req);

    }



  public static function update ($table, $conditions, $values, $limit = 1) {

      $build_query = "UPDATE ".db::escape($table)." SET ";


			$i = 0;

			foreach ($values as $name => $value) {

				$name = \db::escape($name);
				$value = \db::escape($value);

				$i++;

				if ($i < count($values) ) {
					$build_query .= $name."='".$value."' , ";
				}
				else
				{
					$build_query .= $name."='".$value."'  ";
				}
			}


			  $build_query .= " WHERE ";


				      $i = 0;

				      foreach ($conditions as $name => $value) {

				        $name = \db::escape($name);
				        $value = \db::escape($value);

				        $i++;

				        if ($i < count($conditions) ) {
				          $build_query .= $name."='".$value."' AND ";
				        }
				        else
				        {
				          $build_query .= $name."='".$value."'  ";
				        }
				      }


			if (isset($_GET["debug"])) echo $build_query." LIMIT ".$limit;

      // @TODO Check IF LIMIT is number
      $req = \db::query($build_query." LIMIT ".$limit);

      // Return true or false
      return $req;

  }




}
?>
