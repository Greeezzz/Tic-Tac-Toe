<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            margin-right: 16px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .card {
            background-color: #e0f2fe;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
            background-color: #b3d8f4;
        }

        .title {
            color: #0369a1;
        }

        .button {
            background-color: #0284c7;
        }

        .button:hover {
            background-color: #0369a1;
        }

        .text {
            color: #075985;
        }

        .bg-avatar-blue {
            background-color: #93c5fd;
        }
    </style>
</head>
<body class="bg-blue-600">
    <div class="flex justify-center items-center h-screen">
        <div class="card bg-white rounded-lg p-8 shadow-lg">
            <h1 class="title text-4xl font-bold mb-8">Welcome</h1>
            <div class="flex space-x-4 mb-8">
                <a href="{{ route('login') }}" class="button hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full">Login</a>
                <a href="{{ route('register') }}" class="button hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full">Register</a>
            </div>
            <div class="flex items-center">
                <div class="avatar bg-avatar-blue">
                    <img src="https://i.pinimg.com/474x/ff/4e/26/ff4e26fe8f480d914542a8df493e8dd8.jpg" alt="Chelo">
                </div>
                <div>
                    <h2 class="title text-2xl font-bold">Creator</h2>
                    <p class="text text-gray-600">Name: Chelo Arung Samudro</p>
                    <p class="text text-gray-600">WhatsApp: 083875095310</p>
                    <p class="text text-gray-600">Class: XI A</p>
                    <p class="text text-gray-600">TikTok: @reezzznt</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
