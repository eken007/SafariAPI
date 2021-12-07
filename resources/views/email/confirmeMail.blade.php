<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .head{
            width: 100%;
            height: auto;
        }
        .body{
            width: 100%;
            height: auto;
            text-align: center;
        }
        .logo{
            text-align: center;
        }
        .footers{
            text-align: center;
            margin-top: 10%
        }
        .title{
            font-size:20px;
            font-weight: normal;
        }
        .footer{
            color: gray;
            font-size:15px;
        }
    </style>
</head>
<body >
    <div>
        <div class="head">
            <div class="logo">
                <img  src="{{ $message->embed(public_path() . '/images/safari.png') }}" />
            </div>
        </div>
        <div class="body">
            <h1 class="title">{{ $details['title'] }}</h1>
            <h1>{{ $details['body'] }}</h1>
        </div>
        <div class="footers">
            <p class="footer">veuillez ne pas répondre à ce courrier électronique</p>
            <p class="footer">CODEX Sarl</p>
            <p class="footer">Bilongue -> Douala -> Cameroun</p>
        </div>
    </div>
</body>
</html>