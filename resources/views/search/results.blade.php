@extends('layout.main')
@section('title','search results for')
@push('links')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            /* background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .ticket-card {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .ticket-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .tag {
            font-size: 0.75rem;
            padding: 3px 10px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            white-space: nowrap;
        }
        
        .status-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 6px;
        }
        
        .table-container {
            width: 80%;
            margin: 0 auto;
        }
        
        @media (max-width: 768px) {
            .table-container {
                width: 95%;
            }
        }
        
        .mobile-ticket {
            border-left: 4px solid;
        }
        
        .pagination-btn {
            transition: all 0.2s ease;
        }
        
        .pagination-btn:hover:not(.disabled) {
            background: #dbeafe;
        }
        
        .sortable:hover {
            color: #2563eb;
            cursor: pointer;
        }
    </style>
    <style>
  .nav-tab {
    @apply flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition cursor-pointer;
  }
  .active-tab {
    @apply bg-blue-100 text-blue-600 font-semibold;
  }
</style>
@endpush
@section('main')
{{-- @dd($notes) --}}
    @livewire('search-results',['notes'=>$notes,
                                'questionaires'=>$questionaires,
                                'all'=>$all,
                                'resources'=>$resources,
                                'query'=>$query
                                ])
@endsection
@push('scripts')
    <script>
  function setActiveTab(el) {
    document.querySelectorAll('.nav-tab').forEach(tab => {
      tab.classList.remove('active-tab');
    });
    el.classList.add('active-tab');
  }
</script>
@endpush