<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Plus
        </div>

        <div class="links">
            <lable for="num1">num 1: </lable>
            <input type="text" id="num1" name="num1"><br>

            <lable for="num2">num 2: </lable>
            <input type="text" id="num2" name="num2"><br>

            <input type="button" value="calculate" name="calc" id="calc"><br>

            <lable for="result">result: </lable>
            <input type="text" id="result" name="result"><br>


        </div>
    </div>
</div>
<!--<script src="js/jquery.min.js"></script>-->

<script>
    $("#calc").on("click", function () {
        var num1 = $("#num1").val();
        var num2 = $("#num2").val();

        console.log(num1+num2);
        console.log(parseInt(num1)+parseInt(num2));

        $("#result").val(parseInt(num1)+parseInt(num2));

        });

</script>
</body>
</html>
