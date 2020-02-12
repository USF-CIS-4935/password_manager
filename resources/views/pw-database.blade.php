@include('templates/head-tag', ['title' => 'Password Database'])

<body>
  @include('templates/left-nav')
  <div class="container">
    <p class="header-text">Password Database</p>
    <div class="top-search" style="display: inline-block;">
      <input id="db-search" class="text-search" type="text" style="margin-right: 0px; float: left;" placeholder="Search by password name">
      <div class="search-button">
        <i class="fas fa-search"></i>
      </div>
    </div>
    <div class="password-panels">
      <div class="pw-panel">
        <div class="date-field">
          <span class="day-counter">14 </span>days
        </div>
        <div class="panel-right">
          <h3 class="panel-title">Password Name</h3>
          <p class="subtitle">Username Here</p>
          <p class="subtitle">Password expires in: 10 days</p>
        </div>
        <p class="panel-links"><i class="fas fa-copy"></i></p>
      </div>
      <div class="pw-panel">
        <div class="date-field">
          <span class="day-counter">14 </span>days
        </div>
        <div class="panel-right">
          <h3 class="panel-title">Password Name</h3>
          <p class="subtitle">Username Here</p>
          <p class="subtitle">Password expires in: 10 days</p>
        </div>
        <p class="panel-links"><i class="fas fa-copy"></i></p>
      </div>
      <div class="pw-panel">
        <div class="date-field">
          <span class="day-counter">14 </span>days
        </div>
        <div class="panel-right">
          <h3 class="panel-title">Password Name</h3>
          <p class="subtitle">Username Here</p>
          <p class="subtitle">Password expires in: 10 days</p>
        </div>
        <p class="panel-links"><i class="fas fa-copy"></i></p>
      </div>
    </div>
  </div>
  <!-- <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous">
</script> -->
</body>
