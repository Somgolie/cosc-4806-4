<?php
class reminders extends Controller{
  public function index(){
    $username = $_SESSION['username'] ?? null;

    if (!$username) {
        echo 'Please <a href="/login" style="color: blue;">log in</a> to view reminders.';
        exit;
    }
    
    $reminder = $this->model('Reminder');
    $list_reminders = $reminder->get_reminders();
    $this->view('reminders/index', ['reminders' => $list_reminders]);
  }
  
}