<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Blue QR Loyalty Card</title>
    @vite(['resources/css/app.css'])
    <style>
        @media print {
            .no-print {
                display: none;
            }

            body {
                margin: 0;
                background: white;
            }
        }

        .id-card {
            width: 336px;
            height: 212px;
            background: #ffffff;
            color: #1e3a8a;
            /* Blue-800 */
            border: 1px solid #d1d5db;
            /* gray-300 */
        }

        .card-header {
            background-color: #3b82f6;
            /* Blue-500 */
            color: white;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .card-inner {
            padding: 0.75rem;
            display: flex;
            flex-direction: row;
            align-items: center;
            height: calc(100% - 2.5rem);
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="id-card rounded-xl shadow-md overflow-hidden text-[11px] font-sans relative print:shadow-none">

        <!-- Header -->
        <div class="card-header text-center py-1.5 uppercase font-bold text-sm tracking-wide">
            Mhay Tindahan Loyalty Card
        </div>

        <!-- Body -->
        <div class="card-inner">

            <!-- QR Code -->
            <div class="w-[90px] h-[90px] flex items-center justify-center border rounded-md shadow">
                {!! QrCode::size(80)->generate('token=' . Auth::user()->qr_token) !!}
            </div>

            <!-- Info -->
            <div class="ml-4 flex-1 text-gray-800 text-[10.5px] leading-tight space-y-1">
                <p class="text-sm font-bold text-blue-700">{{ Auth::user()->name }}</p>
                <p class="text-gray-600">{{ Auth::user()->email }}</p>
                <p class="text-[10px] text-gray-500">
                    Show this card to earn or redeem points.<br>
                    <span class="text-blue-600 font-semibold">1 Mhay Point = ₱1</span>
                </p>

                <!-- Website -->
                <p class="text-[9px] text-gray-400">
                    Visit: <span class="text-blue-700 font-medium">www.mhaypoints.com</span>
                </p>
            </div>
        </div>

        <!-- Print Button -->
        <div class="absolute bottom-2 left-0 right-0 flex justify-center no-print">
            <button onclick="window.print()"
                class="text-[10px] px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition font-medium shadow">
                🖨️ Print Card
            </button>
        </div>

    </div>

</body>

</html>
