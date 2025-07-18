<?php
class Reports extends Controller {
  public function index() {
    session_start();

    $db = db_connect();
    $stmt = $db->query("
        SELECT 
            users.id, 
            users.username,
            COUNT(DISTINCT notes.id) AS reminder_count,
            COUNT(DISTINCT CASE WHEN login_Attempts.attempt = 1 THEN login_Attempts.time END) AS login_count
        FROM users
        LEFT JOIN notes ON notes.user_id = users.id
        LEFT JOIN login_Attempts ON login_Attempts.username = users.username
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
