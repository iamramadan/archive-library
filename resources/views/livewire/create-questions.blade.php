<div>
    <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Add New Question</h2>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Question {{$index + 1}}</label>
                    <input type="text" 
                            @if(isset($this->questionArray[$index]))
                                 value="{{$this->questionArray[$index]['question']}}"
                            @endif
                    wire:model="Question" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>
                <div class="space-y-4">
                    <div class="border-l-4 border-blue-500 pl-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Correct Option</h3>
                        <select wire:model="correct_option"  placeholder="Question text" class="w-full px-4 py-2 rounded-lg border border-gray-200 mb-3 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                            <option value="4">Option 4</option>
                        </select>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                            <input type="text" placeholder="Option 1"
                            wire:model="Option1"
                            @if(isset($this->questionArray[$index]))
                            value="{{$this->questionArray[$index]['option1']}}"
                            @endif
                                   class="px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">

                            <input type="text" placeholder="Option 2"
                            @if(isset($this->questionArray[$index]))
                            value="{{$this->questionArray[$index]['option2']}}"
                            @endif
                            wire:model="Option2"
                                   class="px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">

                            <input type="text" placeholder="Option 3"
                            @if(isset($this->questionArray[$index]))
                            value="{{$this->questionArray[$index]['option3']}}"
                            @endif
                                wire:model="Option3"
                                   class="px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">

                            <input type="text" placeholder="Option 4"
                            @if(isset($this->questionArray[$index]))
                            value="{{$this->questionArray[$index]['option4']}}"
                            @endif
                                wire:model="Option4"
                                   class="px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <button type="button" class="text-blue-600 hover:text-blue-700 flex items-center" wire:click="addQuestions">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Question
                    </button>

                    <div class="space-x-3">
                        <a type="button" class="px-4 py-2 text-gray-600 hover:text-gray-800" href="{{route('index')}}">Cancel</a>
                        <button wire:click="submit" type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                            Save Questionnaire
                        </button>
                    </div>
                </div>
            </div>
        </div>
                <div class="grid grid-cols-10 gap-2 p-6 bg-white my-2 rounded-xl shadow-lg">
                    
                    @php
                        $i = 1;
                    @endphp
                    @foreach($questionArray as $question)
                    <button wire:click="setindex({{$i}})" class="w-8 h-8 rounded-full bg-blue-500 text-white text-xl font-bold">{{$i}}</button>
                    @php
                     $i ++;
                    @endphp
                    @endforeach
                </div>
</div>
                                        {{-- {{dd()}} --}}

