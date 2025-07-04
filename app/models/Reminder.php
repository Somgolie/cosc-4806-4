<?php

class Reminder {

    public function __construct() {

    }

    public function get_reminders () {
      $db = db_connect();
      $statement = $db->prepare("select * from users;");
      $statement->execute();
      $rows = $statement->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }
    public function update_reminder ($reminder_id) {
      $db = db_connect();
    }
?>