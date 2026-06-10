@extends('layout')

@section('title','User Guide — GoalsGetter')

@section('content')

<style>
  .guide-section {
    scroll-margin-top: 80px;
  }

  .guide-toc {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    position: sticky;
    top: 20px;
    height: fit-content;
  }

  .guide-toc a {
    display: block;
    padding: 8px 0;
    color: #495057;
    text-decoration: none;
    transition: all 0.2s ease;
    border-left: 3px solid transparent;
    padding-left: 12px;
  }

  .guide-toc a:hover {
    color: #28a745;
    border-left-color: #28a745;
  }

  .feature-demo {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border-radius: 8px;
    padding: 20px;
    margin: 20px 0;
    border-left: 4px solid #28a745;
  }

  .feature-demo h5 {
    color: #28a745;
    margin-bottom: 12px;
  }

  .step-number {
    display: inline-block;
    background: #28a745;
    color: white;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    line-height: 32px;
    text-align: center;
    font-weight: bold;
    margin-right: 10px;
  }

  .step-item {
    margin: 15px 0;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 6px;
  }

  .icon-badge {
    display: inline-block;
    font-size: 2rem;
    margin-right: 10px;
  }

  .guide-card {
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 20px;
    margin: 20px 0;
    transition: all 0.3s ease;
  }

  .guide-card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .tip {
    background: #e7f3ff;
    border-left: 4px solid #0056b3;
    padding: 15px;
    border-radius: 4px;
    margin: 15px 0;
  }

  .warning {
    background: #fff3cd;
    border-left: 4px solid #ff6c00;
    padding: 15px;
    border-radius: 4px;
    margin: 15px 0;
  }

  .success {
    background: #d4edda;
    border-left: 4px solid #28a745;
    padding: 15px;
    border-radius: 4px;
    margin: 15px 0;
  }

  .code-block {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 15px;
    font-family: monospace;
    overflow-x: auto;
    margin: 15px 0;
  }

  h2 {
    border-bottom: 3px solid #28a745;
    padding-bottom: 10px;
    margin-top: 40px;
    margin-bottom: 20px;
  }

  h3 {
    color: #28a745;
    margin-top: 25px;
  }
</style>

<div class="container py-5">
  <div class="row">
    <!-- Sidebar Navigation -->
    <div class="col-lg-3">
      <div class="guide-toc">
        <h5 class="mb-3">[GUIDE] Guide Contents</h5>
        <a href="#overview">Dashboard Overview</a>
        <a href="#weather-calendar">Weather & Calendar</a>
        <a href="#navigation">Navigation</a>
        <a href="#overview-cards">Overview Cards</a>
        <a href="#tasks">Tasks Management</a>
        <a href="#goals">Goals Management</a>
        <a href="#habits">Habits Tracking</a>
        <a href="#analytics">Weekly Analytics</a>
        <a href="#upcoming">Upcoming Section</a>
        <a href="#tips">Pro Tips</a>
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-lg-9">
      <h1 class="mb-4">[BOOK] GoalsGetter User Guide</h1>
      <p class="lead">Learn how to use all features of GoalsGetter to maximize your productivity.</p>

      <!-- Overview Section -->
      <div class="guide-section" id="overview">
        <h2>[GOAL] Dashboard Overview</h2>
        <p>Welcome to the GoalsGetter dashboard! This is your personal productivity command center where you can:</p>
        <ul>
          <li>View your daily progress at a glance</li>
          <li>Track goals, habits, and tasks</li>
          <li>Monitor your productivity score</li>
          <li>See weekly analytics and upcoming deadlines</li>
        </ul>
        <p class="text-muted">The dashboard updates in real-time as you complete tasks and reach milestones.</p>
      </div>

      <!-- Weather & Calendar -->
      <div class="guide-section" id="weather-calendar">
        <h2>🌤️ Weather & Calendar Widgets</h2>
        <p>Located in the left sidebar for quick reference:</p>

        <h4 class="mt-4">Weather Widget</h4>
        <div class="feature-demo">
          <p><strong>What it shows:</strong> Current weather conditions, temperature, and humidity</p>
          <p><strong>How it works:</strong> Automatically detects your location using your device's geolocation</p>
          <p><strong>Updates:</strong> Refreshes automatically when you load the dashboard</p>
          <div class="tip">
            <strong>[TIP] Tip:</strong> Use this to plan indoor/outdoor tasks. If it's sunny, maybe it's a good time for a workout!
          </div>
        </div>

        <h4 class="mt-4">Calendar Widget</h4>
        <div class="feature-demo">
          <p><strong>What it shows:</strong> Current month calendar with today's date highlighted</p>
          <p><strong>Today's Date:</strong> Marked in blue for quick reference</p>
          <div class="tip">
            <strong>[TIP] Tip:</strong> Use this to quickly check what day of the month it is and plan ahead for upcoming deadlines.
          </div>
        </div>
      </div>

      <!-- Navigation -->
      <div class="guide-section" id="navigation">
        <h2>[NAV] Navigation Menu</h2>
        <p>The sticky navigation menu on the left sidebar helps you jump to different sections:</p>
        
        <div class="step-item">
          <span class="step-number">1</span>
          <strong>Overview</strong> - Quick summary of your goals, habits, tasks, and productivity score
        </div>
        
        <div class="step-item">
          <span class="step-number">2</span>
          <strong>Tasks</strong> - Jump to today's tasks section
        </div>
        
        <div class="step-item">
          <span class="step-number">3</span>
          <strong>Goals</strong> - View goal management section
        </div>
        
        <div class="step-item">
          <span class="step-number">4</span>
          <strong>Habits</strong> - Check habit tracking section
        </div>
        
        <div class="step-item">
          <span class="step-number">5</span>
          <strong>Analytics</strong> - View weekly analytics and trends
        </div>

        <div class="success">
          <strong>✓ Quick Navigation:</strong> Click any menu item to instantly scroll to that section!
        </div>
      </div>

      <!-- Overview Cards -->
      <div class="guide-section" id="overview-cards">
        <h2>[CHART] Overview Cards</h2>
        <p>The summary cards at the top show your key metrics:</p>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <div class="guide-card">
              <div class="icon-badge">[GOAL]</div>
              <h5>Goals</h5>
              <p>Total number of active goals you've created</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="guide-card">
              <div class="icon-badge">[HABIT]</div>
              <h5>Habits</h5>
              <p>Number of habits you're currently tracking</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="guide-card">
              <div class="icon-badge">[TASK]</div>
              <h5>Tasks</h5>
              <p>Total tasks you've added to the system</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="guide-card">
              <div class="icon-badge">[STAR]</div>
              <h5>Productivity</h5>
              <p>Your overall productivity percentage based on completed tasks</p>
            </div>
          </div>
        </div>

        <div class="tip">
          <strong>[TIP] Pro Tip:</strong> Watch these numbers grow as you complete tasks and reach goals. The productivity percentage updates automatically based on your completion rate!
        </div>
      </div>

      <!-- Tasks Management -->
      <div class="guide-section" id="tasks">
        <h2>[TASK] Today's Tasks</h2>
        <p>This section shows your scheduled tasks for today with quick access to manage them.</p>

        <h4 class="mt-4">Understanding Your Task List</h4>
        <div class="step-item">
          <span class="step-number">1</span>
          <strong>Task Name</strong> - Description of what you need to do
        </div>
        
        <div class="step-item">
          <span class="step-number">2</span>
          <strong>Due Date</strong> - When the task is scheduled
        </div>
        
        <div class="step-item">
          <span class="step-number">3</span>
          <strong>Priority</strong> - High, Medium, or Low priority
        </div>
        
        <div class="step-item">
          <span class="step-number">4</span>
          <strong>Status</strong> - Pending, In Progress, or Completed
        </div>

        <h4 class="mt-4">How to Manage Tasks</h4>
        <div class="feature-demo">
          <p><strong>View All Tasks:</strong> Click the "Manage Tasks" button to see your complete task list</p>
          <p><strong>Create New Task:</strong> Use the task creation form to add new tasks with priority and due dates</p>
          <p><strong>Update Status:</strong> Mark tasks as in-progress or completed to track your progress</p>
        </div>

        <div class="warning">
          <strong>⚠️ Note:</strong> Tasks appearing here are based on your current session. Tasks are personal to your account.
        </div>
      </div>

      <!-- Goals Management -->
      <div class="guide-section" id="goals">
        <h2>[GOAL] Goal Management</h2>
        <p>Set and track long-term goals with categories and progress tracking.</p>

        <h4 class="mt-4">Creating a Goal</h4>
        <div class="step-item">
          <span class="step-number">1</span>
          <strong>Click "Manage Goals"</strong> to access the goals page
        </div>
        
        <div class="step-item">
          <span class="step-number">2</span>
          <strong>Click "Create Goal"</strong> button
        </div>
        
        <div class="step-item">
          <span class="step-number">3</span>
          <strong>Fill in the details:</strong>
          <ul>
            <li>Goal title (e.g., "Lose 10 pounds")</li>
            <li>Select a category (Health, Career, Personal, Learning, Finance)</li>
            <li>Add a description of your goal</li>
            <li>Set initial progress percentage</li>
          </ul>
        </div>
        
        <div class="step-item">
          <span class="step-number">4</span>
          <strong>Click "Create Goal"</strong> to save
        </div>

        <h4 class="mt-4">Goal Categories</h4>
        <div class="feature-demo">
          <p><strong>Health:</strong> Fitness, wellness, and health-related goals</p>
          <p><strong>Career:</strong> Professional development and job-related goals</p>
          <p><strong>Personal:</strong> Personal development and self-improvement</p>
          <p><strong>Learning:</strong> Educational goals and skill development</p>
          <p><strong>Finance:</strong> Financial goals and savings targets</p>
        </div>

        <div class="success">
          <strong>✓ Track Progress:</strong> Update your goal progress percentage as you make progress toward completion!
        </div>
      </div>

      <!-- Habits Tracking -->
      <div class="guide-section" id="habits">
        <h2>[HABIT] Habit Tracking</h2>
        <p>Build positive habits by tracking them consistently over time.</p>

        <h4 class="mt-4">Creating a Habit</h4>
        <div class="step-item">
          <span class="step-number">1</span>
          <strong>Click "Manage Habits"</strong> to access habits page
        </div>
        
        <div class="step-item">
          <span class="step-number">2</span>
          <strong>Click "Create Habit"</strong> button
        </div>
        
        <div class="step-item">
          <span class="step-number">3</span>
          <strong>Enter habit details:</strong>
          <ul>
            <li>Habit name (e.g., "Morning meditation")</li>
            <li>Frequency (Daily, Weekly, Monthly)</li>
            <li>Description of your habit</li>
          </ul>
        </div>
        
        <div class="step-item">
          <span class="step-number">4</span>
          <strong>Click "Create Habit"</strong> to save
        </div>

        <h4 class="mt-4">Habit Frequencies</h4>
        <div class="feature-demo">
          <p><strong>Daily:</strong> Something you want to do every day (e.g., exercise, meditation)</p>
          <p><strong>Weekly:</strong> Something you want to do once or more per week (e.g., meal prep)</p>
          <p><strong>Monthly:</strong> Something you want to do once or more per month (e.g., review finances)</p>
        </div>

        <div class="tip">
          <strong>[TIP] Habit Building Tip:</strong> Start with 1-2 new habits per month. Small consistent habits build big changes over time!
        </div>
      </div>

      <!-- Weekly Analytics -->
      <div class="guide-section" id="analytics">
        <h2>[CHART] Weekly Analytics</h2>
        <p>Track your productivity patterns throughout the week.</p>

        <div class="feature-demo">
          <p><strong>What you see:</strong> A breakdown of your productivity percentage for each day of the week</p>
          <p><strong>How it's calculated:</strong> Based on the number of completed tasks divided by total tasks scheduled each day</p>
          <p><strong>How to use it:</strong> Identify your most and least productive days to plan your workload better</p>
        </div>

        <h4 class="mt-4">Interpreting Your Data</h4>
        <div class="step-item">
          <span class="step-number">1</span>
          <strong>High percentage days (80-100%)</strong> - You're crushing your goals! Learn what made these days successful.
        </div>
        
        <div class="step-item">
          <span class="step-number">2</span>
          <strong>Medium percentage days (40-79%)</strong> - Good effort. See if you can reduce distractions or adjust your schedule.
        </div>
        
        <div class="step-item">
          <span class="step-number">3</span>
          <strong>Low percentage days (0-39%)</strong> - Time to analyze what went wrong and plan better for the next week.
        </div>

        <div class="success">
          <strong>✓ Use this data:</strong> Look for patterns and adjust your weekly planning strategy based on your productivity patterns!
        </div>
      </div>

      <!-- Upcoming Section -->
      <div class="guide-section" id="upcoming">
        <h2>[BELL] Upcoming Section</h2>
        <p>Quick view of upcoming tasks and goals.</p>

        <div class="feature-demo">
          <p><strong>What it shows:</strong> A list of tasks and goals coming up in the near future</p>
          <p><strong>How it helps:</strong> Plan ahead so you're never caught off guard by deadlines</p>
        </div>

        <div class="tip">
          <strong>[TIP] Planning Tip:</strong> Check this section at the start of each week to plan your workload and avoid last-minute rushes!
        </div>
      </div>

      <!-- Pro Tips -->
      <div class="guide-section" id="tips">
        <h2>[STAR] Pro Tips for Success</h2>

        <div class="feature-demo">
          <h5>[GOAL] Tip #1: Start Small</h5>
          <p>Don't try to create 50 goals at once. Start with 3-5 meaningful goals and build from there.</p>
        </div>

        <div class="feature-demo">
          <h5>[HABIT] Tip #2: Make Habits Sustainable</h5>
          <p>Create habits that take 5-15 minutes. Small daily habits are easier to maintain than big ones.</p>
        </div>

        <div class="feature-demo">
          <h5>[TASK] Tip #3: Prioritize Your Tasks</h5>
          <p>Mark important tasks as "High" priority. Focus on completing high-priority tasks first each day.</p>
        </div>

        <div class="feature-demo">
          <h5>[CHART] Tip #4: Review Weekly</h5>
          <p>Every Sunday, review your week. Check your analytics and plan next week based on what you learned.</p>
        </div>

        <div class="feature-demo">
          <h5>[CHECK] Tip #5: Celebrate Wins</h5>
          <p>Mark tasks as complete even for small wins. The completion feels rewarding and keeps you motivated!</p>
        </div>

        <div class="feature-demo">
          <h5>[WORLD] Tip #6: Use the Weather</h5>
          <p>Plan outdoor activities when weather is good, indoor activities when it's not. The weather widget helps with this!</p>
        </div>

        <div class="feature-demo">
          <h5>[PHONE] Tip #7: Check Daily</h5>
          <p>Visit your dashboard every morning. A quick 2-minute review sets you up for success!</p>
        </div>
      </div>

      <!-- Getting Help -->
      <div class="guide-section" style="margin-top: 50px; padding-top: 30px; border-top: 2px solid #dee2e6;">
        <h2>[HELP] Need More Help?</h2>
        <p>If you have questions or need assistance:</p>
        <ul>
          <li>Hover over any element to see helpful tooltips</li>
          <li>Check the navigation menu for quick access to different features</li>
          <li>Make sure you're logged in to access your personal data</li>
        </ul>
        
        <div class="success">
          <strong>[PARTY] Ready to get started?</strong> Go to your <a href="{{ route('dashboard') }}">Dashboard</a> and start creating your first goal!
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
