@include('templates/head-tag', ['title' => 'Account Options'])

<body>
  <input type="hidden" id="_token" value="{{ csrf_token() }}">
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

      <input type="checkbox" id="password_age_notification">
      <label for="password_age_notification">Notifications for Password Age Expirations</label><br>

      <input type="checkbox" id="failure_lockout_timer">
      <label for="failure_lockout_timer">Enable Lockout Timer After Failed Login Attempts</label><br>

      <input type="checkbox" id="">
      <label for="">Option 2</label><br>
    </fieldset>

    <div class="generator-fields" style="margin-bottom: 20px;">
      <button class="button" id="save-account-options"><i class="fas fa-save"></i> Save Account Options</button>
    </div>


  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script type="text/javascript">
  function postSettingsUpdate(){
    var pageData = {
      password_age_notification : $('#password_age_notification').is(':checked') ? 1 : 0,
      failure_lockout_timer : $('#failure_lockout_timer').is(':checked') ? 1 : 0
    };
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ route('update-account-options') }}",
      method: "POST",
      data: pageData
    })
    .done(function(data){
      console.log(pageData);
      console.log(data);
    })
    .fail(function(data){
      alert("error");
      console.log(data);
    })
  }

  $('#save-account-options').click(function(){
    postSettingsUpdate();
  });
  </script>
</body>
