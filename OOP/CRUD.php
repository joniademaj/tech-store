<?php include("../database/dbConnection.php"); ?>

<?php 
    class CRUD {

        public function __construct($pdo){
            $this->pdo = $pdo;
        }

        public function insert($tableName, $columns = [], $values = []){
            $sql = "INSERT INTO " . $tableName . " 
            (" . $this->columns($columns) . ") VALUES (" . $this->question_marks($values) . ")";
            echo $sql;
        }

        public function columns($columns = []){
            if(count($columns) == 0) return "*";
            return implode(', ', $columns);
        }

        public function question_marks($values){
            $marks = str_repeat('?, ', count($values));
            $length = strlen($marks) - 2;

            return substr($marks, 0, $length);
        }

        public function print($word){
            echo $word;
        }
    }

    $db = new CRUD($pdo);

    $db->print("Hello");
?>