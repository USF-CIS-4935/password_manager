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
      <legend>Login History</legend>
      <table class="login-record-table">
        <tr>
          <th>Time</th>
          <th>IP Address</th>
          <th>User Agent</th>
        </tr>
        @if (Auth::user()->account_options->track_login_history != true)
        <tr class="login-history-msg">
          <td colspan="3">You currently have login history tracking disabled. You can enable it below.</td>
        </tr>
        @endif
        @if (Auth::user()->account_options->track_login_history == true && $last_logins->isEmpty())
        <tr class="login-history-msg">
          <td colspan="3">No login history yet. Subsequent logins will be recorded.</td>
        </tr>
        @endif
          @foreach($last_logins as $login)
            <tr class="login-history-row" @if (Auth::user()->account_options->track_login_history != true) hidden @endif>
              <td>{{ $login->created_at->format('m/d/y H:m:s') }}</td>
              <td>{{ $login->user_ip }}</td>
              <td>{{ $login->user_agent }}</td>
            </tr>
          @endforeach
      </table>
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
      <label for="password_age_notification">Alert to Expired Passwords on Database Page</label><br>

      <input type="checkbox" id="track_login_history" @if ($user->account_options->track_login_history) checked @endif>
      <label for="track_login_history">Track Login History</label><br>
    </fieldset>

    <div class="generator-fields" style="margin-bottom: 20px;">
      <button class="green-button" id="save-account-options"><i class="fas fa-save"></i> Save Settings</button>
    </div>

  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="js/app_functions.js"></script>
  <script src="{{ url('js/aes.js') }}"></script>
  <script src="{{ url('js/sha256.js') }}"></script>
  <script type="text/javascript">
  function postSettingsUpdate(){
    $('#save-account-options').prop("disabled", true);
    var pageData = {
      password_age_notification : $('#password_age_notification').is(':checked') ? 1 : 0,
      track_login_history : $('#track_login_history').is(':checked') ? 1 : 0,
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
      if ( $("#new_password").val().length > 0 ){
        massPasswordUpdate();
      }
      displayNotification("success", "Account options updated successfully", 5000);
      if (data.track_login_history == true){
        $(".login-history-row").show();
        $(".login-history-msg").hide();
      }
      else{
        $(".login-history-row").hide();
        $(".login-history-msg").show();
      }
    })
    .fail(function(data){
      if (data.status == 422){
        displayNotification("error", data.responseJSON.errors, 10000);
      }
      else{
        displayNotification("error", "An error occurred while updating account settings.", 5000);
      }
    })
    .always(function(data){
      $('#save-account-options').prop("disabled", false);
    })
  }

  function getAllUserPasswords(){
    return $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ route('get-all-user-passwords') }}",
      method: "GET",
    })
  }

  function massPasswordUpdate(){
    $.when(getAllUserPasswords()).done(function(data){
      var newDerivedKey = CryptoJS.SHA256( $("#new_password").val() );
      var newEncPairs = {};
      $.each(data, function(key, password_object) {
        var plaintext = CryptoJS.AES.decrypt(password_object.encrypted_pass, sessionStorage.derivedEncyptionKey).toString(CryptoJS.enc.Utf8).replace(password_object.salt_string,'');
        var new_enc = CryptoJS.AES.encrypt(plaintext + password_object.salt_string, newDerivedKey.toString()).toString();
        newEncPairs[password_object.id] = new_enc;
      })
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{ route('mass-update-passwords') }}",
        method: "POST",
        data: newEncPairs
      })
      .done(function(data){
        sessionStorage.derivedEncyptionKey = newDerivedKey.toString();
      })
    });
  }

  $('#save-account-options').click(function(){
    postSettingsUpdate();
  });
  </script>
</body>
