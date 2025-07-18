<?php
class Reports extends Controller {
  public function index() {
      session_start();

      $db = db_connect();
      $stmt = $db->query("
          SELECT users.id, users.username, COUNT(notes.id) AS reminder_count
          FROM users
          LEFT JOIN notes ON notes.user_id = users.id
          GROUP BY users.id, users.username
          ORDER BY users.username ASC
      ");
      $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $this->view('reports/index', ['users' => $users]);
  }
  

    public function user($id) {
        session_start();

        $reminderModel = $this->model('Reminder');
        $reminders = $reminderModel->get_reminders_by_user($id);

        $db = db_connect();
        $stmt = $db->prepare("SELECT username FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->view('reports/user_reminders', [
            'reminders' => $reminders,
            'username' => $user['username'] ?? 'Unknown'
        ]);
    }
}
