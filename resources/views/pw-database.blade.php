@include('templates/head-tag', ['title' => 'Password Database'])

<body>
  @include('templates/left-nav')

  <div id="pw-edit-modal" class="modal">
      <div class="modal-content">
        <div class="modal-container">
          <span class="modal-close-btn">×</span>
          <p class="header-text" style="margin-top: 0px; font-size: 30px;">Header</p>
          <p>Some text. Some text. Some text.</p>
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
      <div class="pw-panel" data-pwname="password1">
        <div class="date-field">
          <span class="day-counter">14&nbsp;</span>days
        </div>
        <div class="panel-right">
          <h3 class="panel-title">Password1</h3>
          <p class="subtitle">Username Here</p>
          <p class="subtitle">Password expires in: 10 days</p>
        </div>
        <p class="panel-links"><i class="fas fa-copy"></i></p>
      </div>
      <div class="pw-panel" data-pwname="password2">
        <div class="date-field">
          <span class="day-counter">14&nbsp;</span>days
        </div>
        <div class="panel-right">
          <h3 class="panel-title">Password2</h3>
          <p class="subtitle">Username Here</p>
          <p class="subtitle">Password expires in: 10 days</p>
        </div>
        <p class="panel-links"><i class="fas fa-copy"></i></p>
      </div>
      <div class="pw-panel" data-pwname="password3">
        <div class="date-field">
          <span class="day-counter">14&nbsp;</span>days
        </div>
        <div class="panel-right">
          <h3 class="panel-title">Password3</h3>
          <p class="subtitle">Username Here</p>
          <p class="subtitle">Password expires in: 10 days</p>
        </div>
        <p class="panel-links"><i class="fas fa-copy"></i></p>
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

  $('.pw-panel').click(function() {
    $("#pw-edit-modal").show();
  });
  $('.modal-close-btn').click(function() {
    $(this).closest(".modal").hide();
  });
  </script>
</body>
