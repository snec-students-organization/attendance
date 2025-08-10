<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Portal - @yield('title', 'Attendance Module')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #1777dd;
            --secondary-color: #2c3e50;
            --light-bg: #f9fbfc;
            --card-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            color: #333;
        }
        
        .portal-container {
            max-width: 900px;
            margin: 2rem auto;
            background: white;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }
        
        .portal-header {
            background-color: white;
            padding: 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .portal-title {
            color: var(--secondary-color);
            font-weight: 600;
            margin: 0;
        }
        
        .portal-nav {
            background-color: #f8fafb;
            padding: 0 1.5rem;
        }
        
        .nav-link {
            color: var(--secondary-color);
            font-weight: 500;
            padding: 1rem 1.25rem;
            border-bottom: 3px solid transparent;
            transition: all 0.2s ease;
            margin-right: 0.5rem;
        }
        
        .nav-link:hover, .nav-link.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
            background-color: rgba(23, 119, 221, 0.05);
        }
        
        .portal-content {
            padding: 1.5rem;
        }
        
        .page-header {
            color: var(--secondary-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #eee;
        }
        
        @media (max-width: 768px) {
            .portal-container {
                margin: 0;
                border-radius: 0;
            }
            
            .nav-link {
                padding: 0.75rem;
                text-align: center;
                margin-right: 0;
            }
        }
    </style>
    
    @yield('head')
</head>
<body>
    <div class="portal-container">
        <div class="portal-header">
            <h2 class="portal-title">
                <i class="fas fa-user-clock text-primary me-2"></i>
                Staff Attendance Portal
            </h2>
        </div>
        
        <nav class="portal-nav navbar navbar-expand-lg">
            <div class="container-fluid px-0">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#portalNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="portalNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ route('attendance.create') }}" 
                               class="nav-link {{ request()->routeIs('attendance.create') ? 'active' : '' }}">
                               <i class="fas fa-check-circle me-2"></i> Mark Attendance
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('attendance.view') }}" 
                               class="nav-link {{ request()->routeIs('attendance.view') ? 'active' : '' }}">
                               <i class="fas fa-calendar-alt me-2"></i> View My Attendance
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="portal-content">
            <h3 class="page-header">@yield('header', 'Attendance Dashboard')</h3>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
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
