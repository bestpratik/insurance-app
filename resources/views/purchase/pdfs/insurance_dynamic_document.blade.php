<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $data['templateTitle'] ?? 'Document' }}</title> 
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #000;
        }
        .header, .footer {
            text-align: center;
            font-weight: bold;
            margin: 20px 0;
        }
        .content {
            margin: 30px 0;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

    {{--@if(!empty($data['templateHeader']))
        <div class="header">
            {!! nl2br(e($data['templateHeader'])) !!}
        </div>
    @endif--}}

    <div class="content">
        {!! $data['templateBody'] !!}
    </div>

    {{--@if(!empty($data['templateFooter']))
        <div class="footer">
            {!! nl2br(e($data['templateFooter'])) !!}
        </div>
    @endif--}}

</body>
</html>
