<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ABC College - Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .hero {
            background: url('https://source.unsplash.com/1600x800/?college,campus') no-repeat center center;
            background-size: cover;
            height: 100vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .hero p {
            font-size: 1.25rem;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">ABC College</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#courses">Courses</a></li>
                    <li class="nav-item"><a class="nav-link" href="#admissions">Admissions</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div>
            <h1>Welcome to ABC College</h1>
            <p>Shaping the future through quality education</p>
            <a href="#admissions" class="btn btn-primary btn-lg mt-3">Apply Now</a>
        </div>
    </section>

    <!-- About Us -->
    <section id="about" class="py-5">
        <div class="container">
            <h2 class="section-title">About Us</h2>
            <p class="text-center">ABC College is a premier institution offering world-class education and fostering student excellence for over 25 years.</p>
        </div>
    </section>

    <!-- Courses -->
    <section id="courses" class="bg-light py-5">
        <div class="container">
            <h2 class="section-title">Our Courses</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card text-center p-3">
                        <h5>Bachelor of Science</h5>
                        <p>Comprehensive science programs designed for future innovators.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center p-3">
                        <h5>Bachelor of Arts</h5>
                        <p>Creative and analytical programs to enhance your critical thinking.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center p-3">
                        <h5>Bachelor of Commerce</h5>
                        <p>Business-oriented courses preparing leaders for the corporate world.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Admissions -->
    <section id="admissions" class="py-5">
        <div class="container">
            <h2 class="section-title">Admissions</h2>
            <p class="text-center">Join our vibrant community of learners—our admission process is now open for the upcoming academic year.</p>
            <div class="text-center mt-3">
                <a href="/apply" class="btn btn-success btn-lg">Start Application</a>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section id="contact" class="bg-light py-5">
        <div class="container">
            <h2 class="section-title">Contact Us</h2>
            <p class="text-center">Reach out to us for inquiries, admissions, or campus information.</p>
            <div class="text-center">
                <p>Email: info@abccollege.edu | Phone: +91-9876543210</p>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white py-3 text-center">
        <p>&copy; 2025 ABC College. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
