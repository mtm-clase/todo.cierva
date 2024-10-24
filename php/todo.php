<?php
class Todo implements \JsonSerializable {
    private int $item_id;
    private string $content;

        public function parametersConstruct(int $item_id, string $content){
        $this->item_id = $item_id;
        $this->content = $content;
    }

    public function jsonConstruct($json) {
        foreach (json_decode($json, true) as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }

    public static function DB_selectAll($dbconn){
        $todo_list = array();
        foreach($dbconn->query("SELECT item_id, content FROM todo_list") as $row) {
            $new_todo = new Todo;
            $new_todo->parametersConstruct($row['item_id'],$row['content']);
            $todo_list[]=$new_todo;
        }
        return $todo_list;
    }

    public function DB_insert($db) {
        $task=$this->content;
        $sql = "INSERT INTO `todo_list` (content) VALUES('$task')";
        if (!($db->query($sql) === TRUE)) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>
