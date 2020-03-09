@include('templates/head-tag', ['title' => 'BullPass - Login'])

<body style="background-image: url('images/funky-lines.png');">
  <div class="login-card">
    <p class="header-text" style="text-align: center; margin-top: 0px;">Login</p>
    <form method="POST" action="{{ route('login') }}" style="margin: 0px;">
      @csrf

      @if ($errors->any())
        <div>
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

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
        <a class="login-subtext subtitle" href="{{ route('acc-options') }}">Forgot Your Password?</a>
        <a class="login-subtext subtitle" href="{{ route('register') }}">Don't Already Have an Account?</a>
      </div>
    </form>
  </div>
</body>
