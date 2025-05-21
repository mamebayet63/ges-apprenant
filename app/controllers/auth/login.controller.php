<?php
// email: admin@odc.sn
// mot de passe : admin123

function findUserConnect(string $email, string $password): ?array {
    global $connect;

    $pdo = $connect();
    $query = $pdo->prepare("SELECT * FROM utilisateur WHERE email = :email");
    $query->bindParam(':email', $email);
    $query->execute();
    
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['mot_de_passe'])) {
        return $user;
    }

    return null;
}

function login(): void {
    global $errors, $email;
    $errors = [];
    $email = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';

        // Validation
        if (empty($email)) {
            $errors['email'] = "L'adresse email est obligatoire";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Format d'email invalide";
        }

        if (empty($password)) {
            $errors['password'] = "Le mot de passe est obligatoire";
        }

        if (empty($errors)) {
            $user = findUserConnect($email, $password);
            if ($user) {
                $_SESSION['user'] = $user;

                // Redirection selon le rôle
                // $routes = [
                //     'admin' => 'rp',
                // ];

                // $role = strtolower($user['role']);
                $controller = "promo" ?? 'home';

                header("Location: index.php?controller=$controller");
                exit();
            } else {
                $errors['auth'] = "Email ou mot de passe incorrect.";
            }
        }
    }

    require_once(ROOT_PATH . "/app/views/auth/login.html.php");
}

function logout(): void {
    session_destroy();
    header("Location: ?controller=security&page=login");
    exit();
}

ob_start();

$page = $_REQUEST["page"] ?? "login"; 

switch ($page) {
    case 'login':
        login();
        break;
    case 'logout':
        logout();
        break;
    default:
        echo "Page introuvable";
}

$content = ob_get_clean();
require_once(ROOT_PATH . "/app/views/layout/security.layout.php");
