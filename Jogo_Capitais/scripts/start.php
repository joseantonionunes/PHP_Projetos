<?php 

// check if there was a post to initialize the game
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // get total questions
    $total_questions = intval($_POST['text_total_questions']) ?? 10;

    prepare_game($total_questions);

    // redirect to game
    header('Location: index.php?route=game');
    exit;
}

function prepare_game($total_questions)
{
    global $capitals;

    // get random items
    $ids = [];
    while(count($ids) < $total_questions) {
        $id = rand(0, count($capitals) - 1);
        if(!in_array($id, $ids)) {
            $ids[] = $id;
        }
    }

    // define first data for $questions
    $questions = [];
    foreach($ids as $id) {
        
        //get correct answer and two incorrect answers
        $answers = [];
        $answers[] = $id;
        while(count($answers) < 3) {
            $tmp = rand(0, count($capitals) - 1);
            if(!in_array($tmp, $answers)) {
                $answers[] = $tmp;
            }
        }

        // add 3 possible answers to the question
        shuffle($answers);

        // add question to $questions
        $questions[] = [
            'question' => $capitals[$id][0],    // country
            'correct_answer' => $id,            // $capitals[$id][1] => capital
            'answers' => $answers               // collection of 3 possible answers. One of them is correct.
        ];

    }

    // save data to session
    $_SESSION['questions'] = $questions;

    // initialize score
    $_SESSION['game'] = [
        'total_questions' => $total_questions,
        'current_question' => 0,
        'correct_answers' => 0,
        'incorrect_answers' => 0,
    ];
}

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card p-5">

                <div class="row">
                    <div class="col text-center">
                        <h3>Jogo das Capitais</h3>
                        <hr>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-4">
                        <form action="index.php?route=start" method="post">
                            <div class="mb-3">
                                <label for="text_total_questions" class="form-label">Número de questões:</label>
                                <input type="number" class="form-control form-control-lg text-center" id="text_total_questions" name="text_total_questions" value="10" min="1" max="20">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success w-100">Iniciar</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>