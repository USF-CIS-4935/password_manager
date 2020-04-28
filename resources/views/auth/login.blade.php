@include('templates/head-tag', ['title' => 'BullPass - Login'])

<body style="background-image: url('images/funky-lines.png');">

  @include('templates/status-notifications')

  <div class="login-card">
    <p class="header-text" style="text-align: center; margin-top: 0px;">Login</p>
    <form id="login-form" method="POST" action="{{ route('login') }}" style="margin: 0px;">
      @csrf

      <label>Email Address</label><br>
      <input id="email" type="email" maxlength="255" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
      @if ($errors->has('email'))
      <span class="invalid-feedback">
        <strong>{{ $errors->first('email') }}</strong>
      </span>
      @endif

      <br>

      <label>Password</label><br>
      <input id="password" type="password" maxlength="255" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
      @if ($errors->has('password'))
      <span class="invalid-feedback">
        <strong>{{ $errors->first('password') }}</strong>
      </span>
      @endif

      <br>

      <div class="center-wrapper">
        <button id="login-button" type="submit" class="login-button">Login</button>
      </div>

      <div class="center-wrapper" style="margin: 10px 0px 10px 0px;">
        <a class="login-subtext subtitle" href="{{ route('register') }}">Don't Already Have an Account?</a>
      </div>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="{{ url('js/app_functions.js') }}"></script>
  <script src="{{ url('js/sha256.js') }}"></script>
  <script type="text/javascript">

  function storeDerivedKey() {
    if (typeof(Storage) !== "undefined") {
      sessionStorage.derivedEncyptionKey = CryptoJS.SHA256( $("#password").val() );
    }
    else {
      displayNotification("error", "Sorry, your browser does not support web storage. This application will not be compatible.");
    }
  }

  $("#login-form").submit(function(event) {
    var verify = verifyPasswordReqs( $("#password").val() );
    if (verify !== true){
      event.preventDefault();
      displayNotification("error", verify);
      $("#password").addClass('is-invalid');
    }
    else{
      storeDerivedKey();
    }
  });
  </script>
</body>
