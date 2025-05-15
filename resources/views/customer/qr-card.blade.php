<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>QR Code Card</title>
    @vite(['resources/css/app.css'])
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-white p-6 text-gray-800 antialiased flex items-center justify-center min-h-screen">

    <div class="w-full max-w-sm border border-gray-300 p-6 rounded-xl shadow-lg text-center">
        <h1 class="text-lg font-semibold text-indigo-700 mb-2">Mhay Tindahan Customer QR</h1>

        <p class="text-sm text-gray-600 mb-4">{{ Auth::user()->name }}</p>

        <div class="flex justify-center my-4">
            {!! QrCode::size(180)->generate('token=' . Auth::user()->qr_token) !!}
        </div>

        <p class="text-xs text-gray-500">Scan this code to earn or redeem points</p>

        <div class="mt-6 no-print">
            <button onclick="window.print()"
                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                🖨️ Print QR Card
            </button>
        </div>
    </div>

</body>

</html>
