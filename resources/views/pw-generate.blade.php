@include('templates/head-tag', ['title' => 'Password Generator'])

<body>
  @include('templates/left-nav')
  <div class="container">
    <p class="header-text">Password Generator</p>
    <fieldset class="generator-fields">
      <legend>Password Characteristics</legend>

      <label>Password Length (up to 512 characters)</label><br>
      <input id="pw_length" type="number" min="1" max="512">
    </fieldset>

    <fieldset class="generator-fields">
      <legend>Character Selection</legend>

      <input type="checkbox">
      <label for="lowers">Lowercase Letters (abcdefghijklmnopqrstuvwxyz)</label><br>

      <input type="checkbox">
      <label for="uppers">Uppercase Letters (ABCDEFGHIJKLMNOPQRSTUVWXYZ)</label><br>

      <input type="checkbox">
      <label for="nums">Numerical Characters (1234567890)</label><br>

      <input type="checkbox">
      <label for="symbols">Symbols (!@#$%)</label>
    </fieldset>

    <fieldset class="generator-fields">
      <legend>Character Exclusions</legend>

      <label>Enter all characters you would like to exclude from your password in this field, without any kind of separation.</label><br>
      <input id="pw_exclusions" type="text">
    </fieldset>

    <fieldset class="generator-fields">
      <legend>Password Entropy</legend>
      <div class="progress-meter">
        <span style="width: 65%"></span>
      </div>
    </fieldset>

    <div class="generator-fields">
      <button class="button"><i class="fas fa-sync-alt"></i> Generate Password</button>
      <button class="button" style="float: right;"><i class="fas fa-copy"></i> Copy to Clipboard</button>
    </div>

    <div id="gen-result" class="generator-fields">
      <input class="text-search-small" type="text" placeholder="Your New Password Will Appear Here">
    </div>

    </div>
  </div>
  <!-- <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous">
</script> -->
</body>
