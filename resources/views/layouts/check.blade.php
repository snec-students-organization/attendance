<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - @yield('title', 'Attendance Overview')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            color: #333;
        }
        
        .dashboard-container {
            max-width: 1200px;
            margin: 2rem auto;
            background: white;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }
        
        .dashboard-header {
            background-color: var(--secondary-color);
            color: white;
            padding: 1.5rem 2rem;
        }
        
        .dashboard-nav {
            background-color: white;
            border-bottom: 1px solid #dee2e6;
        }
        
        .nav-link {
            color: var(--secondary-color);
            font-weight: 500;
            padding: 1rem 1.5rem;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover, .nav-link.active {
            color: var(--accent-color);
            border-bottom-color: var(--accent-color);
            background-color: rgba(231, 76, 60, 0.05);
        }
        
        .dashboard-content {
            padding: 2rem;
        }
        
        .page-header {
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--primary-color);
        }
        
        .export-btn {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .export-btn:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
        
        @media (max-width: 768px) {
            .dashboard-container {
                margin: 0;
                border-radius: 0;
            }
            
            .nav-link {
                padding: 0.75rem;
                text-align: center;
            }
        }
    </style>
    
    @yield('head')
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1><i class="fas fa-chalkboard-teacher me-2"></i>Admin Dashboard</h1>
        </div>
        
        <nav class="dashboard-nav navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#dashboardNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="dashboardNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="{{ route('attendance.summary') }}" 
                               class="nav-link {{ request()->routeIs('attendance.summary') ? 'active' : '' }}">
                               <i class="fas fa-chart-pie me-1"></i> Attendance Summary
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('attendance.view') }}" 
                               class="nav-link {{ request()->routeIs('attendance.view') ? 'active' : '' }}">
                               <i class="fas fa-list me-1"></i> All Records
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('attendance.teacherStudentSummary') }}" 
                               class="nav-link {{ request()->routeIs('attendance.teacherStudentSummary') ? 'active' : '' }}">
                               <i class="fas fa-chart-line me-1"></i> Analytics
                            </a>
                        </li>
                    </ul>
                    
                    <div class="d-flex">
                        <a href="{{ route('attendance.summary.export', ['date' => now()->toDateString()]) }}" 
                           class="btn btn-sm export-btn text-white">
                           <i class="fas fa-file-pdf me-1"></i> Export PDF
                        </a>
                    </div>
                </div>
            </div>
        </nav>
        
        <div class="dashboard-content">
            <h2 class="page-header">@yield('header', 'Attendance Overview')</h2>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @yield('content')
        </div>
    </div>
    
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Optional JavaScript -->
    @yield('scripts')
</body>
</html>