<?php
require_once "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = 0;
    $totalQuestions = 0;
    $userAnswers = [];

    
    $stmt = $pdo->prepare('SELECT * FROM questions_answer');
    $stmt->execute();
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($questions as $question) {
        $totalQuestions++;
        $correctAnswer = $question['answer'];
        $userAnswer = $_POST['answer_' . $question['id']] ?? null;
        $userAnswers[$question['id']] = $userAnswer;

        if ($userAnswer === $correctAnswer) {
            $score++;
        }
    }

    echo '<!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Your Score</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css"> <!-- Link to the CSS file -->
    </head>
    <body>
        <div class="container mt-5 score-board">
            <h1>Your Score: ' . $score . ' out of ' . $totalQuestions . '</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Your Answer</th>
                        <th>Correct Answer</th>
                    </tr>
                </thead>
                <tbody>';
                
    foreach ($questions as $question) {
        echo '<tr>
                <td>' . $question['question'] . '</td>
                <td>' . ($userAnswers[$question['id']] ?? 'No answer') . '</td>
                <td>' . $question['answer'] . '</td>
              </tr>';
    }

    echo '      </tbody>
            </table>
            <a href="index.php" class="btn btn-primary">Go Back</a>
        </div>
    </body>
    </html>';
} else {
    echo "Invalid request.";
}
?>
