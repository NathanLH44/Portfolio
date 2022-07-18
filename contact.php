<?php
    require_once(__DIR__.'/vendor/autoload.php');
    use \Mailjet\Resources;

    define('API_USER', '24b83136888e260a700211b3218d0858');
    define('API_LOGIN', 'fcc54307d890428a5b7a93a330143c41');
    $mj = new \Mailjet\Client(API_USER, API_LOGIN, true,['version' => 'v3.1']);

    if (!empty($_POST['name']) && !empty($_POST['subject']) && !empty($_POST['email']) && !empty($_POST['message'])) {
        $name = htmlspecialchars($_POST['name']);
        $subject = htmlspecialchars($_POST['subject']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $body = [
                'Messages' => [
                [
                    'From' => [
                    'Email' => "nathan1.douillet@epitech.eu",
                    'Name' => "$name"
                    ],
                    'To' => [
                    [
                        'Email' => "nathan.douillet08000@gmail.com",
                        'Name' => "Nathan"
                    ]
                    ],
                    'Subject' => "$subject",
                    'TextPart' => "$email, $message",
                ]
                ]
            ];
                $response = $mj->post(Resources::$Email, ['body' => $body]);
                $response->success();
                echo "Email envoyé avec succès !";
                echo PHP_EOL;
                echo "<a href=". "./" . ">Retour</a>";
        } else {
            echo "Email non valide";
        }
    } else {
        header('Location:index.php');
        die();
    } 