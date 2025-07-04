<?php
class reminders extends Controller{
  public function index(){
    $reminder = $this->model('Reminder');
    $list_reminders = $reminder->get_reminders();
    $this->view('reminders/index', ['reminders' => $list_reminders]);
  }
  
}