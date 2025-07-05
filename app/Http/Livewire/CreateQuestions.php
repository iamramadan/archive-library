<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Questions;

class CreateQuestions extends Component
{
    public $Title;
    public $Goal;
    public $Question;
    public $Option1;
    public $Option2;
    public $Option3;
    public $Option4;
    public $correct_option;
    public $QuestionaireId;
    public $questionArray = [];
    public $index = 0;
    public $msg = '';
    public $isloading = false;
    public function mount($id){
        $this->QuestionaireId = $id;
    }

    public function addQuestions(){
        $this->questionArray[$this->index] = [
            'question'=>$this->Question,
            'option1' => $this->Option1,
            'option2' => $this->Option2,
            'option3' => $this->Option3,
            'option4' => $this->Option4,
            'questionaire'=>$this->QuestionaireId,
            'correct_option' => $this->correct_option
        ];
        $this->clear();
        $this->index++;
    }
    public function clear(){
        $this->Question = '';
        $this->Option1 = '';
        $this->Option2 = '';
        $this->Option3 = '';
        $this->Option4 = '';
        $this->correct_option = '';
    }
    public function back(){
     $this->index--;
    }
    public function setindex($index){
     $this->index = $index;
    }

    public function submit(){
        if(count($this->questionArray) > 20){
            $this->msg = 'Questions Should Not Exceed 20';
            return;
        }
        $this->isloading = true;
        foreach ($this->questionArray as $question) {
            Questions::create($question);
        }
        $this->isloading = false;
        return redirect()->route('index');
    }
    public function render()
    {
        return view('livewire.create-questions');
    }
}
