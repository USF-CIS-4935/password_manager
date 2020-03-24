@include('templates/head-tag', ['title' => 'Password Database'])

<body>
  @include('templates/left-nav')

  <div id="pw-edit-modal" class="modal">
      <div class="modal-content">
        <div class="modal-container">
          <span class="modal-close-btn">×</span>
          <p class="header-text" style="margin-top: 0px; font-size: 30px;">Edit A Password</p>

          <div id="success-display" class="top-search" style="margin: 0 auto; width: 55%;display: none;">
            <div class="error-display-icon" style="background-color: #4caf50;">
              <i class="fas fa-check"></i>
            </div>
            <div class="error-display-box" type="text" style="float: left;">
              <span></span>
            </div>
          </div>

          <div id="error-display" class="top-search" style="margin: 0 auto; width: 55%;display: none;">
            <div class="error-display-icon">
              <i class="fas fa-exclamation"></i>
            </div>
            <div class="error-display-box" type="text" style="float: left;">
              <span></span>
            </div>
          </div>

          <div class="modal-input" style="width: 47%;">
            <label for="password_name">Name/Title:</label><br>
            <input id="password_name" type="text">
          </div>
          <div class="modal-input" style="width: 47%; margin-left: 5%;">
            <label for="saved_password">Password:</label><br>
            <input id="saved_password" type="text">
          </div>
          <div class="modal-input" style="width: 100%;">
            <label for="notes">Additional Notes:</label><br>
            <textarea id="notes"></textarea>
          </div>

          <div class="modal-footer-buttons" style="display: block; margin-top: 15px;">
            <button class="green-button" id="save-password"><i class="fas fa-save"></i> Save</button>
            <div class="right-buttons" style="float: right;">
              <button class="green-button" id="save-password"><i class="fas fa-save"></i> Save</button>
              <button class="green-button" id="delete-password"><i class="fas fa-trash"></i> Delete</button>
            </div>
          </div>
        </div>
      </div>
    </div>

  <div class="container">
    <p class="header-text">Password Database</p>
    <div class="top-search" style="display: inline-block;">
      <input id="db-search" class="text-search" type="text" style="float: left;" placeholder="Search by password name">
      <div id="db-search-submit" class="search-button">
        <i class="fas fa-search"></i>
      </div>
    </div>
    <div id="password-panels">
      <div class="pw-panel no-select" data-pwname="password1" data-pid="1">
        <div class="date-field">
          <span class="day-counter">14&nbsp;</span>days
        </div>
        <div class="panel-right">
          <h3 class="panel-title">Password1</h3>
          <p class="subtitle">Username Here</p>
          <p class="subtitle">Password expires in: 10 days</p>
        </div>
        <p class="panel-links"><i class="fas fa-copy copy-button"></i></p>
      </div>
      <div class="pw-panel no-select" data-pwname="password2" data-pid="2">
        <div class="date-field">
          <span class="day-counter">14&nbsp;</span>days
        </div>
        <div class="panel-right">
          <h3 class="panel-title">Password2</h3>
          <p class="subtitle">Username Here</p>
          <p class="subtitle">Password expires in: 10 days</p>
        </div>
        <p class="panel-links"><i class="fas fa-copy copy-button"></i></p>
      </div>
      <div class="pw-panel no-select" data-pwname="password3" data-pid="3">
        <div class="date-field">
          <span class="day-counter">14&nbsp;</span>days
        </div>
        <div class="panel-right">
          <h3 class="panel-title">Password3</h3>
          <p class="subtitle">Username Here</p>
          <p class="subtitle">Password expires in: 10 days</p>
        </div>
        <p class="panel-links"><i class="fas fa-copy copy-button"></i></p>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script type="text/javascript">
  function search_filter(){
    var searchTerm = $('#db-search').val();
    $(".pw-panel").each(function(index) { //Iterate every password panel
      if ($(this).data('pwname').indexOf(searchTerm.toLowerCase()) >= 0){ //Case-insenitive check for the search term within the 'pwname' data field
        $(this).fadeIn(200);
      }
      else{
        $(this).fadeOut(200);
      }
    });
  }

  $('#db-search-submit').click(function() {
    search_filter();
  });

  $('#db-search').keypress(function (e) {
    if (e.which == 13) { //'Enter'
      search_filter();
    }
  });

  function populateModal(data){
    $('#password_name').val(data.password_name),
    $('#saved_password').val(data.encrypted_pass),
    $('#notes').val(data.notes),

    $("#pw-edit-modal").show();
  }

  function getPassword(passID){
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ route('get-password') }}" + "/" + passID,
      method: "GET",
    })
    .done(function(data){
      console.log(data);
      populateModal(data);
    })
    .fail(function(data){
      return false;
    })
  }

  function postPasswordUpdate(){
    $('#save-password').prop("disabled", true);
    var pageData = {
      password_name : $('#password_name').val(),
      saved_password : $('#saved_password').val(),
      notes : $('#notes').val(),
    };
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ route('update-password') }}",
      method: "POST",
      data: pageData
    })
    .done(function(data){
      $("#success-display .error-display-box span").text("Account options updated successfully");
      $("#success-display").show().delay( 5000 );
      $("#success-display").fadeOut();
    })
    .fail(function(data){
      if (data.status = 422){
        $.each(data.responseJSON.errors, function(index, value){
          $("#error-display .error-display-box span").append('<strong>' + index + '</strong>: ' + value + '<br>');
        });
        $("#error-display").show().delay( 10000 );
      }
      else{
        $("#error-display .error-display-box span").text("An error occurred while updating account settings. Try again in a few minutes");
        $("#error-display").show().delay( 5000 );
      }
      $("#error-display").fadeOut();
    })
    .always(function(data){
      $('#save-password').prop("disabled", false);
    })
  }

  $('#save-password').click(function(){
    postPasswordUpdate();
  });

  $('.pw-panel').click(function() {
    getPassword( $(this).data('pid') );
  });

  $('.modal-close-btn').click(function() {
    $(this).closest(".modal").hide();
  });
  </script>
</body>
