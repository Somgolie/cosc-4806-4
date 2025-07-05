<?php
class reminders extends Controller{
  public function index(){
    $username = $_SESSION['username'] ?? null;
    
    $reminder = $this->model('Reminder');
    $list_reminders = $reminder->get_reminders();
    $this->view('reminders/index', ['reminders' => $list_reminders]);
  }
  public function create() {
      $this->view('reminders/create');
  }
  public function store() {
      $user_id = $_SESSION['user_id'] ?? null;
      if (!$user_id) {
          header('Location: /login');
          exit;
      }

      $subject = trim($_POST['subject'] ?? '');

      if ($subject === '') {
          $_SESSION['create_message'] = "Subject cannot be empty.";
          header('Location: /reminders/create');
          exit;
      }

      $reminderModel = $this->model('Reminder');
      $reminderModel->create_reminder($user_id, $subject);

      $_SESSION['create_message'] = "Reminder created successfully!";
      header('Location: /reminders');
      exit;
  }
}