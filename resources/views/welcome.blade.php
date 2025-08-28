<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STARBLOG - Where good ideas find you</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top border-bottom">
        <div class="container-fluid px-4">
            <!-- Logo -->
            <a class="navbar-brand fw-bold fs-2 text-dark" href="#">STARBLOG</a>
            
            <!-- Mobile toggle button -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation items -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto d-flex align-items-center">
                    <a class="nav-link text-muted me-4" href="#">Our story</a>
                    <a class="nav-link text-muted me-4" href="#">Membership</a>
                    <a class="nav-link text-muted me-4" href="#">Write</a>
                    <a class="nav-link text-muted me-4" href="{{ route('login') }}">Sign in</a>
                    <button type="button" class="btn btn-dark rounded-pill px-4 py-2" 
                            data-bs-toggle="modal" data-bs-target="#getStartedModal">
                    Get started
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section py-5">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="hero-title mb-4">Human<br>stories & ideas</h1>
                    <p class="hero-subtitle mb-5">A place to read, write, and deepen your understanding</p>
                    <a href="{{ route ('register') }}" class="btn btn-dark btn-lg rounded-pill px-5 py-3 hero-btn">Start reading</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Stories -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h2 class="section-title mb-3">Featured stories</h2>
                    <p class="section-subtitle">Discover stories, thinking, and expertise from writers on any topic.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <article class="story-card h-100">
                        <span class="badge story-badge mb-3">Technology</span>
                        <h3 class="story-title mb-3">The Future of Remote Work: Insights from Leading Companies</h3>
                        <p class="story-excerpt mb-4">How distributed teams are reshaping the modern workplace and what it means for the future of work.</p>
                        <div class="story-meta">
                            <span class="author">Sarah Chen</span>
                            <span class="separator">·</span>
                            <span class="read-time">8 min read</span>
                        </div>
                    </article>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <article class="story-card h-100">
                        <span class="badge story-badge mb-3">Environment</span>
                        <h3 class="story-title mb-3">Sustainable Living in Urban Environments</h3>
                        <p class="story-excerpt mb-4">Practical strategies for reducing your environmental footprint while living in the city.</p>
                        <div class="story-meta">
                            <span class="author">Marcus Rodriguez</span>
                            <span class="separator">·</span>
                            <span class="read-time">6 min read</span>
                        </div>
                    </article>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <article class="story-card h-100">
                        <span class="badge story-badge mb-3">Psychology</span>
                        <h3 class="story-title mb-3">The Art of Mindful Decision Making</h3>
                        <p class="story-excerpt mb-4">Research-backed techniques for making better decisions in both personal and professional contexts.</p>
                        <div class="story-meta">
                            <span class="author">Dr. Emily Watson</span>
                            <span class="separator">·</span>
                            <span class="read-time">5 min read</span>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer py-4 border-top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <div class="footer-links d-flex flex-wrap justify-content-center gap-4">
                        <a href="#" class="footer-link">Help</a>
                        <a href="#" class="footer-link">Status</a>
                        <a href="#" class="footer-link">About</a>
                        <a href="#" class="footer-link">Careers</a>
                        <a href="#" class="footer-link">Press</a>
                        <a href="#" class="footer-link">Blog</a>
                        <a href="#" class="footer-link">Privacy</a>
                        <a href="#" class="footer-link">Rules</a>
                        <a href="#" class="footer-link">Terms</a>
                        <a href="#" class="footer-link">Text to speech</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Get Started Modal -->
<div class="modal fade" id="getStartedModal" tabindex="-1" aria-labelledby="getStartedLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content p-4">
      <div class="modal-header border-0">
        <h5 class="modal-title  text-dark" id="getStartedLabel">Get Started</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
         <span class="fw-light fs-2 text-dark ">Join STARBLOG</span>
         <br>
         <br>
       <!-- Google Button -->
<a href="#" class="btn btn-outline-dark rounded-pill w-100 d-flex align-items-center justify-content-center">
  <div class="d-flex align-items-center gap-2">
    <svg width="20" height="20" viewBox="0 0 533.5 544.3">
      <path fill="#4285F4" d="M533.5 278.4c0-17.4-1.4-34.2-4.1-50.5H272v95.5h146.9c-6.4 34.6-25.7 63.9-54.7 83.4v69.3h88.5c51.8-47.7 81.8-118 81.8-197.7z"/>
      <path fill="#34A853" d="M272 544.3c73.8 0 135.7-24.4 180.9-66.3l-88.5-69.3c-24.6 16.5-56.2 26-92.4 26-71 0-131-47.9-152.5-112.1H30.6v70.4C76.1 482 168.8 544.3 272 544.3z"/>
      <path fill="#FBBC05" d="M119.5 324.9c-5.8-17.4-9.1-36-9.1-55s3.3-37.6 9.1-55v-70.4H30.6C11.2 200.6 0 238.6 0 278.9s11.2 78.3 30.6 106.3l88.9-70.3z"/>
      <path fill="#EA4335" d="M272 107.9c38.5 0 73 13.3 100.3 39.4l75.3-75.3C407.7 24.4 345.8 0 272 0 168.8 0 76.1 62.3 30.6 155.9l88.9 70.4c21.5-64.2 81.5-112.1 152.5-112.1z"/>
    </svg>
    <span>Sign up with Google</span>
  </div>
</a>

<!-- Facebook Button -->
<a href="{{ route('register') }}" class="btn btn-outline-dark rounded-pill w-100 d-flex align-items-center justify-content-center">
  <div class="d-flex align-items-center gap-2">
    <svg width="20" height="20" viewBox="0 0 24 24">
      <path fill="#1877F2" d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692V11.06h3.128V8.414c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.464.099 2.796.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.31h3.587l-.467 3.646h-3.12V24h6.116c.73 0 1.324-.593 1.324-1.324V1.325C24 .593 23.407 0 22.675 0z"/>
    </svg>
    <span>Sign up with Facebook</span>
  </div>
</a>

<!-- Email Signup Button -->
<a href="{{ route('register') }}" class="btn btn-outline-dark rounded-pill w-100 d-flex align-items-center justify-content-center">
  <div class="d-flex align-items-center gap-2">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
      <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 
               1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 
               4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 
               14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 
               9.586l-1.239-.757zM10.197 8.243 16 
               11.801V4.697l-5.803 3.546z"/>
    </svg>
    <span>Sign up with email</span>
  </div>
</a>



        <!-- Already have account -->
        <p class="small text-dark mt-2">
          Already have an account? <a href="{{ route('login') }}">Sign in</a>
        </p>

        <!-- Terms -->
        <p class="text-dark small mt-3">
          Click “Sign up” to agree to Medium’s <a href="#">Terms of Service</a> and acknowledge that Medium’s <a href="#">Privacy Policy</a> applies to you.
        </p>
      </div>
    </div>
  </div>
</div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>