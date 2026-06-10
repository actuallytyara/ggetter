@extends('layout')

@section('title','GoalsGetter — Home')

@section('content')

<style>
  /* Animations */
  @keyframes slideInUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
    }
    to {
      opacity: 1;
    }
  }

  @keyframes progressFill {
    from {
      width: 0;
    }
    to {
      width: var(--progress-value);
    }
  }

  @keyframes pulse {
    0%, 100% {
      box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
    }
    50% {
      box-shadow: 0 0 0 10px rgba(40, 167, 69, 0);
    }
  }

  @keyframes countUp {
    from {
      opacity: 0;
      transform: scale(0.8);
    }
    to {
      opacity: 1;
      transform: scale(1);
    }
  }

  .mock-ui {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    animation: slideInUp 0.8s ease-out;
  }

  .progress-bar {
    animation: progressFill 1.5s ease-out forwards !important;
    --progress-value: 70%;
  }

  .task-item {
    animation: slideInUp 0.5s ease-out backwards;
    transition: all 0.3s ease;
    padding: 12px;
    border-radius: 6px;
    border-left: 3px solid #28a745;
  }

  .task-item:hover {
    background-color: #f0f0f0;
    transform: translateX(5px);
  }

  .task-item.completed {
    opacity: 0.6;
    border-left-color: #6c757d;
  }

  .task-item:nth-child(1) { animation-delay: 0.1s; }
  .task-item:nth-child(2) { animation-delay: 0.2s; }
  .task-item:nth-child(3) { animation-delay: 0.3s; }

  .feature-card {
    transition: all 0.3s ease;
    cursor: pointer;
  }

  .feature-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15) !important;
  }

  .stat-card {
    animation: countUp 0.6s ease-out;
  }

  .stat-card:nth-child(1) { animation-delay: 0.1s; }
  .stat-card:nth-child(2) { animation-delay: 0.2s; }
  .stat-card:nth-child(3) { animation-delay: 0.3s; }

  .stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: #28a745;
  }

  .checkbox-demo {
    cursor: pointer;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
  }

  .checkbox-demo:hover input[type="checkbox"] {
    transform: scale(1.1);
  }

  .checkbox-demo input[type="checkbox"] {
    transition: transform 0.2s ease;
    cursor: pointer;
  }
</style>
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <h1 class="display-5 fw-bold">Bring focus to your goals. Ship better habits.</h1>
          <p class="lead text-muted">A clean, minimal productivity app to manage goals, habits, and daily tasks — inspired by Notion and Trello.</p>
          <div class="mt-4">
            <a href="{{ route('register') }}" class="btn btn-success btn-lg me-2">Get Started</a>
            <a href="{{ route('goals.index') }}" class="btn btn-outline-secondary btn-lg">View Goals</a>
          </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block">
          <div class="card shadow-sm">
            <div class="card-body mock-ui p-4">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                  <strong class="d-block mb-1">Today's Progress</strong>
                  <small class="text-muted">3 of 4 tasks completed</small>
                </div>
                <div class="text-end">
                  <div class="stat-number">75%</div>
                </div>
              </div>
              
              <!-- Animated Progress Bar -->
              <div class="progress mb-4" style="height: 12px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 75%"></div>
              </div>

              <!-- Interactive Task List -->
              <div class="mb-3">
                <small class="text-muted d-block mb-2">Today's Tasks</small>
                <div class="task-item completed">
                  <label class="checkbox-demo">
                    <input type="checkbox" checked>
                    <span><del>Morning workout</del></span>
                  </label>
                </div>
                <div class="task-item">
                  <label class="checkbox-demo">
                    <input type="checkbox">
                    <span>Review project requirements</span>
                  </label>
                </div>
                <div class="task-item">
                  <label class="checkbox-demo">
                    <input type="checkbox">
                    <span>Prepare presentation</span>
                  </label>
                </div>
                <div class="task-item completed">
                  <label class="checkbox-demo">
                    <input type="checkbox" checked>
                    <span><del>Lunch meeting</del></span>
                  </label>
                </div>
              </div>

              <!-- Summary Stats -->
              <hr class="my-3">
              <div class="row g-3 text-center">
                <div class="col-4">
                  <div class="stat-number">4</div>
                  <small class="text-muted">Tasks</small>
                </div>
                <div class="col-4">
                  <div class="stat-number">2</div>
                  <small class="text-muted">Habits</small>
                </div>
                <div class="col-4">
                  <div class="stat-number">1</div>
                  <small class="text-muted">Goals</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="features" class="py-5">
    <div class="container">
      <h2 class="h3 mb-4">Features</h2>
      <div class="row g-3">
        <div class="col-md-3">
          <div class="card feature-card h-100 border-0 shadow-sm p-3">
            <div class="mb-3" style="font-size: 2rem;">🎯</div>
            <h5>Goal Management</h5>
            <p class="text-muted small">Define long-term goals and break them into subgoals and tasks.</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card feature-card h-100 border-0 shadow-sm p-3">
            <div class="mb-3" style="font-size: 2rem;">🔥</div>
            <h5>Habit Tracker</h5>
            <p class="text-muted small">Streaks, reminders and habit insights to stay consistent.</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card feature-card h-100 border-0 shadow-sm p-3">
            <div class="mb-3" style="font-size: 2rem;">📋</div>
            <h5>Tasks & Scheduling</h5>
            <p class="text-muted small">Plan your day and sync with deadlines.</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card feature-card h-100 border-0 shadow-sm p-3">
            <div class="mb-3" style="font-size: 2rem;">📊</div>
            <h5>Analytics</h5>
            <p class="text-muted small">Weekly progress and productivity scoring.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 bg-light">
    <div class="container">
      <h2 class="h3 mb-4">Goal Categories</h2>
      <div class="d-flex flex-wrap gap-2">
        @foreach(['Health','Career','Personal','Learning','Finance'] as $cat)
          <span class="badge rounded-pill bg-white border text-muted px-3 py-2">{{ $cat }}</span>
        @endforeach
      </div>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
      <h2 class="h3 mb-4">Statistics</h2>
      <div class="row g-3">
        <div class="col-md-4">
          <div class="card stat-card p-4 shadow-sm text-center border-0">
            <div class="stat-number" data-count="1200">0</div>
            <div class="text-muted small">Active Users</div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card stat-card p-4 shadow-sm text-center border-0">
            <div class="stat-number" data-count="4800">0</div>
            <div class="text-muted small">Goals Created</div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card stat-card p-4 shadow-sm text-center border-0">
            <div class="stat-number" data-count="12000">0</div>
            <div class="text-muted small">Habits Tracked</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 bg-light">
    <div class="container">
      <h2 class="h3 mb-4">Testimonials</h2>
      <div class="row g-3">
        <div class="col-md-6">
          <blockquote class="blockquote p-3 border-start">
            <p>"Clean and simple — helped me build a morning routine."</p>
            <footer class="blockquote-footer">S. Engineer</footer>
          </blockquote>
        </div>
        <div class="col-md-6">
          <blockquote class="blockquote p-3 border-start">
            <p>"Love the habit streaks and weekly score."</p>
            <footer class="blockquote-footer">A. Product Manager</footer>
          </blockquote>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 text-center">
    <div class="container">
      <h3>Ready to reach your goals?</h3>
      <a href="{{ route('register') }}" class="btn btn-success btn-lg mt-3">Create an account</a>
    </div>
  </section>

  <script>
    // Animated counter for statistics
    function animateCounters() {
      const statNumbers = document.querySelectorAll('.stat-number[data-count]');
      
      const observerOptions = {
        threshold: 0.5
      };
      
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const element = entry.target;
            const targetCount = parseInt(element.dataset.count);
            let currentCount = 0;
            const increment = targetCount / 40;
            const duration = 1500; // 1.5 seconds
            const startTime = Date.now();
            
            const updateCount = () => {
              const elapsed = Date.now() - startTime;
              const progress = Math.min(elapsed / duration, 1);
              currentCount = Math.floor(targetCount * progress);
              
              if (currentCount >= 1000) {
                element.textContent = (currentCount / 1000).toFixed(1) + 'k';
              } else {
                element.textContent = currentCount.toLocaleString();
              }
              
              if (progress < 1) {
                requestAnimationFrame(updateCount);
              }
            };
            
            updateCount();
            observer.unobserve(element);
          }
        });
      }, observerOptions);
      
      statNumbers.forEach(el => observer.observe(el));
    }

    // Interactive task checkboxes demo
    function initTaskDemo() {
      const checkboxes = document.querySelectorAll('.task-item input[type="checkbox"]');
      
      checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
          const label = this.closest('.checkbox-demo');
          const taskItem = this.closest('.task-item');
          
          if (this.checked) {
            taskItem.classList.add('completed');
            label.style.opacity = '0.6';
          } else {
            taskItem.classList.remove('completed');
            label.style.opacity = '1';
          }
        });
      });
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', () => {
      animateCounters();
      initTaskDemo();
    });
  </script>
@endsection
