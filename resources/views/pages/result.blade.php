@extends('layout.main')
@push('links')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        secondary: '#0ea5e9',
                        dark: '#1e293b',
                        light: '#f8fafc',
                        success: '#10b981',
                        warning: '#f59e0b',
                        danger: '#ef4444'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            /* background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); */
            min-height: 100vh;
        }
        
        .result-card {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            border-radius: 16px;
            background: white;
        }
        
        .result-card:before, .result-card:after {
            content: '';
            position: absolute;
            width: 60px;
            height: 60px;
            background: #f0f9ff;
            border-radius: 50%;
            opacity: 0.3;
        }
        
        .result-card:before {
            top: -20px;
            right: -20px;
        }
        
        .result-card:after {
            bottom: -20px;
            left: -20px;
        }
        
        .answer-correct {
            border-left: 4px solid #10b981;
        }
        
        .answer-incorrect {
            border-left: 4px solid #ef4444;
        }
        
        .comment-card {
            animation: fadeIn 0.5s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .tab-button {
            transition: all 0.2s ease;
            border-bottom: 3px solid transparent;
            padding: 12px 0;
            margin: 0 20px;
        }
        
        .tab-button.active {
            border-color: #2563eb;
            color: #2563eb;
        }
        
        .tab-button:hover:not(.active) {
            border-color: #cbd5e1;
        }
    </style>
@endpush
@section('main')
    <main class="max-w-4xl mx-auto px-4 py-8">
        <!-- Result Summary -->
        {{-- @dd($questionaireResult->result[0]->your_answers[1]) --}}
        <div class="result-card p-6 mb-8 text-center">
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Quiz Completed Successfully!</h2>
            <p class="text-gray-600 mb-6">You scored <span class="font-bold text-primary">{{$questionaireResult->result[0]->result}}/{{$questionaireResult->questions->count()}}</span> ({{$questionaireResult->result[0]->score}}) on the <b>{{$questionaireResult->name}}</b> quiz</p>
            
            <div class="flex justify-center gap-6 mb-8">
                <div class="bg-blue-50 p-4 rounded-lg">
                    <div class="text-3xl font-bold text-primary">{{$questionaireResult->result[0]->result}}</div>
                    <div class="text-gray-600">Correct Answers</div>
                </div>
                <div class="bg-red-50 p-4 rounded-lg">
                    <div class="text-3xl font-bold text-red-500">{{$questionaireResult->questions->count() - $questionaireResult->result[0]->result}}</div>
                    <div class="text-gray-600">Incorrect Answers</div>
                </div>
                <div class="bg-green-50 p-4 rounded-lg">
                    <div class="text-3xl font-bold text-green-500">{{$questionaireResult->result[0]->score}}%</div>
                    <div class="text-gray-600">Overall Score</div>
                </div>
            </div>
        </div>
        
        <!-- Tabs -->
        <div class="flex border-b border-gray-300 mb-6">
            <button class="tab-button active">
                <i class="fas fa-clipboard-list mr-2"></i>Question Review
            </button>
        </div>
        
        <!-- Question Review Section -->
        <div id="review-section">
            <div class="result-card p-6 mb-6">
                <h3 class="text-xl font-bold text-dark mb-4">Question Analysis</h3>
                
                <!-- Question 1 -->
                @php
                    $index = 1;
                    $toAlpha = ['1'=>'a',
                                '2'=>'b',
                                '3'=>'c',
                                '4'=>'d'
                    ];
                    $option = ['1'=>'option1',
                                '2'=>'option2',
                                '3'=>'option3',
                                '4'=>'option4'
                    ];
                @endphp
                @foreach ($questionaireResult->questions as $questions)   
                <div class="answer-correct mb-6 p-4 bg-white border rounded-lg">
                    <div class="flex items-start mb-3">
                        <div class="bg-green-100 text-green-800 rounded-full w-8 h-8 flex items-center justify-center mr-3">
                            <i class="fas fa-check"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Question {{$index}}: {{$questions->question}}</h4>
                            <div class="mt-2">
                                <div class="flex items-center text-sm mb-1">
                                    <span class="font-medium w-32">Your answer:</span>
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">{{$questionaireResult->result[0]->your_answers[$index]}} </span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <span class="font-medium w-32">Correct answer:</span>
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded">{{$toAlpha[$questions->correct_option]}}</span>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    
                $index ++;
                @endphp
                @endforeach
                
                <!-- View All Button -->
            </div>
        </div>
    </main>
@endsection
@push('scripts')
    
@endpush