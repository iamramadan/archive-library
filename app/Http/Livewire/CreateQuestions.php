<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateQuestions extends Component
{
    public $questionNo;

    public function AddQuestion(array $newquestion){
        $questionArray[] = $newquestion;
    }
    public function render()
    {
        return view('livewire.create-questions');
    }
}
