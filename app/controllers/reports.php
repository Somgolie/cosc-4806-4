<?php
class Reports extends Controller {
  public function index() {
    session_start();

    $reminderModel = $this->model('Reminder');
    $reminders = $reminderModel->get_reminders();  // assumes this returns all reminders

    $this->view('reports/index', ['reminders' => $reminders]);
  }
}
