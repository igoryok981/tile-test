<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Find tile</title>
</head>
<body>
<form method="post" id="coords">
    <label for="latitude">Latitude:</label>
    <input type="text" name="latitude" id="latitude">
    <label for="longitude">Longitude:</label>
    <input type="text" name="longitude" id="longitude">
    <input type="submit" value="Calculate">
    <p name="result" id="result"></p>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    $(document).ready(function () {
        $('#coords').submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                data: {
                    latitude: $('#latitude').val(),
                    longitude: $('#longitude').val()
                },
                url: 'findtile.php',
                dataType: 'text',
                success: function (res) {
                    $("#result").html(res);
                }
            });
            return false;
        });
    });
</script>
</body>
</html>