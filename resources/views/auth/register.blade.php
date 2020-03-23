@include('templates/head-tag', ['title' => 'BullPass - Register A New Account'])

<body style="background-image: url('images/funky-lines.png');">
  <div class="login-card">
    <p class="header-text" style="text-align: center; margin-top: 0px;">Register A New Account</p>
    <form id="register-form" method="POST" action="{{ route('register') }}" style="margin: 0px;">
      @csrf

      <div id="error-display" class="top-search" style="display: none;">
        <div class="error-display-icon">
          <i class="fas fa-search"></i>
        </div>
        <div id="error-display-box" class="error-display-box" type="text" style="float: left;">
          <span></span>
        </div>
      </div>

      <label>Email Address</label><br>
      <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
      @if ($errors->has('email'))
      <span class="invalid-feedback">
        <strong>{{ $errors->first('email') }}</strong>
      </span>
      @endif

      <br>

      <label>Password</label><br>
      <input id="password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
      @if ($errors->has('password'))
      <span class="invalid-feedback">
        <strong>{{ $errors->first('password') }}</strong>
      </span>
      @endif

      <br>

      <label>Confirm Password</label><br>
      <input id="password_confirmation" type="password" class="{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>
      @if ($errors->has('password_confirmation'))
      <span class="invalid-feedback">
        <strong>{{ $errors->first('password_confirmation') }}</strong>
      </span>
      @endif

      <br>

      <div class="center-wrapper">
        <button type="submit" class="login-button">Register</button>
      </div>

      <div class="center-wrapper" style="margin: 10px 0px 10px 0px;">
        <span class="subtitle">&nbsp;</span>
        <a class="login-subtext subtitle" href="{{ route('login') }}">Already Have an Account?</a>
      </div>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="js/app_functions.js"></script>
  <script type="text/javascript">
    $("#register-form").submit(function(event) {
      var verify = verifyPasswordReqs( $("#password").val() );
      console.log(verify);
      if (verify !== true){
        event.preventDefault();
        $("#error-display").show();
        $("#error-display-box span").text(verify);
        $("#password").addClass('is-invalid');
      }
    });
  </script>
</body>
