<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Shamsul ulama islamic and arts college</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --text-color: #34495e;
            --text-light: #7f8c8d;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            scroll-behavior: smooth;
        }
        
        .navbar {
            background-color: rgba(44, 62, 80, 0.95) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .navbar.scrolled {
            background-color: var(--primary-color) !important;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .nav-link {
            font-weight: 500;
            margin: 0 8px;
            position: relative;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--secondary-color);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }
        
        .hero {
            background: linear-gradient(rgba(44, 62, 80, 0.8), rgba(44, 62, 80, 0.8)), 
                        url('/images/collegeai.png') no-repeat center center;
            background-size: cover;
            height: 100vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
        }
        
        .hero-content {
            max-width: 800px;
            animation: fadeInUp 1s ease;
        }
        
        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .hero p {
            font-size: 1.5rem;
            margin-bottom: 30px;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }
        
        .btn-primary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        .btn-secondary {
            background-color: transparent;
            border: 2px solid white;
            color: white;
            padding: 10px 25px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            margin-left: 15px;
        }
        
        .btn-secondary:hover {
            background-color: white;
            color: var(--primary-color);
            transform: translateY(-2px);
        }
        
        .section-title {
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
            position: relative;
            color: var(--primary-color);
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            width: 80px;
            height: 3px;
            background-color: var(--secondary-color);
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .section-padding {
            padding: 80px 0;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            height: 100%;
        }
        
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .card-icon {
            font-size: 2.5rem;
            color: var(--secondary-color);
            margin-bottom: 15px;
        }
        
        .feature-box {
            text-align: center;
            padding: 30px 20px;
            border-radius: 10px;
            background-color: white;
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .feature-box:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
  /* resources/css/app.css */
.stats {
    background: 
        linear-gradient(rgba(44, 62, 80, 0.9), rgba(44, 62, 80, 0.9)), 
        url('/images/collegeai.png') center/cover;
    min-height: 300px; /* Ensure element has size */
}
        
        .stat-item {
            text-align: center;
            padding: 20px;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--secondary-color);
        }
        
        .stat-label {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .testimonial {
            background-color: var(--light-color);
            padding: 30px;
            border-radius: 10px;
            position: relative;
            margin-bottom: 30px;
        }
        
        .testimonial::before {
            content: '"';
            position: absolute;
            top: 10px;
            left: 20px;
            font-size: 5rem;
            color: rgba(52, 152, 219, 0.1);
            font-family: serif;
            line-height: 1;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }
        
        .testimonial-author img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
            object-fit: cover;
        }
        
        .contact-info {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .contact-icon {
            width: 50px;
            height: 50px;
            background-color: var(--secondary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.2rem;
        }
        
        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            margin-right: 10px;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
        }
        
        footer {
            background-color: var(--dark-color);
            color: white;
            padding: 30px 0 10px;
        }
        
        .footer-links {
            margin-bottom: 20px;
        }
        
        .footer-links a {
            color: var(--light-color);
            margin: 0 15px;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-links a:hover {
            color: var(--secondary-color);
        }
        
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background-color: var(--secondary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            z-index: 99;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .back-to-top.active {
            opacity: 1;
            visibility: visible;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            .hero h1 {
                font-size: 2.8rem;
            }
            
            .hero p {
                font-size: 1.2rem;
            }
        }
        
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.2rem;
            }
            
            .hero p {
                font-size: 1rem;
            }
            
            .btn-secondary {
                margin-left: 0;
                margin-top: 15px;
            }
            
            .section-padding {
                padding: 60px 0;
            }
        }
    </style>
</head>
<body data-bs-spy="scroll" data-bs-target=".navbar">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-graduation-cap me-2"></i>SUIC
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="/attendance/create">Attendance Portal</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#courses">Courses</a></li>
                    <li class="nav-item"><a class="nav-link" href="https://www.snec.in/">About Admissions</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                   
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-content container">
            <h1>SHAMSUL ULAMA ISLAMIC AND ARTS COLLEGE PATHIYANKARA (SNEC)</h1>
            <p>Shape Your Future With Quality Education.</p>
            <div class="d-flex flex-wrap justify-content-center">
                <a href="https://www.snec.in/" class="btn btn-primary">Apply Now</a>
                <a href="#courses" class="btn btn-secondary">Explore Courses</a>
            </div>
        </div>
        <a href="#about" class="scroll-down">
            <i class="fas fa-chevron-down"></i>
        </a>
    </section>

    <!-- About Us -->
    <section id="about" class="section-padding">
    <div class="container">
        <h2 class="section-title">About Our College</h2>
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <!-- Correct image path using asset() helper -->
                <img src="{{ asset('images/college.jpeg') }}" alt="College Campus" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h3 class="mb-3">Where Tradition Meets Excellence in Education</h3>
                <p class="lead">Shamul Ulama Islamic and Arts College is a premier institution under the Samastha National Education Council (SNEC), dedicated to nurturing a generation of scholars who excel in both Islamic and secular knowledge. With a curriculum rooted in faith, wisdom, and modern academia, we empower students to become leaders who contribute meaningfully to society.</p>
                
                <div class="row mt-4">
                    <div class="col-6">
                        <div class="feature-box">
                            <div class="card-icon">
                                <i class="fas fa-award"></i>
                            </div>
                            <h5>Accredited Programs</h5>
                            <p>All our courses are Under Samastha National Education Council - SNEC.</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="feature-box">
                            <div class="card-icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <h5>Expert Faculty</h5>
                            <p>Learn from industry experts and academic leaders.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">10+</div>
                        <div class="stat-label" style="color: #ffffffff;" >Years of Excellence</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">150+</div>
                        <div class="stat-label" style="color: #ffffffff;">Expert Faculty</div>
                    </div>
                </div>
                
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">10+</div>
                        <div class="stat-label" style="color: #ffffffff;">Courses Offered</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Courses -->
    <section id="courses" class="section-padding bg-light">
        <div class="container">
            <h2 class="section-title">Our Academic Programs</h2>
            <p class="text-center mb-5 lead">Choose from our diverse range of undergraduate and graduate programs designed to meet industry demands.</p>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card">
                        <img src="\images\Shareea.jpg" class="card-img-top" alt="Science Program">
                        <div class="card-body">
                            <h5 class="card-title">SHARI'A (For Boys) - SANAAE</h5>
                            <p class="card-text">The program is intended to create a community that is enriched with Islamic scholars who are well versed in the different principles and philosophies of Sharee’a and Islamic studies as well as secular education..</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check-circle text-success me-2"></i> Duration: 8 Years</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i> Pattern: 2+4+2</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i> secondary level , degree level , pg level</li>
                            </ul>
                            <a href="#" class="btn btn-outline-primary">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="\images\ShareeaPlus.jpg" class="card-img-top" alt="Arts Program">
                        <div class="card-body">
                            <h5 class="card-title">SHARI'A Plus (For Boys)</h5>
                            <p class="card-text">The ten-year religious study program is structured as a three-year secondary, two-year preliminary, three-year degree, and two-year postgraduate (PG).</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check-circle text-success me-2"></i> Duration: 10 Years</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i> Pattern: 3+2+3+2</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i> secondary 3 years , higher secondary 2 years , degree 3 years , pg 2 years </li>
                            </ul>
                            <a href="#" class="btn btn-outline-primary">Learn More</a>
                        </div>
                    </div>
                </div>
               
            </div>
            
            <div class="text-center mt-5">
                <a href="#" class="btn btn-primary px-4">View All Programs</a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    

    <!-- Admissions -->
    <section id="admissions" class="section-padding bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="section-title text-start">Ready to Start Your Journey?</h2>
                    <p class="lead">Our admission process is simple and straightforward.</p>
                    <p>We welcome applications from students of all backgrounds who demonstrate academic potential and a commitment to learning.</p>
                    
                    <div class="accordion mt-4" id="admissionAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    Admission Requirements
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#admissionAccordion">
                                <div class="accordion-body">
                                    <ul>
                                        <li>Completed application form</li>
                                        <li>High school transcripts</li>
                                        <li>Standardized test scores (if applicable)</li>
                                        <li>Personal statement</li>
                                        <li>Letters of recommendation</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                    Important Dates
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#admissionAccordion">
                                <div class="accordion-body">
                                    <ul>
                                        <li>Fall Semester: Applications due June 15</li>
                                        <li>Spring Semester: Applications due November 1</li>
                                        <li>Early Decision: Applications due January 15</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow">
                        <div class="card-body p-5">
                            <h3 class="mb-4">Apply Now</h3>
                            <form>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Full Name" required>
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email Address" required>
                                </div>
                                <div class="mb-3">
                                    <input type="tel" class="form-control" placeholder="Phone Number">
                                </div>
                                <div class="mb-3">
                                    <select class="form-select" required>
                                        <option value="" selected disabled>Select Program</option>
                                        <option>Bachelor of Science</option>
                                        <option>Bachelor of Arts</option>
                                        <option>Bachelor of Commerce</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" rows="3" placeholder="Your Message"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Submit Application</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section id="contact" class="section-padding">
        <div class="container">
            <h2 class="section-title">Contact Us</h2>
            <p class="text-center mb-5 lead">We'd love to hear from you. Reach out with any questions or to schedule a campus visit.</p>
            
            <div class="row">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <h4 class="mb-4">Get In Touch</h4>
                    
                    <div class="contact-info">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h6>Address</h6>
                            <p class="mb-0">pathiyankara,trikunnappuzha 590615</p>
                        </div>
                    </div>
                    
                    <div class="contact-info">
                        <div class="contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <h6>Phone</h6>
                            <p class="mb-0">+91-9876543210</p>
                        </div>
                    </div>
                    
                    <div class="contact-info">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h6>Email</h6>
                            <p class="mb-0">info@abccollege.edu</p>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <h6>Follow Us</h6>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-7">
                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.123456789012!2d77.12345678901234!3d12.123456789012345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTLCsDA3JzI0LjQiTiA3N8KwMDcnMjQuNCJF!5e0!3m2!1sen!2sin!4v1234567890123!5m2!1sen!2sin" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" class="rounded shadow"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="text-white mb-4">
                        <i class="fas fa-graduation-cap me-2"></i>Shamsul Ulama Islamic and arts college
                    </h5>
                    <p>Committed to excellence in education since 2014. Shaping futures through innovative learning and research.</p>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-white mb-4">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-50">Home</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">About Us</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Courses</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Admissions</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-white mb-4">Academic</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-50">Academic Calendar</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Library</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Research</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Student Portal</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Faculty Directory</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Support</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-50">FAQs</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Help Desk</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Campus Tour</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Careers</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 bg-white-10">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="small mb-0">&copy; 2025 SUIC All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="small mb-0">Designed with <i class="fas fa-heart text-danger"></i> by Ramees</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top -->
    <a href="#" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Back to top button
        const backToTopButton = document.querySelector('.back-to-top');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTopButton.classList.add('active');
            } else {
                backToTopButton.classList.remove('active');
            }
        });
        
        backToTopButton.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({top: 0, behavior: 'smooth'});
        });
        
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 70,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>