<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Statistic;

class Game extends Component
{
    public $board = [];
    public $currentPlayer = 'X'; // Pemain pertama
    public $winner = null; // Status pemenang
    public $draw = false;
    public $difficulty = 'easy'; // Default tingkat kesulitan

    public function mount()
    {
        $this->resetBoard();
    }

    public function resetBoard()
    {
        $this->board = array_fill(0, 3, array_fill(0, 3, null)); 
        $this->currentPlayer = 'X'; 
        $this->winner = null;
        $this->draw = false;
    }

    public function play($row, $col)
    {
        if ($this->board[$row][$col] || $this->winner) {
            return; 
        }

        $this->board[$row][$col] = $this->currentPlayer;
        $this->checkWinner();

        if (!$this->winner) {
            $this->currentPlayer = $this->currentPlayer === 'X' ? 'O' : 'X'; 
            if ($this->currentPlayer === 'O') {
                $this->botMove(); 
            }
        }
    }

    public function botMove()
    {
        $availableMoves = [];
        foreach ($this->board as $row => $cols) {
            foreach ($cols as $col => $value) {
                if (!$value) {
                    $availableMoves[] = [$row, $col];
                }
            }
        }

        if (!empty($availableMoves)) {
            if ($this->difficulty === 'easy') {
                $move = $availableMoves[array_rand($availableMoves)];
            } elseif ($this->difficulty === 'medium') {
                $move = $this->findBestMove($availableMoves, 'X') ?? $availableMoves[array_rand($availableMoves)];
            } elseif ($this->difficulty === 'hard') {
                $move = $this->findBestMove($availableMoves, 'O') ?? $this->findBestMove($availableMoves, 'X') ?? $availableMoves[array_rand($availableMoves)];
            }
            $this->play($move[0], $move[1]);
        }
    }

    public function findBestMove($availableMoves, $player)
    {
        foreach ($availableMoves as [$row, $col]) {
            $this->board[$row][$col] = $player;
            if ($this->isWinningMove($player)) {
                $this->board[$row][$col] = null;
                return [$row, $col];
            }
            $this->board[$row][$col] = null;
        }
        return null;
    }

    public function isWinningMove($player)
    {
        $winningCombos = [
            [[0, 0], [0, 1], [0, 2]],
            [[1, 0], [1, 1], [1, 2]],
            [[2, 0], [2, 1], [2, 2]],
            [[0, 0], [1, 0], [2, 0]],
            [[0, 1], [1, 1], [2, 1]],
            [[0, 2], [1, 2], [2, 2]],
            [[0, 0], [1, 1], [2, 2]],
            [[0, 2], [1, 1], [2, 0]],
        ];

        foreach ($winningCombos as $combo) {
            [$a, $b, $c] = $combo;

            if (
                $this->board[$a[0]][$a[1]] === $player &&
                $this->board[$b[0]][$b[1]] === $player &&
                $this->board[$c[0]][$c[1]] === $player
            ) {
                return true;
            }
        }
        return false;
    }

    public function checkWinner()
{
    $winningCombos = [
        [[0, 0], [0, 1], [0, 2]],
        [[1, 0], [1, 1], [1, 2]],
        [[2, 0], [2, 1], [2, 2]],
        [[0, 0], [1, 0], [2, 0]],
        [[0, 1], [1, 1], [2, 1]],
        [[0, 2], [1, 2], [2, 2]],
        [[0, 0], [1, 1], [2, 2]],
        [[0, 2], [1, 1], [2, 0]],
    ];

    foreach ($winningCombos as $combo) {
        [$a, $b, $c] = $combo;

        if (
            $this->board[$a[0]][$a[1]] &&
            $this->board[$a[0]][$a[1]] === $this->board[$b[0]][$b[1]] &&
            $this->board[$a[0]][$a[1]] === $this->board[$c[0]][$c[1]]
        ) {
            $this->winner = $this->board[$a[0]][$a[1]];
            $this->updateStatistics($this->winner === 'X' ? 'win' : 'loss');
        }
    }

    if (collect($this->board)->flatten()->every(fn($cell) => $cell)) {
        $this->draw = true;
        $this->updateStatistics('draw');
    }
}


    public function updateStatistics($result)
    {
        $stats = Statistic::where('user_id', auth()->id())->first();
        if ($stats) {
            if ($result === 'win') $stats->increment('wins');
            if ($result === 'loss') $stats->increment('losses');
            if ($result === 'draw') $stats->increment('draws');
        }
    }

    public function render()
    {
        return view('livewire.game');
    }
}
