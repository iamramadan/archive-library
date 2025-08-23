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
        $this->content = Resources::where('system', $InstitutionId)->paginate(10);
        $this->InstitutionId = $InstitutionId;
    }

    public function sort($content)
    {
        $this->contentDisplayed = $content;
        $model = match ($this->contentDisplayed) {
            'questionaires' => Questionaires::class,
            'note' => Note::class,
            'resources' => Resources::class,
            default => null,
        };
        if ($model) {
            $this->SetContent($model);
        }
    }

    public function SetContent($modelClass)
    {
        $this->content = $modelClass::where('system', $this->InstitutionId)->paginate(10);
    }

    public function render()
    {
        return view('livewire.content-toggler',[

        'content' => $this->content,

        ]);
    }
}
