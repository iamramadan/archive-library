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
        
        .quiz-container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .quiz-card {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            border-radius: 16px;
            background: white;
        }
        
        .quiz-card:before, .quiz-card:after {
            content: '';
            position: absolute;
            width: 60px;
            height: 60px;
            background: #f0f9ff;
            border-radius: 50%;
            opacity: 0.3;
        }
        
        .quiz-card:before {
            top: -20px;
            right: -20px;
        }
        
        .quiz-card:after {
            bottom: -20px;
            left: -20px;
        }
        
        .option {
            transition: all 0.2s ease;
            cursor: pointer;
            border-radius: 12px;
        }
        
        .option:hover {
            background-color: #dbeafe;
            transform: translateY(-2px);
        }
        
        .option.selected {
            background-color: #dbeafe;
            border-color: #2563eb;
            box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.1);
        }
        
        .question-indicator {
            transition: all 0.2s ease;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
        }
        
        .question-indicator:hover:not(.active) {
            background-color: #dbeafe;
        }
        
        .question-indicator.active {
            background-color: #2563eb;
            color: white;
        }
        
        .question-indicator.answered {
            background-color: #10b981;
            color: white;
        }
        
        .question {
            display: none;
            animation: fadeIn 0.4s ease-out;
        }
        
        .question.active {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .progress-bar {
            height: 10px;
            border-radius: 5px;
            overflow: hidden;
            background: #e2e8f0;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #0ea5e9, #2563eb);
            transition: width 0.4s ease;
        }
        
        .nav-btn {
            transition: all 0.2s ease;
            border-radius: 10px;
            padding: 12px 24px;
            font-weight: 600;
        }
        
        .indicator-container {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            gap: 8px;
        }
        
        @media (max-width: 768px) {
            .indicator-container {
                grid-template-columns: repeat(5, 1fr);
            }
        }
    </style>
@endpush
@section('main')
@php
    $index = 1;
@endphp
     <main class="quiz-container px-4 py-8">
        <!-- Tailwind + Font Awesome CDN -->

<div class="w-full mx-auto mt-5 mb-7">
  <div class="bg-white rounded-2xl shadow-md border border-slate-200 p-6 flex items-start space-x-4">
    <div class="flex-shrink-0 w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center">
      <i class="fas fa-graduation-cap text-slate-600 text-lg"></i>
    </div>
    <div>
      <h2 class="text-lg font-semibold text-slate-800">{{$questionaires->name}}</h2>
      <p class="text-sm text-slate-500 mt-1">
        <i class="fas fa-bullseye mr-1 text-sky-500"></i>
        {{$questionaires->goal}}
      </p>
    </div>
  </div>
</div>
{{-- @dd($questionaires->questions->count()) --}}
        <form id="quiz-form" class="quiz-card p-6 md:p-8" method="post" action="{{route('pages.questionaire.submit')}}">
        @csrf
            <!-- Hidden inputs for each question -->
            <input type="hidden" value="{{$questionaires->id}}" name="questionaireId">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                <div class="mb-4 md:mb-0">
                    <h2 class="text-xl font-bold text-dark">Question <span id="current-question">1</span> of <span id="total-questions">{{$questionaires->questions->count()}}</span></h2>
                    <p class="text-gray-600 text-sm">Select the best answer for each question</p>
                </div>
            </div>
            
            <!-- Question Container -->
            <div id="question-container" class="mb-10">
                <!-- Question 1 -->
                @forelse ($questionaires->questions as $question)
                <input type="hidden" name="answers[{{$index}}]" id="answer_q{{$index}}" value="">
                <div class="question @if($loop->first) active @endif" data-id="{{$index}}">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Question {{$index}}</h3>
                    <p class="text-gray-700 mb-6 text-lg">{{ucwords($question->question)}}</p>
                    <div class="space-y-4">
                        <div class="option p-4 border border-gray-200 flex items-start" data-option="a">
                            <div class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center mr-4 mt-0.5">
                                A
                            </div>
                            <span>{{$question->option1}}</span>
                        </div>
                        <div class="option p-4 border border-gray-200 flex items-start" data-option="b">
                            <div class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center mr-4 mt-0.5">
                                B
                            </div>
                            <span>{{$question->option2}}</span>
                        </div>
                        <div class="option p-4 border border-gray-200 flex items-start" data-option="c">
                            <div class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center mr-4 mt-0.5">
                                C
                            </div>
                            <span>{{$question->option3}}</span>
                        </div>
                        <div class="option p-4 border border-gray-200 flex items-start" data-option="d">
                            <div class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center mr-4 mt-0.5">
                                D
                            </div>
                            <span>{{$question->option4 ?? 'no answer'}}</span>
                        </div>
                    </div>
                </div>
                @php
                    $index++;
                @endphp
                @empty
                        <div class="flex flex-col items-center justify-center p-6 bg-gray-50 dark:bg-gray-900 rounded-2xl shadow-md">
                            <!-- Sad Teddy Bear SVG -->
                            <svg class="w-20 h-20 mb-4 text-gray-400 dark:text-gray-500" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="20" cy="20" r="6" fill="#D1D5DB" />
                                <circle cx="44" cy="20" r="6" fill="#D1D5DB" />
                                <ellipse cx="32" cy="40" rx="16" ry="18" fill="#E5E7EB" />
                                <circle cx="26" cy="36" r="2" fill="#111827" />
                                <circle cx="38" cy="36" r="2" fill="#111827" />
                                <path d="M28 44c2 2 6 2 8 0" stroke="#6B7280" stroke-linecap="round" />
                                <path d="M30 48c1.5 2 4.5 2 6 0" stroke="#9CA3AF" stroke-linecap="round" />
                            </svg>

                            <!-- Message Text -->
                            <p class="text-gray-600 dark:text-gray-300 text-lg font-medium text-center">
                                No Questions Created
                            </p>
                        </div>

                @endforelse
                
            </div>
            @if (count($questionaires->questions))
                
            <div class="flex flex-col gap-6">
                <div class="flex justify-between">
                    <button type="button" id="prev-btn" class="nav-btn bg-gray-100 hover:bg-gray-200 text-gray-700 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                        Previous
                    </button>
                    
                    <button type="button" id="next-btn" class="nav-btn hover:bg-primary bg-blue-700 text-white flex items-center">
                        Next
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
                
                <!-- Question Indicators -->
                <div class="bg-gray-50 rounded-xl p-4">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Jump to question:</h3>
                    <div class="indicator-container">
                    @for ($i = 1; $i <= count($questionaires->questions); $i++)
                        <button type="button" class="question-indicator @if($i == 1) active @endif">{{$i}}</button>
                    @endfor
                    </div>
                </div>
            </div>
            
            <!-- Submit Button -->
            <div class="mt-10 text-center">
                <button type="submit" class="nav-btn hover:bg-success bg-green-600 text-white px-8 py-3">
                    <i class="fas fa-paper-plane mr-2"></i>Submit Quiz
                </button>
                @if ($questionaires->id == Auth::user()->id)         
                <a href="{{route('create.questions',['id'=>$questionaires->id])}}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    Update
                </a>
                @endif
            </div>
            @endif
            <!-- Navigation Controls -->
        </form>
    </main>
@endsection
@push('scripts')
    <script>
        // Quiz state
        let currentQuestion = 1;
        const totalQuestions = {{$questionaires->questions->count()}};
        let timerInterval;
        
        // DOM elements
        const questionContainer = document.getElementById('question-container');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const currentQuestionEl = document.getElementById('current-question');
        const totalQuestionsEl = document.getElementById('total-questions');
        const timerEl = document.getElementById('timer');
        const progressPercent = document.getElementById('progress-percent');
        const indicators = document.querySelectorAll('.question-indicator');
        const quizForm = document.getElementById('quiz-form');
        
        // Initialize quiz
        function initQuiz() {
            totalQuestionsEl.textContent = totalQuestions;
            startTimer(10 * 60); // 10 minutes
            
            // Add event listeners to options
            document.querySelectorAll('.option').forEach(option => {
                option.addEventListener('click', function() {
                    // Remove selected class from all options in this question
                    const questionId = this.closest('.question').dataset.id;
                    document.querySelectorAll(`.question[data-id="${questionId}"] .option`).forEach(opt => {
                        opt.classList.remove('selected');
                    });
                    
                    // Add selected class to clicked option
                    this.classList.add('selected');
                    
                    // Get selected option
                    const optionId = this.dataset.option;
                    
                    // Update hidden input value
                    document.getElementById(`answer_q${questionId}`).value = optionId;
                    
                    // Update question indicator
                    const indicator = document.querySelector(`.question-indicator:nth-child(${questionId})`);
                    indicator.classList.add('answered');
                });
            });
            
            // Add event listeners to indicators
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    navigateToQuestion(index + 1);
                });
            });
            
            // Navigation buttons
            prevBtn.addEventListener('click', () => {
                if (currentQuestion > 1) {
                    navigateToQuestion(currentQuestion - 1);
                }
            });
            
            nextBtn.addEventListener('click', () => {
                if (currentQuestion < totalQuestions) {
                    navigateToQuestion(currentQuestion + 1);
                }
            });
        }
        
        // Navigate to a specific question
        function navigateToQuestion(questionNumber) {
            // Hide all questions
            document.querySelectorAll('.question').forEach(q => {
                q.classList.remove('active');
            });
            
            // Show selected question
            document.querySelector(`.question[data-id="${questionNumber}"]`).classList.add('active');
            
            // Update current question
            currentQuestion = questionNumber;
            currentQuestionEl.textContent = currentQuestion;
            
            // Update indicators
            indicators.forEach((indicator, index) => {
                if (index + 1 === questionNumber) {
                    indicator.classList.add('active');
                } else {
                    indicator.classList.remove('active');
                }
            });
            
            // Update button states
            prevBtn.disabled = questionNumber === 1;
            nextBtn.textContent = questionNumber === totalQuestions ? 'Submit Quiz Below' : 'Next';
            
            // Update progress
            updateProgress();
        }
        
        // Start timer
        function startTimer(duration) {
            let timer = duration, minutes, seconds;
            timerInterval = setInterval(() => {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);
                
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;
                
                timerEl.textContent = minutes + ":" + seconds;
                
                if (--timer < 0) {
                    clearInterval(timerInterval);
                    timerEl.textContent = "00:00";
                    timerEl.classList.add('text-danger');
                    alert("Time's up! Submitting your quiz.");
                    quizForm.submit();
                }
            }, 1000);
        }
        
        // Initialize the quiz
        initQuiz();
    </script>
@endpush