<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SearchResults extends Component
{
    public $notes = '';
    public $resources = '';
    public $questionaires = '';
    public $all = '';
    public $query = '';
    public $showing = 'notes';

    public function mount($notes,$resources,$questionaires,$all,$query){
            $this->notes = $notes;
            $this->resources = $resources;
            $this->questionaires = $questionaires;
            $this->all = $all;
            $this->query = $query;
    }
    public function show($showing){
        $this->showing = $showing;
    }
    
    public function render()
    {
        
        return view('livewire.search-results');
    }
}
