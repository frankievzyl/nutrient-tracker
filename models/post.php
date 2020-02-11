<?php
	class Post {
		// we define 3 attributes
    	// they are public so that we can access them using $post->author directly
		public $id;
		public $author;
		public $content;

		public function __construct($id, $author, $content) {
			$this->id =      $id;
			$this->author =  $author;
			$this->content = $content;
		}

		public static function all() {
			$list = [];
			$db = Database::getInstance();
			$req = $db->query('SELECT * FROM posts');

			// we create a list of Post objects from the database results
			foreach($req->fetchAll() as $post) {
				$list[] = new Post($post['id'],$post['author'], $post['content']);
			}
			return $list;
		}
		
		public static function find($id) {
			$conn = Database::getInstance();
			// we make sure $id is an integer
			$id = intval($id);
			$sql = "SELECT * FROM food WHERE id = ?";
			$stmt = prepared_query($conn, $sql, [$id]);
			$food = $stmt->get_result()->fetch_assoc();
			//more than 1: $foods = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

			return new Post($post['id'], $post['author'], $post['content']);
		}

		/*
		INSERT: $sql = "INSERT INTO users (name, email, password) VALUES (?,?,?)";
				prepared_query($conn, $sql, [$name, $email, $passwor]);

				insert multiple
				function escape_mysql_identifier($field){
					return "`".str_replace("`", "``", $field)."`";
				}

				function prepared_insert($conn, $table, $data) {
					$keys = array_keys($data);
					$keys = array_map('escape_mysql_identifier', $keys);
					$fields = implode(",", $keys);
					$table = escape_mysql_identifier($table);
					$placeholders = str_repeat('?,', count($keys) - 1) . '?';
					$sql = "INSERT INTO $table ($fields) VALUES ($placeholders)";
					prepared_query($conn, $sql, array_values($data));
				}

		UPDATE: $sql = "UPDATE users SET name=?, email=?, password=? WHERE id=?";
				prepared_query($conn, $sql, [$name, $email, $password, $id]);

		MULTIPLE WHERES:
				// always initialize a variable before use!
				$conditions = [];
				$parameters = [];

				// conditional statements
				if (!empty($_GET['name']))
				{
					// here we are using LIKE with wildcard search
					// use it ONLY if really need it
					$conditions[] = 'name LIKE ?';
					$parameters[] = '%'.$_GET['name']."%";
				}

				if (!empty($_GET['sex']))
				{
					// here we are using equality
					$conditions[] = 'sex = ?';
					$parameters[] = $_GET['sex'];
				}

				if (!empty($_GET['car']))
				{

					// here we are using not equality
					$conditions[] = 'car != ?';
					$parameters[] = $_GET['car'];
				}

				if (!empty($_GET['date_start']) && $_GET['date_end'])
				{

					// BETWEEN
					$conditions[] = 'date BETWEEN ? AND ?';
					$parameters[] = $_GET['date_start'];
					$parameters[] = $_GET['date_end'];
				}

				// the main query
				$sql = "SELECT * FROM users";

				// a smart code to add all conditions, if any
				if ($conditions)
				{
					$sql .= " WHERE ".implode(" AND ", $conditions);
				}

				// the usual prepare/bind/execute/fetch routine
				$stmt = $mysqli->prepare($sql);
				$stmt->bind_param(str_repeat("s", count($parameters)), ...$parameters);
				$stmt->execute();
				$data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		*/
	}
?>