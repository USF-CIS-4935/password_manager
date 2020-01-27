@include('templates/head-tag', ['title' => 'Check for Password Re-Use'])

<body>
  @include('templates/left-nav')
  <div class="container">
    <p class="header-text">Check for Password Re-Use</p>
    <p class="subtitle">In the case that any of your passwors have been included in known data breaches, you can make use of <br>
      the "Have I Been Pwned" API to search for either a specific password or to search for all of your saved passwords (although this will take time)</p>
      <div class="center-wrapper">
        <div class="top-search">
          <i class="fas fa-search icon"></i>
          <input id="reuse-search" class="text-search" type="text" placeholder="Search for a specific password">
          <button class="button" style="font-size: 20px; padding: 12px;"><i class="fas fa-list"></i> Check All of My Passwords</button>
        </div>
      </div>
    </div>
    <!-- <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous">
  </script> -->
</body>
