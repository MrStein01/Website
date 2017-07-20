<script>
  $(".closeSU").click(function() {
    document.getElementById("user").value = '<?php echo $_SESSION['SU'] ?>';
    document.getElementById("SUEnd").submit();
  });
</script>
<form action="<?PHP echo $_SERVER[REQUEST_URI]; ?>" id="SUEnd" method="post">
  <input type="hidden" name="SU" value="<?PHP echo $_SESSION['SU'] ?>" />
  <input type="hidden" id="user" name="user" value="<?PHP echo $_SESSION['SU'] ?>" />
</form>
