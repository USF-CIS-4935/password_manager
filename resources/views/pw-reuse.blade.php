@include('templates/head-tag', ['title' => 'Check for Password Re-Use'])

<body>
  @include('templates/left-nav')
  <div class="container">
    <p class="header-text">Check for Password Re-Use</p>
    <p class="subtitle">In the case that any of your passwors have been included in known data breaches, you can make use of <br>
      the "Have I Been Pwned" API to search for either a specific password or to search for all of your saved passwords (although this will take time)</p>
      <div class="center-wrapper">
        <div class="top-search">
          <input id="reuse-search" class="text-search" type="text" style="margin-right: 0px; float: left;" placeholder="Search for a specific password">
          <div id="TextEntrySearch" class="search-button">
            <i id="TextEntrySearch" class="fas fa-search"></i>
          </div>
          <p id="onesearchresult">Nothing Searched Yet</p>
          <button class="green-button" id="AllPasswordSearch" style="margin-top: 20px; height: 40px;"><i class="fas fa-list"></i> Check All of My Passwords</button>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="js/app_functions.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js" integrity="sha256-/H4YS+7aYb9kJ5OKhFYPUjSJdrtV6AeyJOtTkw6X72o=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/sha1.js"></script>
    <script type="text/javascript">
    function getAllUserPasswords(){
      return $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{ route('get-all-user-passwords') }}",
        method: "GET",
      })
    }

    function getHIBPResult(first_sha_five){
      return $.ajax({
        url: "https://api.pwnedpasswords.com/range/" + first_sha_five,
        method: "GET",
      })
    }

    $("#TextEntrySearch").click(function(){
      var searchterm = $("#reuse-search"). val()
      var shasearchterm = CryptoJS.SHA1(searchterm);
      var shasearch5 =  shasearchterm.toString().substring(0,5);
      var shasearchlast = shasearchterm.toString().substring(5,35);
      var hibpweb="https://api.pwnedpasswords.com/range/";
      var fullhibpweb=hibpweb.concat(shasearch5);
      function HIBPDATAFILL(data) {
        var hibpdata=data;
        var indata = hibpdata.toString().toLowerCase().indexOf(shasearchlast);
        if (indata >= 0) {
          alert("WARNING: YOUR PASSWORD HAS BEEN COMPROMISED");
          $("#onesearchresult").text("Your Password has been compromised in the past.  Choose another password");
        }
        else {
          $("#onesearchresult").text("This password has not been compromised in the past");
        };
      };
      $.get(fullhibpweb,HIBPDATAFILL);
    });

    $("#AllPasswordSearch").click(function(){
      var plaintext = [];
      var password_names = []
      var compromised_passwords = [];

      getAllUserPasswords().then(function(json_response) {
        $.each(json_response, function( key, password_object) {
          password_names.push(password_object.password_name);
          plaintext.push(CryptoJS.AES.decrypt(password_object.encrypted_pass, sessionStorage.derivedEncyptionKey).toString(CryptoJS.enc.Utf8).replace(password_object.salt_string,''));
        });

        for (var i = 0; i < plaintext.length; i++) {
          shasearchterm = CryptoJS.SHA1(plaintext[i]);
          shasearch5 =  shasearchterm.toString().substring(0,5);
          shasearchlast = shasearchterm.toString().substring(5,35);
          var current_pass = password_names[i];

          getHIBPResult(shasearch5).then(function(data) {
            var strhibpdata = data.toString().toLowerCase();
            if (strhibpdata.indexOf(shasearchlast) >= 0){ //If end of the full hash exists in the API response
              console.log("Hash match found for: " + current_pass);
              compromised_passwords.push(password_names[i]); // We cannot access variable "i" from here
            }
            else{
              console.log("No match found for: " + current_pass);
            }
          });
        }
      });
    });
    </script>
</body>
