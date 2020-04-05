@include('templates/head-tag', ['title' => 'Account Options'])

<body>
  <input type="hidden" id="_token" value="{{ csrf_token() }}">
  @include('templates/left-nav')
  @include('templates/status-notifications')

  <div class="container">
    <p class="header-text">Account Options</p>

    <fieldset class="generator-fields">
      <legend>E-mail Address</legend>
      <label>E-mail Address</label><br>
      <input class="text-search-small no-select" type="text" value="{{$user->email}}" disabled>
    </fieldset>

    <fieldset class="generator-fields">
      <legend>Password Settings</legend>

      <label>Current Password</label><br>
      <input class="text-search-small" id="current_password" name="current_password" type="password">

      <hr>

      <label>New Password</label><br>
      <input class="text-search-small" id="new_password" name="new_password" type="password">
      <label>Repeat New Password</label><br>
      <input class="text-search-small" id="new_password_confirmation" name="new_password_confirmation" type="password">
    </fieldset>

    <fieldset class="generator-fields">
      <legend>Account Settings</legend>

      <input type="checkbox" id="password_age_notification" @if ($user->account_options->password_age_notification) checked @endif>
      <label for="password_age_notification">Notifications for Password Age Expirations</label><br>

      <input type="checkbox" id="failure_lockout_timer" @if ($user->account_options->failure_lockout_timer) checked @endif>
      <label for="failure_lockout_timer">Enable Lockout Timer After Failed Login Attempts</label><br>

      <input type="checkbox" id="">
      <label for="">Option 2</label><br>
    </fieldset>

    <div class="generator-fields" style="margin-bottom: 20px;">
      <button class="green-button" id="save-account-options"><i class="fas fa-save"></i> Save Settings</button>
    </div>

  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="js/app_functions.js"></script>
  <script type="text/javascript">
  function postSettingsUpdate(){
    $('#save-account-options').prop("disabled", true);
    var pageData = {
      password_age_notification : $('#password_age_notification').is(':checked') ? 1 : 0,
      failure_lockout_timer : $('#failure_lockout_timer').is(':checked') ? 1 : 0,
      current_password : $('#current_password').val(),
      new_password : $('#new_password').val(),
      new_password_confirmation : $('#new_password_confirmation').val(),
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
      displayNotification("success", "Account options updated successfully", 5000);
    })
    .fail(function(data){
      if (data.status = 422){
        displayNotification("error", data.responseJSON.errors, 10000);
      }
      else{
        displayNotification("error", "An error occurred while updating account settings. Try again in a few minutes", 5000);
      }
    })
    .always(function(data){
      $('#save-account-options').prop("disabled", false);
    })
  }

  $('#save-account-options').click(function(){
    postSettingsUpdate();
  });
  </script>
</body>
