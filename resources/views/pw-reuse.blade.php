@include('templates/head-tag', ['title' => 'Check for Password Re-Use'])

<body>
  @include('templates/left-nav')
  @include('templates/status-notifications')

  <div class="container">
    <p class="header-text">Check for Password Re-Use</p>
    <p class="subtitle">In the case that any of your passwors have been included in known data breaches, you can make use of <br>
      the "Have I Been Pwned" API to search for either a specific password or to search for all of your saved passwords (although this will take time)</p>
      <div class="center-wrapper">
        <div class="top-search">
          <input id="reuse-search" class="text-search" type="text" style="margin-right: 0px; float: left;" maxlength="100" placeholder="Search for a specific password">
          <div id="text-search-submit" class="search-button">
            <i class="fas fa-search"></i>
          </div>

          <button class="green-button" id="search-all-passwords" style="margin-top: 20px; height: 40px;"><i class="fas fa-list"></i> Check All of My Passwords</button>
        </div>
        <div id="check_all_results" style="width: 50%; margin: 0 auto;"></div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="js/app_functions.js"></script>
    <script src="{{ url('js/aes.js') }}"></script>
    <script src="{{ url('js/sha1.js') }}"></script>
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

    $('#reuse-search').keypress(function (e) {
      if (e.which == 13) { //'Enter'
        $("#text-search-submit").click();
      }
    });

    $("#text-search-submit").click(function(){
      var searchterm = $("#reuse-search").val()
      var shaSearchTerm = CryptoJS.SHA1(searchterm);
      var shaSearchLast = shaSearchTerm.toString().substring(5,35);
      // API request URL with first 5 characters of the SHA hash
      var api_url = "https://api.pwnedpasswords.com/range/" + shaSearchTerm.toString().substring(0,5);
      function HIBPDataFill(hibpdata) {

        //If the full hash exists in the returned result
        if (hibpdata.toString().toLowerCase().indexOf(shaSearchLast) >= 0) {
          displayNotification("error", "Password \"" + searchterm + "\" has been compromised in the past and should not be used", 5000);
        }
        else {
          displayNotification("success", "Password \"" + searchterm + "\" has not been compromised in the past", 5000);
        };
      };
      $.get(api_url, HIBPDataFill);
    });

    $("#search-all-passwords").click(function(){
      $("#search-all-passwords").prop("disabled", true);
      var plaintext = [];
      var password_names = []
      var compromised_passwords = [];

      getAllUserPasswords().then(function(json_response) {
        $.each(json_response, function( key, password_object) {
          password_names.push(password_object.password_name);
          plaintext.push(CryptoJS.AES.decrypt(password_object.encrypted_pass, sessionStorage.derivedEncyptionKey).toString(CryptoJS.enc.Utf8).replace(password_object.salt_string,''));
        });

        async function process_array(){
          const passwords_plain = plaintext;
          for (const plain of passwords_plain){
            shaSearchTerm = CryptoJS.SHA1(plain);
            shaSearchLast = shaSearchTerm.toString().substring(5,35);
            // API request URL with first 5 characters of the SHA hash
            api_url = "https://api.pwnedpasswords.com/range/" + shaSearchTerm.toString().substring(0,5)
            const contents = await $.get(api_url,data_fill)
          }
          html = "<table class=\"login-record-table\"><th>Compromised Passwords</th><tr>";

          if (compromised_passwords.length > 0){
            for (var i = 0; i < compromised_passwords.length; i++) {
              html += "<td>" + compromised_passwords[i] + "</td>";

              if (i != compromised_passwords.length - 1) { //If this is not the last entry
                html += "</tr><tr>";
              }
            }
            displayNotification("error", "Some of your passwords have been compromised in the past and should not be used", 5000);
            html += "</tr></table>"; //Close out the table
          }
          else {
            html += "<td>Congratulations! None of your passwords have been found in the HIBP Database!</td>";
            displayNotification("error", "Congratulations! None of your passwords have been found in the HIBP Database", 5000);
          }

          $("#check_all_results").html(html);
        }

        compromised_passwords=[]
        function data_fill(data){
          dataFill = data.toString().toLowerCase();
          console.log(compromised_passwords);

          if (dataFill.indexOf(shaSearchLast) >= 0){ //If last part of the SHA hash exists in 'dataFill'
            compromised_passwords[compromised_passwords.length] = password_names[0];
            if (password_names.length > 1){
              password_names=password_names.slice(1);
            }
          }
        }

        process_array();
        $("#search-all-passwords").prop("disabled", false);
      });
    });
    </script>
</body>
