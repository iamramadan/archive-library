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
    public $correct_option = 1;
    public $QuestionaireId;
    public $questionArray = [];
    public $index = 0;
    public $msg = '';
    public $isloading = false;
    public $updating = false;
    public function mount($id,array $questions =[]){
        if(!empty($questions)){
            $this->questionArray = $questions;
            $this->updating = true;
            $this->setindex(count($questions) - 1);
        }
        $this->QuestionaireId = $id;
    }

    public function hasEmptyFields() {
    return empty($this->Option1) ||
           empty($this->Option2) ||
           empty($this->Option3) ||
           empty($this->Option4) ||
           empty($this->correct_option) ||
           empty($this->Question);
}

    public function addQuestions(){
        if ($this->hasEmptyFields() || count($this->questionArray) >= 20) {
            $this->msg = 'Some feilds are empty fill them up.';
        } else {
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
            $this->msg = '';
            $this->index++;
        }
    }
    public function clear(){
        $this->Question = '';
        $this->Option1 = '';
        $this->Option2 = '';
        $this->Option3 = '';
        $this->Option4 = '';
        $this->correct_option = 1;
    }
    public function back(){
     $this->index--;
    }
    public function setindex($index){
        $this->index = $index;
           $this->Question = $this->questionArray[$this->index]['question'];
           $this->Option1 = $this->questionArray[$this->index]['option1'];
           $this->Option2 = $this->questionArray[$this->index]['option2'];
           $this->Option3 = $this->questionArray[$this->index]['option3'];
           $this->Option4 = $this->questionArray[$this->index]['option4'];
           $this->correct_option = $this->questionArray[$this->index]['correct_option'];
           $this->msg = '';
    }


    public function submit(){
        $this->isloading = true;
        $this->addQuestions();
        if(count($this->questionArray) > 20){
            $this->msg = 'Questions Should Not Exceed 20';
            return;
        }
        Questions::where('questionaire',$this->QuestionaireId)->delete();
        foreach ($this->questionArray as $question) {
            Questions::Create(
            $question
        );
        }
        return redirect()->route('pages.questionaire',['id'=>$this->QuestionaireId]);
    }
    public function render()
    {
        return view('livewire.create-questions');
    }
}
