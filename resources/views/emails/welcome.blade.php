<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <title>{{ __('emails.welcome.subject') }}</title>

    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8fafc;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .content {
            padding: 40px 30px;
        }

        .greeting {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 20px;
        }

        .message {
            color: #6b7280;
            margin-bottom: 30px;
            line-height: 1.7;
        }

        .button {
            display: inline-block;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 6px;
            font-weight: 600;
            text-align: center;
            margin: 20px 0;
            box-shadow: 0 4px 14px 0 rgba(16, 185, 129, 0.3);
            transition: all 0.2s ease;
        }

        .button:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px 0 rgba(16, 185, 129, 0.4);
        }

        .features {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 24px;
            margin: 24px 0;
        }

        .features h3 {
            color: #166534;
            font-size: 16px;
            font-weight: 600;
            margin: 0 0 16px 0;
        }

        .features ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .features li {
            color: #14532d;
            margin-bottom: 8px;
            padding-left: 20px;
            position: relative;
        }

        .features li:before {
            content: '✓';
            color: #10b981;
            font-weight: bold;
            position: absolute;
            left: 0;
        }

        .support {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            padding: 24px;
            margin: 24px 0;
        }

        .support h3 {
            color: #1e40af;
            font-size: 16px;
            font-weight: 600;
            margin: 0 0 12px 0;
        }

        .support p {
            color: #1e3a8a;
            margin: 0 0 16px 0;
        }

        .support .button {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            box-shadow: 0 4px 14px 0 rgba(59, 130, 246, 0.3);
        }

        .support .button:hover {
            box-shadow: 0 6px 20px 0 rgba(59, 130, 246, 0.4);
        }

        .footer {
            background-color: #f9fafb;
            border-top: 1px solid #e5e7eb;
            padding: 30px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }

        .footer p {
            margin: 5px 0;
        }

        .brand {
            color: #10b981;
            font-weight: 600;
            font-size: 16px;
        }

        .celebration {
            text-align: center;
            font-size: 48px;
            margin: 20px 0;
        }

        @media (max-width: 640px) {
            body {
                padding: 10px;
            }

            .header {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 20px;
            }

            .content {
                padding: 30px 20px;
            }

            .button {
                display: block;
                width: 100%;
                box-sizing: border-box;
            }

            .features, .support {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="celebration">🎉</div>
            <h1>{{ __('emails.welcome.subject') }}</h1>
        </div>

        <div class="content">
            <div class="greeting">
                {{ __('emails.welcome.greeting', ['name' => $user->userable?->name ?? $user->email]) }}
            </div>

            <div class="message">
                <p>{{ __('emails.welcome.line_1') }}</p>
                <p>{{ __('emails.welcome.line_2') }}</p>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="{{ route('dashboard') }}" class="button">
                        {{ __('emails.welcome.get_started') }}
                    </a>
                </div>
            </div>

            <div class="features">
                <h3>{{ __('emails.welcome.features.title') }}</h3>
                <ul>
                    <li>{{ __('emails.welcome.features.take_tests') }}</li>
                    <li>{{ __('emails.welcome.features.view_results') }}</li>
                    <li>{{ __('emails.welcome.features.manage_profile') }}</li>
                    <li>{{ __('emails.welcome.features.get_certificates') }}</li>
                </ul>
            </div>

            <div class="support">
                <h3>{{ __('emails.welcome.support.title') }}</h3>
                <p>{{ __('emails.welcome.support.line_1') }}</p>
                <div style="text-align: center;">
                    <a href="mailto:support@ruangtes.com" class="button">
                        {{ __('emails.welcome.support.contact') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="footer">
            <p><span class="brand">RuangTes</span></p>
            <p>{{ __('emails.welcome.salutation') }}</p>
            <p>{{ __('emails.welcome.team') }}</p>
        </div>
    </div>
</body>
</html>
