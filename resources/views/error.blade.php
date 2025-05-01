<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "PingFang SC", "Helvetica Neue", Helvetica, "Microsoft YaHei", Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('/pic/oauth2-authorize-bg.jpg');
            background-size: cover;
            background-position: center;
            opacity: 0.2;
            z-index: 1;
        }

        .container {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 3rem;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .error-icon {
            font-size: 5rem;
            margin-bottom: 1.5rem;
            color: #5d76cb;
        }

        .error-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #333;
            background: linear-gradient(135deg, #4568dc 0%, #b06ab3 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .error-message {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 2.5rem;
            color: #555;
        }

        .action-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .btn {
            padding: 0.8rem 1.8rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4568dc 0%, #b06ab3 100%);
            color: #fff;
            box-shadow: 0 4px 15px rgba(69, 104, 220, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(69, 104, 220, 0.5);
        }

        .btn-secondary {
            background: transparent;
            color: #555;
            border: 1px solid rgba(0, 0, 0, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(0, 0, 0, 0.05);
            transform: translateY(-3px);
        }

        .footer {
            margin-top: 2rem;
            color: #777;
            font-size: 0.9rem;
        }

        .ornament {
            position: absolute;
            background: linear-gradient(135deg, #4568dc 0%, #b06ab3 100%);
            border-radius: 50%;
            filter: blur(70px);
            opacity: 0.15;
            z-index: 0;
        }

        .ornament-1 {
            width: 300px;
            height: 300px;
            top: -150px;
            left: -150px;
        }

        .ornament-2 {
            width: 200px;
            height: 200px;
            bottom: -100px;
            right: -100px;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 2rem;
            }

            .error-title {
                font-size: 2rem;
            }

            .error-message {
                font-size: 1rem;
            }

            .action-links {
                flex-direction: column;
                gap: 1rem;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="background"></div>
<div class="ornament ornament-1"></div>
<div class="ornament ornament-2"></div>

<div class="container">
    <div class="error-icon">
        <i class="fas fa-exclamation-circle"></i>
    </div>
    <h1 class="error-title">Error</h1>
    <p class="error-message">
        {{ $error }}
    </p>

    <div class="action-links">
        <a href="/" class="btn btn-primary">Go home</a>
        <a href="javascript:history.back()" class="btn btn-secondary">Go back</a>
    </div>
</div>
</body>
</html>
