<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SearchResults extends Component
{
    public $notes;
    public $resources;
    public $questionaires;
    public $all;
    public $showing;

    public function mount(array $results){
            $this->notes = $results['notes'];
            $this->resources = $results['resources'];
            $this->questionaires = $results['questionaires'];
            $this->all = $results['all'];
    }
    public function show($showing){
        $this->showing = $showing;
    }
    
    public function render()
    {
        
        return view('livewire.search-results');
    }
}
