<div>
<div class="border-b border-gray-300">
        <div class="max-w-5xl mx-auto px-4">
            <div class="nav-tabs flex space-x-8">
                <a wire:click="show('all')" class="nav-tab active">
                    <i class="fas fa-globe mr-2"></i>All
                </a>
                <a wire:click="show('questionaires')" class="nav-tab">
                    <i class="fas fa-clipboard-list mr-2"></i>Questionnaires
                </a>
                <a wire:click="show('resources')" class="nav-tab">
                    <i class="fas fa-book mr-2"></i>Resources
                </a>
                <a wire:click="show('notes')" class="nav-tab">
                    <i class="fas fa-sticky-note mr-2"></i>Notes
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-grow max-w-3xl mx-auto px-4 py-6 w-full">
        <p class="text-gray-600 text-sm mb-6">About 4,210,000 results (0.42 seconds)</p>
        
        <!-- Search Results -->
        <div class="space-y-8">
            <!-- Result 1 -->
            @switch($showing)
                @case('all')
                    @forelse ($all as $content)
                        
                    @empty
                        
                    @endforelse
                    @break
                @case('notes')
                    @forelse ($notes as $content)
                        <div class="result-card p-4 rounded-lg">
                            <div class="flex items-center mb-1">
                                {{-- <span class="result-url">https://archlib.edu › notes › research-methods-summary</span> --}}
                            </div>
                            <a href="#" class="result-title text-xl font-medium mb-1 inline-block">{{$content->title}}</a>
                            <p class="text-gray-700 mb-2">{{str::limit($content->body,50)}}</p>
                            <div class="flex flex-wrap gap-2 mt-3">
                                <span class="tag"><i class="fas fa-sticky-note mr-1"></i>Notes</span>
                                <span class="tag"><i class="fas fa-eye mr-1"></i>Viewed 1,240 times</span>
                            </div>
                        </div>
                    @empty
                                <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-2xl shadow-md flex flex-col items-center text-center space-y-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="h-24 w-24 text-gray-400">
                                    <g fill="none" fill-rule="evenodd">
                                    <circle cx="32" cy="32" r="30" fill="#F2F2F2"/>
                                    <circle cx="21" cy="24" r="6" fill="#444"/>
                                    <circle cx="43" cy="24" r="6" fill="#444"/>
                                    <circle cx="23" cy="24" r="2" fill="#fff"/>
                                    <circle cx="41" cy="24" r="2" fill="#fff"/>
                                    <path d="M24 40c2 2 5 3 8 3s6-1 8-3" stroke="#000" stroke-width="2" stroke-linecap="round"/>
                                    <circle cx="32" cy="32" r="30" stroke="#ddd" stroke-width="2"/>
                                    </g>
                                </svg>
                                <h2 class="text-xl font-semibold text-gray-800">No Notes Found</h2>
                                <p class="text-gray-600">You haven’t added any notes yet. Start jotting something down to save it here.</p>
                                <a href="#" class="inline-block mt-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-full hover:bg-blue-700 transition">
                                    Add Note
                                </a>
                                </div>
                    @endforelse
                    @break
                @case('questionaire')
                    @forelse ($questionaires as $content)
                        <div class="result-card p-4 rounded-lg">
                            <div class="flex items-center mb-1">
                                {{-- <span class="result-url">https://archlib.edu › questionnaires › RM-2024</span> --}}
                            </div>
                            <a href="#" class="result-title text-xl font-medium mb-1 inline-block">{{$content->name}}</a>
                            <p class="text-gray-700 mb-2">{{$content->goal}}</p>
                            <div class="flex flex-wrap gap-2 mt-3">
                                <span class="tag"><i class="fas fa-clipboard-list mr-1"></i>Questionnaire</span>
                                <span class="tag"><i class="fas fa-users mr-1"></i>Used by most researchers</span>
                            </div>
                        </div>
                    @empty
                        <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-2xl shadow-md flex flex-col items-center text-center space-y-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="h-24 w-24 text-gray-400">
                            <g fill="none" fill-rule="evenodd">
                            <circle cx="32" cy="32" r="30" fill="#F2F2F2"/>
                            <circle cx="21" cy="24" r="6" fill="#444"/>
                            <circle cx="43" cy="24" r="6" fill="#444"/>
                            <circle cx="23" cy="24" r="2" fill="#fff"/>
                            <circle cx="41" cy="24" r="2" fill="#fff"/>
                            <path d="M24 40c2 2 5 3 8 3s6-1 8-3" stroke="#000" stroke-width="2" stroke-linecap="round"/>
                            <circle cx="32" cy="32" r="30" stroke="#ddd" stroke-width="2"/>
                            </g>
                        </svg>
                        <h2 class="text-xl font-semibold text-gray-800">No Questionnaires Yet</h2>
                        <p class="text-gray-600">There are no questionnaires available right now. Please check back later or request one.</p>
                        <a href="#" class="inline-block mt-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-full hover:bg-blue-700 transition">
                            Request Questionnaire
                        </a>
                        </div>
                    @endforelse
                    @break
                @case('resources')
                    @forelse ($resources as $content)
                        <div class="result-card p-4 rounded-lg">
                            <div class="flex items-center mb-1">
                                <span class="result-url">https://www.researchgate.net › methodology</span>
                            </div>
                            <a href="#" class="result-title text-xl font-medium mb-1 inline-block">{{$content->name}}</a>
                            <p class="text-gray-700 mb-2">{{$content->description}}</p>
                            <div class="flex flex-wrap gap-2 mt-3">
                                <span class="tag"><i class="fas fa-book mr-1"></i>Resource</span>
                                <span class="tag"><i class="fas fa-calendar mr-1"></i>Published on {{$content->created_at->format('d M Y')}}</span>
                            </div>
                        </div>
                    @empty
                        <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-2xl shadow-md flex flex-col items-center text-center space-y-4">
                            <!-- Sad Panda SVG -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="h-24 w-24 text-gray-400">
                                <g fill="none" fill-rule="evenodd">
                                    <circle cx="32" cy="32" r="30" fill="#F2F2F2"/>
                                    <circle cx="21" cy="24" r="6" fill="#444"/>
                                    <circle cx="43" cy="24" r="6" fill="#444"/>
                                    <circle cx="23" cy="24" r="2" fill="#fff"/>
                                    <circle cx="41" cy="24" r="2" fill="#fff"/>
                                    <path d="M24 40c2 2 5 3 8 3s6-1 8-3" stroke="#000" stroke-width="2" stroke-linecap="round"/>
                                    <circle cx="32" cy="32" r="30" stroke="#ddd" stroke-width="2"/>
                                </g>
                            </svg>

                            <!-- Updated Message -->
                            <h2 class="text-xl font-semibold text-gray-800">Oops! No Resources</h2>
                            <p class="text-gray-600">Looks like you’re out of resources. Submit a ticket to request more.</p>

                            <!-- Call to action button -->
                            <a href="#" class="inline-block mt-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-full hover:bg-blue-700 transition">
                                Submit Ticket
                            </a>
                        </div>
                    @endforelse
                    @break
                @default
                    
            @endswitch
            <div class="result-card p-4 rounded-lg">
                <div class="flex items-center mb-1">
                    <span class="result-url">https://www.researchgate.net › methodology</span>
                </div>
                <a href="#" class="result-title text-xl font-medium mb-1 inline-block">Research Methodology: A Step-by-Step Guide for Beginners</a>
                <p class="text-gray-700 mb-2">Research methodology simply refers to the practical "how" of any given piece of research. More specifically, it's about how a researcher systematically designs a study to ensure valid and reliable results that address the research aims and objectives.</p>
                <div class="flex flex-wrap gap-2 mt-3">
                    <span class="tag"><i class="fas fa-book mr-1"></i>Resource</span>
                    <span class="tag"><i class="fas fa-calendar mr-1"></i>Published 2023</span>
                </div>
            </div>
            
            <!-- Result 2 -->
            <div class="result-card p-4 rounded-lg">
                <div class="flex items-center mb-1">
                    <span class="result-url">https://www.scribbr.com › category › methodology</span>
                </div>
                <a href="#" class="result-title text-xl font-medium mb-1 inline-block">What Is Research Methodology? | Definition + Examples</a>
                <p class="text-gray-700 mb-2">Research methodology is the specific procedures or techniques used to identify, select, process, and analyze information about a topic. In a research paper, the methodology section allows the reader to critically evaluate a study's overall validity and reliability.</p>
                <div class="flex flex-wrap gap-2 mt-3">
                    <span class="tag"><i class="fas fa-book mr-1"></i>Resource</span>
                    <span class="tag"><i class="fas fa-file-pdf mr-1"></i>PDF Available</span>
                </div>
            </div>
            
            <!-- Result 3 -->
            <div class="result-card p-4 rounded-lg">
                <div class="flex items-center mb-1">
                    <span class="result-url">https://archlib.edu › questionnaires › RM-2024</span>
                </div>
                <a href="#" class="result-title text-xl font-medium mb-1 inline-block">Research Methodology Questionnaire - ARCHLIB</a>
                <p class="text-gray-700 mb-2">A comprehensive questionnaire on research methodology concepts including research design, data collection methods, sampling techniques, and data analysis approaches. Used in academic studies since 2021.</p>
                <div class="flex flex-wrap gap-2 mt-3">
                    <span class="tag"><i class="fas fa-clipboard-list mr-1"></i>Questionnaire</span>
                    <span class="tag"><i class="fas fa-download mr-1"></i>Downloadable</span>
                    <span class="tag"><i class="fas fa-users mr-1"></i>Used by 210 researchers</span>
                </div>
            </div>
            
            <!-- Result 4 -->
            <div class="result-card p-4 rounded-lg">
                <div class="flex items-center mb-1">
                    <span class="result-url">https://libguides.usc.edu › writingguide › methodology</span>
                </div>
                <a href="#" class="result-title text-xl font-medium mb-1 inline-block">Research Methods - Research Guides at University of ...</a>
                <p class="text-gray-700 mb-2">The purpose of this chapter is to explain in detail the research methods and the methodology implemented for this study. The chapter will explain first of all the choice of research approach, then the research design, as well as the advantages and disadvantages of the research tools chosen.</p>
                <div class="flex flex-wrap gap-2 mt-3">
                    <span class="tag"><i class="fas fa-book mr-1"></i>Resource</span>
                    <span class="tag"><i class="fas fa-university mr-1"></i>Academic</span>
                </div>
            </div>
            
            <!-- Result 5 -->
            <div class="result-card p-4 rounded-lg">
                <div class="flex items-center mb-1">
                    <span class="result-url">https://archlib.edu › notes › research-methods-summary</span>
                </div>
                <a href="#" class="result-title text-xl font-medium mb-1 inline-block">Research Methods - Comprehensive Notes - ARCHLIB</a>
                <p class="text-gray-700 mb-2">Detailed notes covering quantitative, qualitative, and mixed methods approaches. Includes definitions, applications, strengths and limitations of each research method. Last updated: March 15, 2024.</p>
                <div class="flex flex-wrap gap-2 mt-3">
                    <span class="tag"><i class="fas fa-sticky-note mr-1"></i>Notes</span>
                    <span class="tag"><i class="fas fa-star mr-1"></i>Highly Rated</span>
                    <span class="tag"><i class="fas fa-eye mr-1"></i>Viewed 1,240 times</span>
                </div>
            </div>
            
            <!-- Result 6 -->
            <div class="result-card p-4 rounded-lg">
                <div class="flex items-center mb-1">
                    <span class="result-url">https://www.questionpro.com › research-methodology</span>
                </div>
                <a href="#" class="result-title text-xl font-medium mb-1 inline-block">Research Methodology: What it is and How to Write it</a>
                <p class="text-gray-700 mb-2">A research methodology describes the techniques and procedures used to identify and analyze information regarding a specific research topic. It is a process by which researchers design their study so that they can achieve their objectives using the selected research instruments.</p>
                <div class="flex flex-wrap gap-2 mt-3">
                    <span class="tag"><i class="fas fa-book mr-1"></i>Resource</span>
                    <span class="tag"><i class="fas fa-chart-bar mr-1"></i>Includes Examples</span>
                </div>
            </div>
            
            <!-- Result 7 -->
            <div class="result-card p-4 rounded-lg">
                <div class="flex items-center mb-1">
                    <span class="result-url">https://archlib.edu › questionnaires › qualitative-methods</span>
                </div>
                <a href="#" class="result-title text-xl font-medium mb-1 inline-block">Qualitative Research Methods Questionnaire - ARCHLIB</a>
                <p class="text-gray-700 mb-2">A specialized questionnaire focusing on qualitative research methodologies including interviews, focus groups, ethnographic studies, and case studies. Developed by Dr. Elena Rodriguez for her 2022 study on qualitative approaches in social sciences.</p>
                <div class="flex flex-wrap gap-2 mt-3">
                    <span class="tag"><i class="fas fa-clipboard-list mr-1"></i>Questionnaire</span>
                    <span class="tag"><i class="fas fa-graduation-cap mr-1"></i>Academic</span>
                    <span class="tag"><i class="fas fa-download mr-1"></i>Template Available</span>
                </div>
            </div>
            
            <!-- Result 8 -->
            <div class="result-card p-4 rounded-lg">
                <div class="flex items-center mb-1">
                    <span class="result-url">https://archlib.edu › notes › quantitative-methods</span>
                </div>
                <a href="#" class="result-title text-xl font-medium mb-1 inline-block">Quantitative Research Methods Notes - ARCHLIB</a>
                <p class="text-gray-700 mb-2">Comprehensive notes on quantitative research methods, including experimental design, survey methodology, statistical analysis techniques, and data interpretation. Created by Professor James Wilson for STAT 510 course.</p>
                <div class="flex flex-wrap gap-2 mt-3">
                    <span class="tag"><i class="fas fa-sticky-note mr-1"></i>Notes</span>
                    <span class="tag"><i class="fas fa-chart-line mr-1"></i>Statistics</span>
                    <span class="tag"><i class="fas fa-bookmark mr-1"></i>Bookmarked 340 times</span>
                </div>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            <div class="flex items-center space-x-1">
                <a href="#" class="pagination-btn w-10 h-10 flex items-center justify-center text-blue-600">
                    <i class="fas fa-chevron-left"></i>
                </a>
                <a href="#" class="pagination-btn w-10 h-10 flex items-center justify-center font-medium text-white bg-primary rounded-full">1</a>
                <a href="#" class="pagination-btn w-10 h-10 flex items-center justify-center font-medium">2</a>
                <a href="#" class="pagination-btn w-10 h-10 flex items-center justify-center font-medium">3</a>
                <a href="#" class="pagination-btn w-10 h-10 flex items-center justify-center font-medium">4</a>
                <a href="#" class="pagination-btn w-10 h-10 flex items-center justify-center font-medium">5</a>
                <span class="px-2">...</span>
                <a href="#" class="pagination-btn w-10 h-10 flex items-center justify-center font-medium">10</a>
                <a href="#" class="pagination-btn w-10 h-10 flex items-center justify-center text-blue-600">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>
    </main>
</div>
