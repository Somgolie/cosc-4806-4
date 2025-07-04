<?php
class reminders extends Controller{
  public function index(){
    $reminder = $this->model('Reminder');
    $list_reminders = $reminder->get_reminders();
    print_r($list_reminders);
    die;
    $this->view('reminders/index');
  }
  
}