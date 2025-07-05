<?php

class Reminder {

    public function __construct() {

    }

    public function get_reminders () {
      $db = db_connect();
      $statement = $db->prepare("SELECT * FROM reminders;");
      $statement->execute();
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }

    public function update_reminder ($reminder_id) {
      $db = db_connect();

    }
    public function create_reminder($user_id, $subject) {
        $db = db_connect();
        $stmt = $db->prepare("INSERT INTO reminders (user_id, subject, time_created) VALUES (:user_id, :subject, NOW())");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
?>