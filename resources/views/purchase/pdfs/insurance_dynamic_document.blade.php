
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $data['templateTitle'] }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.6;
        }
        .header, .footer {
            text-align: center;
        }
        .content {
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        {!! $data['templateHeader'] !!}
    </div>

    <div class="content">
        {!! $data['templateBody'] !!}
    </div>

    <div class="footer">
        {!! $data['templateFooter'] !!}
    </div>
</body>
</html>


