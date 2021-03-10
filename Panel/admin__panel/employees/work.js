$(document).ready(function () {
  var x = false;
  $(".main div").hide();
  $(".slidebar li:first").attr("id", "active");
  $(".main div:first").fadeIn();
  $('.slidebar a').click(function (e) {
    e.preventDefault();
    if ($(this).closest("li").attr("id") == "active") {
      return
    } else {
      $(".main div").hide();
      $(".slidebar li").attr("id", "");
      $(this).parent().attr("id", "active");
      $('#' + $(this).attr('name')).fadeIn();
    }
  });
  $("#mycollapse").click(function (event) {
    event.preventDefault();
    if (!x) {
      $('#navbar').css('display', 'none');
      $('#main-doc').css('margin-left', '0');
      $('#main-doc').css('width', '100%');
      x = true;
    }
    else {
      $('#navbar').css('display', 'flex');
      $('#main-doc').css('margin-left', '21%');
      $('#main-doc').css('width', '79%');
      x = false;
    }
  });

  $("#select-Clerk").click(function (e) {
    e.preventDefault();
    current_id = $('#select-Clerk-id').val();
    $.ajax({
      url: "get_clerk.php",
      type: "POST",
      data: {
        id: current_id
      },
      success: function (d) {
        data = JSON.parse(d);
        $('#Clerk-fname').val(data['first_name']);
        $('#Clerk-lname').val(data['last_name']);
        $('#Clerk-email').val(data['email']);
        $('#Clerk-tel').val(data['phone_number']);
        $('#Clerk-manager  option[value="' + data['direct_manager_id'] + '"]').prop('selected', true);

      },
      error: function (xhr, status, error) {
        console.log(error);
      },
    });
  });

  $("#select-mang").click(function (e) {
    e.preventDefault();
    current_id = $('#select-mang-id').val();
    $.ajax({
      url: "get_mang.php",
      type: "POST",
      data: {
        id: current_id
      },
      success: function (d) {
        data = JSON.parse(d);
        $('#mang-fname').val(data['first_name']);
        $('#mang-lname').val(data['last_name']);
        $('#mang-email').val(data['email']);
        $('#mang-tel').val(data['phone_number']);
      },
      error: function (xhr, status, error) {
        console.log(error);
      },
    });
  });


  $("#select-Cord").click(function (e) {
    e.preventDefault();
    current_id = $('#select-Cord-id').val();
    $.ajax({
      url: "get_Cord.php",
      type: "POST",
      data: {
        id: current_id
      },
      success: function (d) {
        data = JSON.parse(d);
        $('#Cord-fname').val(data['first_name']);
        $('#Cord-lname').val(data['last_name']);
        $('#Cord-email').val(data['email']);
        $('#Cord-tel').val(data['phone_number']);
      },
      error: function (xhr, status, error) {
        console.log(error);
      },
    });
  });

  $("#delete_Cord").click(function (e) {
    e.preventDefault();
    current_id = $('#select-Cord-id').val();
    $.ajax({
      url: "deletes.php",
      type: "POST",
      data: {
        cord: current_id
      },
      success: function (d) {
        location.reload();
      },
      error: function (xhr, status, error) {
        console.log(error);
      },
    });
  });

  $("#delete_manager").click(function (e) {
    e.preventDefault();
    current_id = $('#select-mang-id').val();
    $.ajax({
      url: "deletes.php",
      type: "POST",
      data: {
        manager: current_id
      },
      success: function (d) {
        location.reload();
      },
      error: function (xhr, status, error) {
        console.log(error);
      },
    });
  });

  $("#delete_clerk").click(function (e) {
    e.preventDefault();
    current_id = $('#select-Clerk-id').val();
    $.ajax({
      url: "deletes.php",
      type: "POST",
      data: {
        clerk: current_id
      },
      success: function (d) {
        location.reload();
      },
      error: function (xhr, status, error) {
        console.log(error);
      },
    });
  });
});