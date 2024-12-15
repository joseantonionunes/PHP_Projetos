<?php 

defined('CONTROL') or die('Acesso negado');

// go to the next game
if (isset($_GET['next'])){

    // increment the game number
    $_SESSION['game_number']++;

    // reser the game board
    $_SESSION['game_board'] = [
        ['','',''],
        ['','',''],
        ['','','']
    ];

    // reset the game turn
    $_SESSION['game_turn'] = 1;

    // alternate the active player
    $_SESSION['active_player'] = $_SESSION['active_player'] == 1 ? 2 : 1;

    // go to the game
    header('Location: index.php?route=game');
}

// when the player clicks on a cell
if (isset($_GET['player']) && isset($_GET['x']) && isset($_GET['y'])){

    $player = $_GET['player'];
    $x = $_GET['x'];
    $y = $_GET['y'];
    $winner = null;

    //  check if there is already a symbol in the cell
    if (empty($_SESSION['game_board'][$x][$y])){
        
    }

}

