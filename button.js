function edit(ID) {
  $("body").append(
    "<div id='edit_box' style='z-index:999;position:absolute;top:40%;left:30%;background-color:white;width:600px;height:500px;'></div>"
  );
  $("#edit_box").append(
    "<form id='edit_form' action='edit.php' method='post'></form>"
  );
  $("#edit_form").append("<input type='hidden' name='ID' value='" + ID + "'/>");
  $("#edit_form").append(
    "<input type='submit' name='submit' value='OK' style='display: none;'/>"
  );
  $("#edit_form input[type='submit']").click();
}

function edit2(ID) {
  $("body").append(
    "<div id='edit_box' style='z-index:999;position:absolute;top:40%;left:30%;background-color:white;width:600px;height:500px;'></div>"
  );
  $("#edit_box").append(
    "<form id='edit_form' action='edit2.php' method='post'></form>"
  );
  $("#edit_form").append("<input type='hidden' name='ID' value='" + ID + "'/>");
  $("#edit_form").append(
    "<textarea name='text' placeholder='Enter text'></textarea>"
  );
  $("#edit_form").append("<input type='submit' name='submit' value='OK'/>");
}
