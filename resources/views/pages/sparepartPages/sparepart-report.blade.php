<?php
if (!function_exists('number_to_words')) {
    function number_to_words($number) {}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spare Parts Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2, .header p {
            margin: 0;
        }
        .header p {
            margin-top: 5px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            border: none;
            margin-bottom: 20px;
        }
        .info-table th, .info-table td {
            border: none;
            padding: 8px;
            text-align: left;
        }
        .info-table th {
            background-color: #f2f2f2;
        }
        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .report-table th, .report-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        .report-table th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 30px;
        }
        .footer p {
            margin: 5px 0;
        }
        .note {
            margin-top: 30px;
        }
        .note p {
            margin: 5px 0;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <main id="main" class="main">
        <section class="section">
            <div class="header">
                {{-- <h2>{{ $sparepart->company->name }}</h2>
                <p>{{ $sparepart->company->address }}</p> --}}
                <p>Spare Part Report</p>
                <p>Print Date: {{ \Carbon\Carbon::now()->format('d-M-Y') }}</p>
            </div>

            <table class="info-table">
                <tr>
                    <td>
                        <p><strong>Sparepart ID:</strong> {{ $sparepart->id }}</p>
                        <p><strong>Prepared By:</strong> {{ $sparepart->user->name }}</p>
                    </td>
                    <td>
                        <p><strong>Sparepart Created Date:</strong> {{ $sparepart->created_at->format('d-M-Y') }}</p>
                    </td>
                </tr>
            </table>

            <table class="report-table">
                <thead>
                    <tr>
                        <th>Sparepart No.</th>
                        <th>Sparepart Name</th>
                        <th>Description</th>
                        <th>User</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $sparepart->part_no }}</td>
                        <td>{{ $sparepart->name }}</td>
                        <td>{{ $sparepart->description }}</td>
                        <td>{{ $sparepart->user->name }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="footer">
            </div>

            <div class="note">
                {{-- <p><strong>Note:</strong></p>
                <ol>
                    <li>Items disposed are not recoverable.</li>
                    <li>Ensure all items are correctly documented.</li>
                    <li>Report any discrepancies immediately.</li>
                </ol> --}}
            </div>
        </section>
    </main>

    <script src="{{ asset('admin/assets/js/main.js') }}"></script>
</body>
</html>
