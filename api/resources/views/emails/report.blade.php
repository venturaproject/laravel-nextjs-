<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Product Report') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        p {
            font-size: 16px;
            color: #555;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ __('messages.product_report') }}</h1>
        <p>{{ __('messages.regard') }}</p>
        <p>{{ __('messages.product_report_find_attached') }}</p>
        <p>{{ __('messages.thank_you') }}</p>
        <div class="footer">
            <p>{{ __('messages.goodbye') }}</p>
            <p>{{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>
