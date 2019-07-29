<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script
        src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js">
    </script>
    <script>
        $(document).ready(function () {
            $("form").submit(function (event) {
                event.preventDefault();
                var name    = $("mail-name").val();
                var email   = $("mail-email").val();
                var gender  = $("mail-gender").val();
                var message = $("mail-message").val();
                var submit  = $("mail-submit").val();
                $.post("index.php", {
                    name:    name,
                    email:   email,
                    gender:  gender,
                    message: message,
                    submit:  submit
                }, function (data) {
                    $("#form-message").text(data);
                    );
            });
        });
    </script>
</head>
<body style="text-align: center;">
    <form  method="post">
        <input id="mail-name" type="text" name="name" placeholder="Full name"><br>
        <input id="mail-email" type="text" name="email" placeholder="E-mail"><br>
        <select id="mail-gender" name="gender">
            <option value="male">male</option>
            <option value="female">female</option>
        </select><br>
        <textarea id="mail-message" name="message" placeholder="message"></textarea><br>
        <button id="mail-submit" type="submit" name="submit"> Send </button>
        <p id="form-message"></p>
    </form>
</body>
</html>
<?php
if (isset($_POST['submit'])){
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $gender  = $_POST['gender'];
    $message = $_POST['message'];
    $errorEmpty = false;
    $errorEmail = false;
    if (empty($name) || empty($email) || empty($message)){
        echo "<span>fill up the all</span>";
        $errorEmpty = true;
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<span>write an correct e-mail</span>";
        $errorEmail = true;
    }else{
        echo "ok";
    }
}
?>
<script>
    var errorEmpty = "<?php echo $errorEmpty; ?>";
    var errorEmail = "<?php echo $errorEmail; ?>";
    if(errorEmpty == true ){
        $("#mail-name, #mail-email, #mail-message").addClass("input-error");
    }
    if (errorEmail == true ){
        $("#mail-email").addClass("input-error");
    }
    if (errorEmpty == false && errorEmail == false ){
        $("#mail-name, #mail-email, #mail-message").val("");
    }
</script>



