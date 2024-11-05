<?php
require_once "connection.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Question Paper</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anta&family=Rubik+Wet+Paint&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container bg-white rounded shadow mt-5 p-4">
        <h1 class="text-center" style="font-family: 'Shrikhand', cursive;">QUESTION PAPER</h1>

        <?php
        $stmt = $pdo->prepare('SELECT * FROM questions_answer');
        $stmt->execute();
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <form action="score.php" method="post">
            <?php
            $questionNumber = 1; 
            foreach ($questions as $question) {
                echo '<div class="mb-4">';
                echo '<h5>' . $questionNumber . '. ' . $question['question'] . '</h5>'; 

                echo '<div class="form-check">';
                echo '<input class="form-check-input" type="radio" name="answer_' . $question['id'] . '" value="' . $question['option1'] . '" id="option1_' . $question['id'] . '">';
                echo '<label class="form-check-label" for="option1_' . $question['id'] . '">' . $question['option1'] . '</label>';
                echo '</div>';

                echo '<div class="form-check">';
                echo '<input class="form-check-input" type="radio" name="answer_' . $question['id'] . '" value="' . $question['option2'] . '" id="option2_' . $question['id'] . '">';
                echo '<label class="form-check-label" for="option2_' . $question['id'] . '">' . $question['option2'] . '</label>';
                echo '</div>';

                echo '<div class="form-check">';
                echo '<input class="form-check-input" type="radio" name="answer_' . $question['id'] . '" value="' . $question['option3'] . '" id="option3_' . $question['id'] . '">';
                echo '<label class="form-check-label" for="option3_' . $question['id'] . '">' . $question['option3'] . '</label>';
                echo '</div>';

                echo '<div class="form-check">';
                echo '<input class="form-check-input" type="radio" name="answer_' . $question['id'] . '" value="' . $question['option4'] . '" id="option4_' . $question['id'] . '">';
                echo '<label class="form-check-label" for="option4_' . $question['id'] . '">' . $question['option4'] . '</label>';
                echo '</div>';

                echo '</div>';
                $questionNumber++;
            }
            ?>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
