@include('templates/head-tag', ['title' => 'BullPass - Login'])

<body style="background-image: url('images/funky-lines.png');">
  <div class="login-card">
    <p class="header-text" style="text-align: center; margin-top: 0px;">Login</p>
    <form method="POST" action="{{ route('login') }}" style="margin: 0px;">
      @csrf

      <label>Email Address</label><br>
      <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
      @if ($errors->has('password'))
      <span class="invalid-feedback">
        <strong>{{ $errors->first('password') }}</strong>
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

      <div class="">
        <label>
          <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
        </label>
      </div>

      <br>

      <div class="center-wrapper">
        <button type="submit" class="login-button">Login</button>
      </div>

      <div class="center-wrapper" style="margin: 10px 0px 10px 0px;">
        <a class="pw-forgot subtitle" href="{{ route('acc-options')">Forgot Your Password?</a>
      </div>
    </form>
  </div>
</body>
