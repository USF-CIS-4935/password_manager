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
    <script src-
    <script type="text/javascript">
    $(document).ready(function(){
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
        var plaintext=[];
        var password_names=[]
        var encrypted_passwords=[];
        var password_salt=[];
        var compromised_passwords=[];
        var i=0
        var hibpdata
        var strhipbdata='place'
        x=0 
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ route('get-all-user-passwords') }}",
          method: "GET"
          })
          .done(function(json_response){
            $.each(json_response, function( key, password_object) {
              password_salt[password_salt.length]=password_object.salt_string;
              password_names[password_names.length]=password_object.password_name;
              plaintext[plaintext.length] = CryptoJS.AES.decrypt(password_object.encrypted_pass, sessionStorage.derivedEncyptionKey).toString(CryptoJS.enc.Utf8).replace(password_object.salt_string,'');
            });
            
          for (i=0; i < plaintext.length; i++) {
            console.log(plaintext[i])
             
            shasearchterm = CryptoJS.SHA1(plaintext[i]);
            console.log(shasearchterm)
            shasearch5 =  shasearchterm.toString().substring(0,5);
            console.log(shasearch5)
            shasearchlast = shasearchterm.toString().substring(5,35);
            console.log(shasearchlast)
            hibpweb="https://api.pwnedpasswords.com/range/";
            fullhibpweb=hibpweb.concat(shasearch5);
             
                        
             //$.get(fullhibpweb,HIBPDATAFILL);
             $.get(fullhibpweb,function() {

             })
              .done(function(data){
                strhibpdata = data.toString().toLowerCase()
                console.log(strhibpdata)
                indata =strhipbdata.indexOf(shasearchlast)
                console.log(shasearchlast, "<---------------")
                console.log(indata)
                if (indata >= 0){
                  compromised_passwords[compromised.length]=password_names[i]
                }
              //do blah
              })
              console.log(compromised_passwords)              



             

             
            }
          
          
    
          })
          .fail(function(json_response){
            // do this if it fails
          });
          
        
       
        
          console.log(compromised_passwords) 
      });      
      
    });

    </script>
</body>
