<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <title>{{ __('emails.password_reset.subject') }}</title>

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
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
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
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 6px;
            font-weight: 600;
            text-align: center;
            margin: 20px 0;
            box-shadow: 0 4px 14px 0 rgba(245, 158, 11, 0.3);
            transition: all 0.2s ease;
        }

        .button:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px 0 rgba(245, 158, 11, 0.4);
        }

        .warning {
            background-color: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 6px;
            padding: 16px;
            margin: 20px 0;
            color: #92400e;
        }

        .warning strong {
            display: block;
            margin-bottom: 8px;
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
            color: #f59e0b;
            font-weight: 600;
            font-size: 16px;
        }

        .subcopy {
            background-color: #f3f4f6;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            padding: 16px;
            margin: 20px 0;
            font-size: 12px;
            color: #6b7280;
            word-break: break-all;
        }

        .subcopy-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            display: block;
        }

        .security-notice {
            background-color: #ecfdf5;
            border: 1px solid #10b981;
            border-radius: 6px;
            padding: 16px;
            margin: 20px 0;
            color: #065f46;
        }

        .security-notice strong {
            display: block;
            margin-bottom: 8px;
            color: #047857;
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
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ __('emails.password_reset.subject') }}</h1>
        </div>

        <div class="content">
            <div class="greeting">
                {{ __('emails.password_reset.greeting', ['name' => $user->userable?->name ?? $user->email]) }}
            </div>

            <div class="message">
                <p>{{ __('emails.password_reset.line_1') }}</p>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="{{ $resetUrl }}" class="button">
                        {{ __('emails.password_reset.action') }}
                    </a>
                </div>

                <div class="warning">
                    <strong>{{ __('emails.password_reset.line_3') }}</strong>
                </div>

                <div class="security-notice">
                    <strong>🔒 Security Notice</strong>
                    <p>This link will expire in {{ config('auth.passwords.'.config('auth.defaults.passwords').'.expire', 60) }} minutes for your security.</p>
                    <p>If you didn't request this password reset, please ignore this email.</p>
                </div>

                <p>{{ __('emails.password_reset.line_2', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire', 60)]) }}</p>
            </div>

            <div class="subcopy">
                <span class="subcopy-label">{{ __('emails.password_reset.subcopy', ['actionText' => __('emails.password_reset.action')]) }}</span>
                <a href="{{ $resetUrl }}" style="color: #f59e0b;">{{ $resetUrl }}</a>
            </div>
        </div>

        <div class="footer">
            <p><span class="brand">RuangTes</span></p>
            <p>{{ __('emails.password_reset.salutation') }}</p>
            <p>{{ __('emails.welcome.team') }}</p>
        </div>
    </div>
</body>
</html>
