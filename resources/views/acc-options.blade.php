@include('templates/head-tag', ['title' => 'Account Options'])

<body>
  @include('templates/left-nav')
  <div class="container">
    <p class="header-text">Account Options</p>

    <fieldset class="generator-fields">
      <legend>E-mail Address</legend>
      <label>E-mail Address</label><br>
      <input class="text-search-small" type="text">
    </fieldset>

    <fieldset class="generator-fields">
      <legend>Password Settings</legend>

      <label>Current Password</label><br>
      <input class="text-search-small" type="text">

      <hr>

      <label>New Password</label><br>
      <input class="text-search-small" type="text">
      <label>Repeat New Password</label><br>
      <input class="text-search-small" type="text">
    </fieldset>

    <fieldset class="generator-fields">
      <legend>Account Settings</legend>

      <input type="checkbox">
      <label for="age_notif">Notifications for Password Age Expirations</label><br>

      <input type="checkbox">
      <label for="">Option 1</label><br>

      <input type="checkbox">
      <label for="">Option 2</label><br>
    </fieldset>

    <div class="generator-fields" style="margin-bottom: 20px;">
      <button class="button"><i class="fas fa-save"></i> Save Account Options</button>
    </div>


  </div>
  <!-- <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous">
</script> -->
</body>
