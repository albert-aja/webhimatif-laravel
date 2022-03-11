<script src="{{ asset('vendor/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/jquery.transit.min.js') }}"></script>
<script src="{{ asset('vendor/popper.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

<script>
    function password_show_hide() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    
    function pass_confirm_show_hide() {
        var x = document.getElementById("pass_confirm");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>