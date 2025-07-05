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
  public function edit($id) {
      session_start();
      $user_id = $_SESSION['user_id'] ?? null;
      if (!$user_id) {
          header('Location: /login');
          exit;
      }

      $reminderModel = $this->model('Reminder');
      $reminder = $reminderModel->get_reminder_by_id($id);

      if (!$reminder || $reminder['user_id'] != $user_id) {
          $_SESSION['edit_message'] = "Reminder not found or access denied.";
          header('Location: /reminders');
          exit;
      }

      $this->view('reminders/edit', ['reminder' => $reminder]);
  }
  public function update($id) {
      
      $user_id = $_SESSION['user_id'] ?? null;
      if (!$user_id) {
          header('Location: /login');
          exit;
      }

      $subject = trim($_POST['subject'] ?? '');
      if ($subject === '') {
          $_SESSION['edit_message'] = "Subject cannot be empty.";
          header("Location: /reminders/edit/$id");
          exit;
      }

      $reminderModel = $this->model('Reminder');
      $reminder = $reminderModel->get_reminder_by_id($id);

      if (!$reminder || $reminder['user_id'] != $user_id) {
          $_SESSION['edit_message'] = "Reminder not found or access denied.";
          header('Location: /reminders');
          exit;
      }

      $reminderModel->update_reminder($id, $subject);
      $_SESSION['edit_message'] = "Reminder updated successfully!";
      header('Location: /reminders');
      exit;
  }
  public function delete($id) {
      session_start();
      $user_id = $_SESSION['user_id'] ?? null;
      if (!$user_id) {
          header('Location: /login');
          exit;
      }

      $reminderModel = $this->model('Reminder');
      $reminder = $reminderModel->get_reminder_by_id($id);

      if (!$reminder || $reminder['user_id'] != $user_id) {
          $_SESSION['delete_message'] = "Reminder not found or access denied.";
          header('Location: /reminders');
          exit;
      }

      $reminderModel->delete_reminder($id);
      $_SESSION['delete_message'] = "Reminder deleted successfully!";
      header('Location: /reminders');
      exit;
  }
}