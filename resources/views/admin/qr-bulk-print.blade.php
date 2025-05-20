<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Print QR Cards</title>
    @vite(['resources/css/app.css'])

    <style>
        @media print {
            @page {
                size: A4;
                margin: 1cm;
            }

            body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                margin: 0 !important;
                /* ❌ remove this ↓ */
                /* background: white !important; */
            }

            .no-print {
                display: none !important;
            }

            .page-break {
                page-break-after: always;
            }

        }

        .card-wrapper {
            background-color: #eef2ff;
            /* Tailwind's indigo-50 */
            color: #1f2937;
            /* neutral dark slate */
            border: 1px solid #c7d2fe;
            /* soft indigo border */
            border-radius: 0.75rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            font-family: sans-serif;
            max-width: 336px;
            aspect-ratio: 336 / 212;
            overflow: hidden;
        }

        .card-header {
            background-color: #3b82f6;
            /* Tailwind blue-500 */
            color: white;
            border-bottom: 1px solid #93c5fd;
            /* Tailwind blue-300 */
            padding: 0.5rem;
            text-align: center;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .card-body {
            display: flex;
            flex-direction: row;
            gap: 1rem;
            padding: 1rem;
            font-size: 0.875rem;
        }

        .card-body .qr-box {
            padding: 0.5rem;
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
            height: fit-content;
        }

        .card-body .info {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }
    </style>
</head>

<body class="bg-gray-100 py-8 px-4 pb-24 print:pb-0">

    <!-- Grouped and paginated every 8 cards -->
    @foreach ($customers->chunk(8) as $group)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 justify-items-center print:grid-cols-2 mb-10">
            @foreach ($group as $customer)
                <div class="card-wrapper">
                    <div class="card-header">
                        Mhay Tindahan Loyalty Card
                    </div>
                    <div class="card-body">
                        <!-- QR Code -->
                        <div class="qr-box">
                            {!! QrCode::size(80)->generate('token=' . $customer->qr_token) !!}
                        </div>

                        <!-- Info -->
                        <div class="info">
                            <p style="font-weight: 600; font-size: 1rem;">{{ $customer->name }}</p>
                            <p style="color: #6b7280; font-size: 0.75rem;">{{ $customer->email }}</p>
                            <p style="font-size: 0.75rem; color: #374151;">
                                Show this card to earn or redeem points.<br>
                                <strong>1 Mhay Point = ₱1</strong>
                            </p>
                            <p style="font-size: 0.7rem; color: #6b7280;">
                                Visit: <span style="color: #1f2937;">www.mhaypoints.com</span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach

    <!-- Fixed Print Button -->
    <div class="fixed bottom-0 left-0 w-full no-print z-50 bg-white border-t border-gray-200">
        <button onclick="window.print()"
            class="w-full text-sm px-4 py-3 bg-blue-600 text-white font-semibold shadow hover:bg-blue-700 transition">
            🖨️ Print All QR Cards
        </button>
    </div>

</body>

</html>
