<?php

namespace App\Http\Livewire;

use App\Models\Note;
use Livewire\Component;
use App\Models\Resources;
use App\Models\Questionaires;

class ContentToggler extends Component
{
    public $InstitutionId;
    public $content;
    public $contentDisplayed = 'resources';

    public function mount($InstitutionId)
    {
        $this->InstitutionId = $InstitutionId;
    }

    public function sort($content)
    {
        $model = match ($content) {
            'questionaires' => Questionaires::class,
            'note' => Note::class,
            'resources' => Resources::class,
            default => null,
        };
        $this->contentDisplayed = $content;
        if ($model) {
            $this->SetContent($model);
        }
    }

    public function SetContent($modelClass)
    {
        $this->content = $modelClass::where('author', $this->InstitutionId)->get();
    }

    public function render()
    {
        return view('livewire.content-toggler',[
             
        'content' => $this->content,
    
        ]);
    }
}
