<?php
class Reports extends Controller {
  public function index() {
    session_start();
      
      // ACL: Only allow "admin" user
      if (!isset($_SESSION['auth']) || strtolower($_SESSION['username'] ?? '') !== 'admin') {
          header('Location: /login');
          exit;
      }
    $db = db_connect();

    // Get all users with reminder count and login count
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

    // Get the user with the most reminders
    $stmt2 = $db->query("
        SELECT users.username, COUNT(notes.id) AS reminder_count
        FROM users
        JOIN notes ON notes.user_id = users.id
        GROUP BY users.username
        ORDER BY reminder_count DESC
        LIMIT 1
    ");
    $topUser = $stmt2->fetch(PDO::FETCH_ASSOC);

    // Pass data to the view
    $this->view('reports/index', [
        'users' => $users,
        'topUser' => $topUser
    ]);
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
    public function chart() {
        session_start();
        $db = db_connect();

        // Get number of reminders per user
        $stmt = $db->query("
            SELECT users.username, COUNT(notes.id) AS reminder_count
            FROM users
            LEFT JOIN notes ON notes.user_id = users.id
            GROUP BY users.username
        ");
        $reminderData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->view('reports/chart', ['reminderData' => $reminderData]);
    }
}
