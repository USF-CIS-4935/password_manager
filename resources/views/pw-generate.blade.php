@include('templates/head-tag', ['title' => 'Password Generator'])

<body>
  @include('templates/left-nav')
  <div class="container">
    <p class="header-text">Password Generator</p>
    <form action="#" method="get" onsubmit="doGenerate(event);">

      <fieldset class="generator-fields">
        <legend>Complexity</legend>
        <div class="section">
          <table id="type">
            <tbody>
              <tr>
                <td><input type="radio" name="type" id="by-length" checked="checked"> <label for="by-length">Length:&#xA0;</label></td>
                <td><input type="number" min="0" value="10" step="1" id="length" style="width:4em" oninput="document.getElementById('by-length').checked=true;"> characters</td>
              </tr>
              <tr>
                <td><input type="radio" name="type" id="by-entropy"> <label for="by-entropy">Entropy:</label>&#xA0;</td>
                <td><input type="number" min="0" value="128" step="any" id="entropy" style="width:4em" oninput="document.getElementById('by-entropy').checked=true;"> bits</td>
              </tr>
            </tbody>
          </table>
        </div>
      </fieldset>

      <fieldset class="generator-fields">
        <legend>Character Selection</legend>
        <div id="charset" class="section" style="margin:0.8em 0em">
          <p style="margin:0.3em 0em">Character set:</p>
          <table style="line-height:1.5">
            <tbody>
              <tr>
                <td><input type="checkbox" id="custom"></td>
                <td><label for="custom"> Custom:</label> <input type="text" id="customchars" value="" size="15" style="width:10em; font-size:80%" oninput="document.getElementById('custom').checked=true;"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </fieldset>

      <div class="generator-fields">
        <button type="submit" class="green-button"><i class="fas fa-sync-alt"></i> Generate Password</button>
        <button class="green-button" type="button" id="copy-button" onclick="doCopy();" disabled="disabled"><i class="fas fa-copy"></i> Copy to Clipboard</button>
      </div>

      <div class="generator-fields">
        Password: <span id="password" style="background-color: #9e9e9e; padding: 2px 5px;"></span>
        <p id="statistics" class="lowlight">&#xA0;</p>
      </div>
    </form>

    <hr style="width: 50%;">

    <div style="text-align: center;">
      <p class="lowlight" style="max-width:unset">
        <span>Sourced from <a href="https://www.nayuki.io/page/random-password-generator-javascript">nayuki.io</a></span><br>
        Entropy sources:<br>
        <span>✓ <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/random"><code>Math.random()</code></a> (low security)</span><br>
        <span id="crypto-getrandomvalues-entropy"></span>
        <span><a href="https://developer.mozilla.org/en-US/docs/Web/API/RandomSource/getRandomValues"><code>crypto.getRandomValues()</code></a> (high security)</span>
      </p>
      </div>

    </div>
  </div>
  <script src="js/pass_generator_functions.js"></script>
</body>
<!-- Copyright (c) 2020 Project Nayuki - https://www.nayuki.io/page/random-password-generator-javascript -->
