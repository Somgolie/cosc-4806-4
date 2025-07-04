<?php

class Reminder {

    public function __construct() {

    }

    public function get_reminders () {
      $db = db_connect();
      $statement = $db->prepare("SELECT id, user_id, subject, time_created FROM reminders ORDER BY time_created DESC;");
      $statement->execute();
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }
    public function update_reminder ($reminder_id) {
      $db = db_connect();

    }
}
?>