@extends('layouts.master')


@section('title', 'Online Learning Platform - Your Future Starts Here')


@section('styles')
<style>
    :root {
        --primary-color: #007bff;
        --secondary-color: #6c757d;
        --success-color: #28a745;
        --dark-color: #212529;
        --light-color: #f4f7f9;
        --card-bg: #ffffff;
        --font-family-base: 'Poppins', sans-serif;
    }

    body {
        font-family: var(--font-family-base);
        background-color: var(--light-color);
        color: var(--dark-color);
    }

    /* --- Global Styles --- */
    .btn-custom {
        padding: 0.75rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-custom-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }

    .btn-custom-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.2);
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .section-title {
        position: relative;
        font-size: clamp(1.8rem, 4vw, 2.5rem);
        font-weight: bold;
        margin-bottom: 2rem;
    }

    .section-title::after {
        content: '';
        display: block;
        width: 60px;
        height: 4px;
        background-color: var(--primary-color);
        margin-top: 0.5rem;
        border-radius: 2px;
    }

    /* --- Hero Section --- */
    .hero-section {
        background: linear-gradient(to right, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.4)), url('https://images.unsplash.com/photo-1522071820081-009f0129c71c') no-repeat center center/cover;
        color: white;
        padding: 10rem 0;
    }

    .hero-title {
        font-size: clamp(2.5rem, 6vw, 4rem);
        font-weight: 700;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
    }

    .hero-subtitle {
        font-size: clamp(1rem, 2.5vw, 1.5rem);
        margin-bottom: 2.5rem;
        font-weight: 300;
    }

    /* --- Categories & Featured Courses --- */
    .category-card,
    .course-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: var(--card-bg);
        border: none;
    }

    .category-card:hover,
    .course-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15) !important;
    }

    .category-icon-container {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
        background-color: #e9ecef;
    }

    .course-thumbnail {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .course-card .card-body {
        padding: 1.5rem;
    }

    .course-price {
        color: var(--success-color);
        font-weight: 700;
    }

    /* --- Why Choose Us Section --- */
    .feature-item {
        text-align: center;
    }

    .feature-icon-container {
        width: 80px;
        height: 80px;
        background-color: var(--primary-color);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        color: white;
        font-size: 2rem;
    }

    /* --- Testimonials --- */
    .testimonial-card {
        background-color: #e9f5ff;
        border-left: 5px solid var(--primary-color);
    }

    .testimonial-text {
        font-style: italic;
        color: var(--dark-color);
    }

    .testimonial-author img {
        width: 50px;
        height: 50px;
        object-fit: cover;
    }

    /* --- CTA Banner --- */
    .cta-banner {
        background-color: var(--primary-color);
        color: white;
        padding: 5rem 0;
    }

    .cta-banner h2 {
        font-weight: 700;
    }
</style>

@endsection
@section('content')
<header class="hero-section">
    <div class="container text-center">
        <h1 class="hero-title animate__animated animate__fadeInUp">Unlock Your Potential. <br> Learn from the Experts.</h1>
        <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s">
            Explore a world of courses in tech, business, and creativity. Taught by industry leaders, for everyone.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="#courses" class="btn btn-lg btn-custom btn-custom-primary animate__animated animate__zoomIn animate__delay-2s">Explore All Courses</a>
            <a href="#" class="btn btn-lg btn-light btn-custom animate__animated animate__zoomIn animate__delay-2s">Watch Intro Video</a>
        </div>
    </div>
</header>

<section class="py-5 bg-white">
    <div class="container">
        <h2 class="section-title text-center">Browse Top Categories</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-3 col-sm-6">
                <a href="#" class="text-decoration-none text-dark">
                    <div class="card p-4 text-center border-0 shadow-sm category-card h-100">
                        <div class="d-flex flex-column align-items-center">
                            <div class="category-icon-container mb-3">
                                <i class="bi bi-code-slash fs-3 text-primary"></i>
                            </div>
                            <h5 class="fw-bold mb-1">Web Development</h5>
                            <p class="text-muted small">15 Courses</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="#" class="text-decoration-none text-dark">
                    <div class="card p-4 text-center border-0 shadow-sm category-card h-100">
                        <div class="d-flex flex-column align-items-center">
                            <div class="category-icon-container mb-3">
                                <i class="bi bi-easel2-fill fs-3 text-primary"></i>
                            </div>
                            <h5 class="fw-bold mb-1">Graphic Design</h5>
                            <p class="text-muted small">10 Courses</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="#" class="text-decoration-none text-dark">
                    <div class="card p-4 text-center border-0 shadow-sm category-card h-100">
                        <div class="d-flex flex-column align-items-center">
                            <div class="category-icon-container mb-3">
                                <i class="bi bi-briefcase-fill fs-3 text-primary"></i>
                            </div>
                            <h5 class="fw-bold mb-1">Business</h5>
                            <p class="text-muted small">20 Courses</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="#" class="text-decoration-none text-dark">
                    <div class="card p-4 text-center border-0 shadow-sm category-card h-100">
                        <div class="d-column align-items-center">
                            <div class="category-icon-container mb-3">
                                <i class="bi bi-bar-chart-line-fill fs-3 text-primary"></i>
                            </div>
                            <h5 class="fw-bold mb-1">Data Science</h5>
                            <p class="text-muted small">8 Courses</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<section id="courses" class="py-5">
    <div class="container">
        <h2 class="section-title text-center">Featured Courses</h2>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="card course-card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <img src="https://images.unsplash.com/photo-1542831371-29b0f74f9713?ixlib=rb-4.0.3&q=85&fm=jpg&crop=entropy&cs=srgb&w=1080" class="card-img-top course-thumbnail" alt="Web Development Course">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Mastering Web Development</h5>
                        <p class="text-muted mb-2">By John Doe</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="course-price fs-5">PKR 10,000</span>
                            <div class="text-warning">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card course-card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <img src="https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?ixlib=rb-4.0.3&q=85&fm=jpg&crop=entropy&cs=srgb&w=1080" class="card-img-top course-thumbnail" alt="Digital Marketing Course">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Digital Marketing Fundamentals</h5>
                        <p class="text-muted mb-2">By Jane Smith</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="course-price fs-5">PKR 8,500</span>
                            <div class="text-warning">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card course-card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <img src="https://images.unsplash.com/photo-1549490349-f06b6377755a?ixlib=rb-4.0.3&q=85&fm=jpg&crop=entropy&cs=srgb&w=1080" class="card-img-top course-thumbnail" alt="Graphic Design Course">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Advanced Graphic Design</h5>
                        <p class="text-muted mb-2">By Emily White</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="course-price fs-5">PKR 12,000</span>
                            <div class="text-warning">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                                <i class="bi bi-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="#" class="btn btn-custom btn-custom-primary">View All Courses</a>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <h2 class="section-title text-center">Why Choose Us?</h2>
        <div class="row g-5">
            <div class="col-lg-3 col-md-6 feature-item">
                <div class="feature-icon-container">
                    <i class="bi bi-person-workspace"></i>
                </div>
                <h5 class="fw-bold">Expert Instructors</h5>
                <p class="text-muted">Learn from industry-leading professionals with real-world experience.</p>
            </div>
            <div class="col-lg-3 col-md-6 feature-item">
                <div class="feature-icon-container">
                    <i class="bi bi-clock-history"></i>
                </div>
                <h5 class="fw-bold">Flexible Learning</h5>
                <p class="text-muted">Study anytime, anywhere, at your own pace and schedule.</p>
            </div>
            <div class="col-lg-3 col-md-6 feature-item">
                <div class="feature-icon-container">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <h5 class="fw-bold">Affordable Pricing</h5>
                <p class="text-muted">High-quality education that won't break the bank.</p>
            </div>
            <div class="col-lg-3 col-md-6 feature-item">
                <div class="feature-icon-container">
                    <i class="bi bi-patch-check-fill"></i>
                </div>
                <h5 class="fw-bold">Certificates</h5>
                <p class="text-muted">Get a recognized certificate to showcase your skills.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h2 class="section-title text-center">What Our Students Say</h2>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card p-4 shadow-sm testimonial-card h-100">
                    <p class="testimonial-text">"The video quality was amazing, and the lessons were so easy to follow. I landed a new job within a month of completing the course!"</p>
                    <div class="d-flex align-items-center mt-auto pt-3 testimonial-author">
                        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=50&h=50" class="rounded-circle me-3" alt="Ayesha K.">
                        <div>
                            <h6 class="mb-0 fw-bold">Ayesha K.</h6>
                            <p class="small text-muted mb-0">Full Stack Developer</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-4 shadow-sm testimonial-card h-100">
                    <p class="testimonial-text">"This platform is fantastic. The instructor was engaging, and the content was practical and easy to apply. Highly recommended!"</p>
                    <div class="d-flex align-items-center mt-auto pt-3 testimonial-author">
                        <img src="https://images.unsplash.com/photo-1628157588553-5eeea00af15c?w=50&h=50" class="rounded-circle me-3" alt="Farhan A.">
                        <div>
                            <h6 class="mb-0 fw-bold">Farhan A.</h6>
                            <p class="small text-muted mb-0">Digital Marketer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cta-banner text-center">
    <div class="container">
        <h2 class="display-4 fw-bold mb-3">Ready to Start Learning?</h2>
        <p class="lead mb-4">Join thousands of students and transform your career today.</p>
        <a href="#" class="btn btn-lg btn-light btn-custom">Sign Up for Free</a>
    </div>
</section>

<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5>Online Learning Platform</h5>
                <p class="text-muted small">Your one-stop solution for high-quality online courses.</p>
            </div>
            <div class="col-md-2 mb-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white text-decoration-none">Home</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Courses</a></li>
                    <li><a href="#" class="text-white text-decoration-none">About Us</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-2 mb-4">
                <h5>Legal</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white text-decoration-none">Privacy Policy</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Terms of Service</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h5>Connect With Us</h5>
                <div class="d-flex fs-4 gap-3">
                    <a href="#" class="text-white"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
        <hr class="border-white-50">
        <div class="text-center text-muted small mt-3">
            &copy; {{ date('Y') }} Online Learning Platform. All Rights Reserved.
        </div>
    </div>
</footer>
@endsection