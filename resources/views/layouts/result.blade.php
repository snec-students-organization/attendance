<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results System</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
        }
        
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .navbar-brand {
            font-weight: 700;
        }
        
        .main-content {
            flex: 1;
            padding: 2rem 0;
        }
        
        .footer {
            background-color: var(--secondary-color);
            color: white;
            padding: 1.5rem 0;
        }
        
        .card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .table th {
            font-weight: 600;
            background-color: #f1f5fd;
        }
        
        .badge {
            font-size: 0.9em;
            padding: 0.5em 0.75em;
            font-weight: 500;
        }
        
        /* Modal styles */
        .modal-pin-input {
            letter-spacing: 2px;
            font-size: 1.5rem;
            text-align: center;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="bi bi-mortarboard me-2"></i>Home
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/results">
                            <i class="bi bi-search me-1"></i> Search Results
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#adminModal">
                            <i class="bi bi-shield-lock me-1"></i> Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Admin PIN Modal -->
    <div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="adminModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adminModalLabel">Admin Access</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="pinForm">
                        <div class="mb-3">
                            <label for="adminPin" class="form-label">Enter 4-Digit PIN</label>
                            <input type="password" class="form-control modal-pin-input" id="adminPin" maxlength="4" pattern="\d{4}" inputmode="numeric" required>
                            <div class="invalid-feedback">Please enter a valid 4-digit PIN</div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto">
        <div class="container text-center">
            <p class="mb-0">&copy; Fest Results System. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Admin PIN Verification Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pinForm = document.getElementById('pinForm');
            const adminPinInput = document.getElementById('adminPin');
            const adminModal = new bootstrap.Modal(document.getElementById('adminModal'));
            
            // Correct PIN (change this to your actual PIN)
            const CORRECT_PIN = "1234"; // Replace with your secure PIN
            
            pinForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const enteredPin = adminPinInput.value;
                
                if (enteredPin === CORRECT_PIN) {
                    // Redirect to admin page
                    window.location.href = '/admin/results/upload';
                } else {
                    // Show error
                    adminPinInput.classList.add('is-invalid');
                    setTimeout(() => {
                        adminPinInput.classList.remove('is-invalid');
                        adminPinInput.value = '';
                        adminPinInput.focus();
                    }, 2000);
                }
            });
            
            // Auto focus on modal show
            adminModal._element.addEventListener('shown.bs.modal', function() {
                adminPinInput.focus();
            });
            
            // Clear on modal hide
            adminModal._element.addEventListener('hidden.bs.modal', function() {
                pinForm.reset();
                adminPinInput.classList.remove('is-invalid');
            });
            
            // Numeric input only
            adminPinInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>