function old_password_show_hide() {
  var x = document.getElementById("old_pass");

  if (x.type === "password") {
    x.type = "text";
    $("#old-pass-eye").removeClass("fa-eye").addClass("fa-eye-slash");
  } else {
    x.type = "password";
    $("#old-pass-eye").removeClass("fa-eye-slash").addClass("fa-eye");
  }
}

function password_show_hide() {
  var x = document.getElementById("new_pass");

  if (x.type === "password") {
    x.type = "text";
    $("#new-pass-eye").removeClass("fa-eye").addClass("fa-eye-slash");
  } else {
    x.type = "password";
    $("#new-pass-eye").removeClass("fa-eye-slash").addClass("fa-eye");
  }
}

function pass_confirm_show_hide() {
  var x = document.getElementById("confirm_pass");

  if (x.type === "password") {
    x.type = "text";
    $("#com-pass-eye").removeClass("fa-eye").addClass("fa-eye-slash");
  } else {
    x.type = "password";
    $("#com-pass-eye").removeClass("fa-eye-slash").addClass("fa-eye");
  }
}

$("#toggleOldPassword").click(function (e) {
  e.preventDefault();
  old_password_show_hide();
});

$("#togglePassword").click(function (e) {
  e.preventDefault();
  password_show_hide();
});

$("#toggleConfirmPassword").click(function (e) {
  e.preventDefault();
  pass_confirm_show_hide();
});
