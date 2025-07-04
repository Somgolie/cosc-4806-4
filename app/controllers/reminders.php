<?php
class reminders extends Controller{
  public function index(){
    $username = $_SESSION['username'] ?? null;
    
    $reminder = $this->model('Reminder');
    $list_reminders = $reminder->get_reminders();
    $this->view('reminders/index', ['reminders' => $list_reminders]);
  }
  
}