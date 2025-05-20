<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Print QR Cards</title>
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

            .print-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(336px, 1fr));
                gap: 1.5rem;
                justify-items: center;
                padding: 0;
            }
        }

        .id-card {
            width: 100%;
            max-width: 336px;
            height: auto;
            aspect-ratio: 336 / 212;
            background: #ffffff;
            color: #1e3a8a;
            border: 1px solid #d1d5db;
        }

        .card-header {
            background-color: #3b82f6;
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

<body class="bg-gray-100 py-8 px-4 print:p-0">

    <!-- Cards Container -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 justify-items-center print-grid">
        @foreach ($customers as $customer)
            <div class="id-card rounded-xl shadow-md overflow-hidden text-[11px] font-sans relative print:shadow-none">
                <!-- Header -->
                <div class="card-header text-center py-1.5 uppercase font-bold text-sm tracking-wide">
                    Mhay Tindahan Loyalty Card
                </div>

                <!-- Body -->
                <div class="card-inner">
                    <!-- QR Code -->
                    <div class="w-[90px] h-[90px] flex items-center justify-center border rounded-md shadow">
                        {!! QrCode::size(80)->generate('token=' . $customer->qr_token) !!}
                    </div>

                    <!-- Info -->
                    <div class="ml-4 flex-1 text-gray-800 text-[10.5px] leading-tight space-y-1">
                        <p class="text-sm font-bold text-blue-700">{{ $customer->name }}</p>
                        <p class="text-gray-600">{{ $customer->email }}</p>
                        <p class="text-[10px] text-gray-500">
                            Show this card to earn or redeem points.<br>
                            <span class="text-blue-600 font-semibold">1 Mhay Point = ₱1</span>
                        </p>

                        <p class="text-[9px] text-gray-400">
                            Visit: <span class="text-blue-700 font-medium">www.mhaypoints.com</span>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="fixed bottom-0 left-0 w-full no-print z-50 bg-white border-t border-gray-200">
        <button onclick="window.print()"
            class="w-full text-sm px-4 py-3 bg-blue-600 text-white font-semibold shadow hover:bg-blue-700 transition">
            🖨️ Print All QR Cards
        </button>
    </div>

</body>

</html>
