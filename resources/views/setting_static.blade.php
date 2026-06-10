<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Settings — Goals Getter</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { darkMode: 'class', theme: { extend: { colors: { 'avocado':'#A8C06A','avocado-light':'#EAF2D6','forest':'#12391f' } } } }
  </script>
</head>
<body class="bg-avocado-light font-poppins text-forest min-h-screen dark:bg-forest dark:text-avocado-light">
  <main class="max-w-6xl mx-auto p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Sidebar -->
    <aside class="md:col-span-1">
      <div class="bg-white rounded-xl p-4 shadow">
        <nav class="space-y-2">
          <a href="#" data-tab="profile" class="flex items-center gap-3 p-2 rounded hover:bg-gray-50"> <span>[USER]</span><span>Profile Info</span></a>
          <a href="#" data-tab="notifications" class="flex items-center gap-3 p-2 rounded hover:bg-gray-50"> <span>[BELL]</span><span>Notifications</span></a>
          <a href="#" data-tab="goals" class="flex items-center gap-3 p-2 rounded hover:bg-gray-50"> <span>[GOAL]</span><span>Goals Management</span></a>
          <a href="#" data-tab="security" class="flex items-center gap-3 p-2 rounded hover:bg-gray-50"> <span>[LOCK]</span><span>Security</span></a>
          <a href="#" data-tab="theme" class="flex items-center gap-3 p-2 rounded hover:bg-gray-50"> <span>[PALETTE]</span><span>Theme</span></a>
          <a href="#" data-tab="subscription" class="flex items-center gap-3 p-2 rounded hover:bg-gray-50"> <span>[CARD]</span><span>Subscription</span></a>
        </nav>
      </div>
    </aside>

    <!-- Settings form -->
    <section class="md:col-span-2 bg-white rounded-xl p-6 shadow">
      <h3 class="text-xl font-bold">Settings</h3>

      <!-- Tab contents -->
      <div id="tab-profile" class="tab-content hidden mt-4">
        <p class="text-sm text-gray-600">Profile settings (demo).</p>
      </div>

      <div id="tab-notifications" class="tab-content hidden mt-4">
        <p class="text-sm text-gray-600">Notification preferences (demo).</p>
      </div>

      <div id="tab-goals" class="tab-content hidden mt-4">
        <p class="text-sm text-gray-600">Goals management (demo).</p>
      </div>

      <div id="tab-security" class="tab-content hidden mt-4">
        <p class="text-sm text-gray-600">Security options (demo).</p>
      </div>

      <div id="tab-theme" class="tab-content mt-4">
        <form class="space-y-4" id="settings-form">
          <div>
            <label class="block text-sm font-medium text-gray-700">Update name</label>
            <input type="text" name="name" class="mt-1 w-full px-3 py-2 border rounded" placeholder="Your name">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Update email</label>
            <input type="email" name="email" class="mt-1 w-full px-3 py-2 border rounded" placeholder="you@company.com">
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Notifications</label>
              <div class="mt-2 space-y-2">
                <label class="flex items-center justify-between bg-gray-50 p-2 rounded"><span>Update notifications</span><input type="checkbox" checked></label>
                <label class="flex items-center justify-between bg-gray-50 p-2 rounded"><span>Logire notifications</span><input type="checkbox"></label>
                <label class="flex items-center justify-between bg-gray-50 p-2 rounded"><span>Eoposall notifications</span><input type="checkbox" checked></label>
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Theme</label>
              <div class="mt-2 flex items-center gap-3">
                <button type="button" class="btn-light px-3 py-2 bg-white rounded shadow">Light</button>
                <button type="button" class="btn-dark px-3 py-2 bg-forest text-white rounded">Dark</button>
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Subscription</label>
              <div class="mt-2 text-sm text-gray-500">Your plan: Free</div>
            </div>
          </div>

          <div class="pt-4">
            <button type="submit" class="save-btn bg-forest text-white px-4 py-2 rounded font-semibold">SAVE CHANGES</button>
          </div>
        </form>
      </div>

      <div id="tab-subscription" class="tab-content hidden mt-4">
        <p class="text-sm text-gray-600">Subscription details (demo).</p>
      </div>
    </section>
  </main>
  <script>
    (function(){
      const root = document.documentElement;
      const lightBtn = document.querySelector('.btn-light');
      const darkBtn = document.querySelector('.btn-dark');
      function setTheme(t){
        if(t==='dark'){ root.classList.add('dark'); if(darkBtn) darkBtn.classList.add('ring-2','ring-white'); if(lightBtn) lightBtn.classList.remove('ring-2'); }
        else{ root.classList.remove('dark'); if(lightBtn) lightBtn.classList.add('ring-2','ring-gray-300'); if(darkBtn) darkBtn.classList.remove('ring-2','ring-white'); }
        try{ localStorage.setItem('theme', t); }catch(e){}
      }
      const saved = (function(){ try{return localStorage.getItem('theme')}catch(e){return null;} })() || (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
      if(lightBtn && darkBtn) setTheme(saved);
      lightBtn && lightBtn.addEventListener('click', ()=> setTheme('light'));
      darkBtn && darkBtn.addEventListener('click', ()=> setTheme('dark'));

      // Sidebar tab switching
      const tabs = document.querySelectorAll('aside nav a');
      tabs.forEach((a,i)=>{
        a.addEventListener('click', (e)=>{
          e.preventDefault();
          tabs.forEach(x=> x.classList.remove('bg-gray-100','font-semibold'));
          a.classList.add('bg-gray-100','font-semibold');
          document.querySelectorAll('.tab-content').forEach(c=> c.classList.add('hidden'));
          const target = document.getElementById('tab-'+(a.dataset.tab||''));
          if(target) target.classList.remove('hidden');
        });
      });
      // activate theme tab by default
      const defaultTab = document.querySelector('aside nav a[data-tab="theme"]');
      if(defaultTab) defaultTab.click();

      // form submit demo
      const form = document.getElementById('settings-form');
      form && form.addEventListener('submit', function(e){
        e.preventDefault();
        const btn = this.querySelector('.save-btn');
        btn.disabled = true; btn.textContent='SAVING...';
        setTimeout(()=>{ btn.disabled=false; btn.textContent='SAVE CHANGES';
          btn.classList.add('bg-green-600');
          setTimeout(()=> btn.classList.remove('bg-green-600'),1200);
          alert('Settings saved (demo)');
        },700);
      });
    })();
  </script>
</body>
</html>
