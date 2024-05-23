<?php


class Choice
{
    public $name;
    public $winsAgainst;

    public function __construct($name, $winsAgainst)
    {
        $this->name = $name;
        $this->winsAgainst = $winsAgainst;
    }

    public function beats($otherChoice)
    {
        return in_array($otherChoice->name, $this->winsAgainst);
    }
}

class Game
{
    private $choice;
    private $playerChoice;
    private $computerChoice;

    public function __construct()
    {
        $this->choice = [
            'rock' => new Choice('rock', ['scissors', 'lizard']),
            'paper' => new Choice('paper', ['rock', 'spock']),
            'scissors' => new Choice('scissors', ['paper', 'lizard']),
            'lizard' => new Choice('lizard', ['paper', 'spock']),
            'spock' => new Choice('spock', ['rock', 'scissors'])
        ];
    }

    public function play()
    {
        $this->getPlayerChoice();
        $this->getComputerChoice();
        $this->getWinner();
    }

    private function getPlayerChoice()
    {
        $input = strtolower(trim(readline("Choose Rock, Paper, Scissors, Lizard, Spock: ")));
        if (!isset($this->choice[$input])) {
            echo "Invalid choice. Please try again.\n";
            exit;
        }
        $this->playerChoice = $this->choice[$input];
    }

    private function getComputerChoice()
    {
        $randomIndex = array_rand($this->choice);
        $this->computerChoice = $this->choice[$randomIndex];
    }

    private function getWinner()
    {
        echo "You chose: " . $this->playerChoice->name . "\n";
        echo "Computer chose: " . $this->computerChoice->name . "\n";

        if ($this->playerChoice->name === $this->computerChoice->name) {
            echo "This is a draw!\n";
        } elseif ($this->playerChoice->beats($this->computerChoice)) {
            echo "You win!\n";
        } else {
            echo "You lose!\n";
        }
    }
}

$game = new Game();
$game->play();