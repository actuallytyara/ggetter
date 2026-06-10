<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>GGetter</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Pacifico&display=swap" rel="stylesheet">

<!-- Tailwind CDN -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'avocado': '#A8C06A',
                    'avocado-light': '#EAF2D6',
                    'forest': '#12391f',
                    'blue-alert': '#2563EB'
                },
                fontFamily: {
                    sans: ['Poppins', 'ui-sans-serif', 'system-ui'],
                    script: ['Pacifico']
                }
            }
        }
    }
</script>

<style>
    .script { font-family: Pacifico, cursive; }
    .stars { color: #f59e0b; }
    .blue-alert { border-left: 4px solid #2563EB; }
</style>
</head>
<body class="bg-avocado-light text-forest font-sans antialiased">

<header class="bg-avocado px-6 py-4 shadow-sm">
    <div class="max-w-6xl mx-auto flex items-center justify-between">
        <div class="flex items-center gap-4">
            <img src="{{ asset('images/group-1.svg') }}" alt="Logo" class="w-10 h-10 object-contain">
            <div class="text-white font-bold">GoalsGetter</div>
        </div>
        <nav class="flex items-center gap-6">
            <a href="#about" class="text-white/90">About</a>
            <a href="#goals" class="text-white/90">Goals</a>
            <a href="#progress" class="text-white/90">Progress</a>
            <a href="#contact" class="text-white/90">Contact</a>
        </nav>
        <div class="flex items-center gap-3">
            <button class="bg-white/90 text-avocado px-3 py-1 rounded-md font-medium">Log In</button>
            <button class="bg-forest text-white px-3 py-1 rounded-md font-medium">Join Us</button>
        </div>
    </div>
</header>

<section class="hero">

    <div class="hero-content">

        <div class="hero-text">

            <h1>
                Achieve your goals.
                Stay
                <span class="script">productive</span>.
                Become
                <span class="script">better</span>
                every day.
            </h1>

            <p>
                Track your goals, build better habits,
                and improve your productivity every day.
            </p>

            <button class="primary-btn">
                Start Journey
            </button>

        </div>

        <div class="hero-image">
            <img src="{{ asset('images/hero-custom.png') }}" alt="Hero Image">
        </div>

    </div>

</section>

<section class="dashboard">

    <aside>

        <div class="dots">
            <span class="red"></span>
            <span class="yellow"></span>
            <span class="blue"></span>
        </div>

        <button>About Us</button>
        <button>Solutions</button>
        <button>Plans</button>

    </aside>

    <main>

        <div class="about-card" id="about">

            <div>
                <h2>About <span>Us</span></h2>

                <p>
                    GoalsGetter helps users manage goals,
                    track progress and build positive
                    habits through a simple and modern
                    productivity platform.
                </p>
            </div>

            <img src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=800">
        </div>

        <div class="stats">

            <div class="stat-card">

                <h1 id="counter">
                    0
                </h1>

                <p>Users</p>

            </div>

            <div class="small-cards">

                <div class="small-card">
                    Goal Tracking
                </div>

                <div class="small-card">
                    Habit Building
                </div>

            </div>

        </div>

    </main>

</section>

<section class="goal-section" id="goals">

    <h2>Your Goals</h2>

    <div class="goal-grid">

        <div class="goal-card">
            [LEARN]
            <h3>Study Goals</h3>
            <p>Track exams and assignments.</p>
        </div>

        <div class="goal-card">
            [STRONG]
            <h3>Fitness Goals</h3>
            <p>Create healthy routines.</p>
        </div>

        <div class="goal-card">
            [WORK]
            <h3>Career Goals</h3>
            <p>Develop your professional skills.</p>
        </div>

        <div class="goal-card">
            [MONEY]
            <h3>Financial Goals</h3>
            <p>Manage saving targets.</p>
        </div>

    </div>

</section>

<section class="workflow">

    <h2>How It Works</h2>

    <div class="steps">

        <div class="step">
            <span>1</span>
            <h3>Set Goal</h3>
        </div>

        <div class="arrow">→</div>

        <div class="step">
            <span>2</span>
            <h3>Track Progress</h3>
        </div>

        <div class="arrow">→</div>

        <div class="step">
            <span>3</span>
            <h3>Achieve Success</h3>
        </div>

    </div>

</section>

<section class="progress-section" id="progress">

    <h2>Your Progress</h2>

    <div class="progress-card">

        <p>Goal Completion</p>
        <div class="bar">
            <div class="fill fill1"></div>
        </div>

        <p>Daily Habits</p>
        <div class="bar">
            <div class="fill fill2"></div>
        </div>

        <p>Weekly Target</p>
        <div class="bar">
            <div class="fill fill3"></div>
        </div>

    </div>

</section>

<section class="testimonial">

    <h2>What Users Say</h2>

    <div class="testimonial-grid">

        <div class="testimonial-card">
            [5 STARS]
            <p>
                This platform helped me stay focused.
            </p>
        </div>

        <div class="testimonial-card">
            [5 STARS]
            <p>
                My productivity increased significantly.
            </p>
        </div>

        <div class="testimonial-card">
            [5 STARS]
            <p>
                Very easy and useful for daily goals.
            </p>
        </div>

    </div>

</section>

<section class="cta">

    <h2>
        Ready to Start Your Journey?
    </h2>

    <p>
        Set goals, track progress and become your best self.
    </p>

    <button>
        Get Started
    </button>

</section>

<footer id="contact">

    <h3>GoalsGetter</h3>

    <p>
        © 2026 All Rights Reserved
    </p>

</footer>

<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
