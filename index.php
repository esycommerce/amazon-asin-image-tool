<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EsyCommerce | Amazon ASIN Images Tool</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- <script type="application/javascript" src="js/bootstrap.min.js"></script> -->
    <script type="application/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="application/javascript" src="js/ais.js"></script>
    <style>
        .mycontainer{
            width: 600px;
            padding: 50px;
        }
        .mytextarea{
            height: 200px !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="#"><img src="https://www.esycommerce.com/portal2/uploads/company/logo.png"> | Amazon ASIN Images Tool</a>
    </nav>

    <div class="container mycontainer">
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Enter Amazon ASIN codes here:</label>
                <textarea id="asins" class="form-control mytextarea" placeholder="Eg.: B07HZ8JWCL"></textarea>
                <small class="form-text text-muted">Enter multiple ASINs on separate lines</small>
            </div>
            <button id="submit" type="submit" class="btn btn-primary">Start</button>
        </form>
        <div class="progress" style="margin-top: 50px;">
            <div id="progress" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
        </div>
    </div>


</body>
</html>