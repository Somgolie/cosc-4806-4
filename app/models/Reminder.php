<?php

class Reminder {

    public function __construct() {

    }

    public function get_reminders () {
      $db = db_connect();
      $statement = $db->prepare("SELECT * FROM notes;");
      $statement->execute();
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }


    public function create_reminder($user_id, $subject) {
        $db = db_connect();
        $stmt = $db->prepare("INSERT INTO notes (user_id, subject, time_created) VALUES (:user_id, :subject, NOW())");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
        return $stmt->execute();
    }
  public function get_reminder_by_id($id) {
      $db = db_connect();
      $stmt = $db->prepare("SELECT * FROM notes WHERE id = :id");
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function update_reminder($id, $subject) {
      $db = db_connect();
      $stmt = $db->prepare("UPDATE notes SET subject = :subject WHERE id = :id");
      $stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      return $stmt->execute();
  }
  public function delete_reminder($id) {
      $db = db_connect();
      $stmt = $db->prepare("DELETE FROM notes WHERE id = :id");
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      return $stmt->execute();
  }
}
?>