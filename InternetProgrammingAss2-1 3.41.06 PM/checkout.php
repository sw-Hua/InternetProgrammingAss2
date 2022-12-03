<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<style>
body {
    padding: 20px;
    background-color: #F2F2F2;
}

.centre {
    background-color: white;
    width: 400px;
    padding: 30px;
    border-radius: 20px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -55%);
    box-shadow: 0 0 30px white;
}
</style>

<body>
    <div class="centre">
        <h2>Customer Details and Payment</h2>
        </br>
        <h4>Please Fill in your details</h4>

        <script>
        function jump() {
            var v = document.getElementById("name").value;
            location.href = 'details.php?' + 'name=' + encodeURI(v);
        }
        </script>


        <form action="details.php" role="form">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" placeholder="Name" name="name" id="name" required="true" class="form-control">
            </div>
            <div class="form-group">
                <label for="name">Mailing address:</label><input type="text" placeholder="Mailing Address"
                    name="mailing-address" required="true" class="form-control">
            </div>

            <div class="form-group">
                <label for="name">City:</label><input type="text" placeholder="City" name="city" required="true"
                    class="form-control">
            </div>

            <div class="form-group">
                <label for="name">State:</label><input type="text" placeholder="State" name="state" required="true"
                    class="form-control">
            </div>

            <div class="form-group">
                <label for="name">Post-code:</label><input type="text" placeholder="Postcode" name="post-code"
                    required="true" class="form-control">
            </div>

            <div class="form-group">
                <label for="name">Payment Type:</label> <select name="payment-type" required="true"
                    class="form-control">
                    <option>Mater Card</option>
                    <option>Visa</option>
                    <option>Credit Card</option>
                    <option>Others</option>
                </select>
            </div>
            </br>
            <div class="form-group">
                <input type="submit" value="Checkout" class="btn btn-default">
            </div>
        </form>
        <div class="form-group">
            <form action="index.php">
                <input type="submit" value="<- Back to Previous" class="btn btn-warning">
            </form>
        </div>
    </div>
</body>

</html>