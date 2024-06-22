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
    <title>Asset Dispose Report</title>
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
                <h2>{{ $assetDispose->assetDisposeMst->company->name }}</h2>
                <p>{{ $assetDispose->assetDisposeMst->company->address }}</p>
                <p>Asset Dispose Report</p>
                <p>Print Date: {{ \Carbon\Carbon::now()->format('d-M-Y') }}</p>
            </div>

            <table class="info-table">
                <tr>
                    <td>
                        <p><strong>Dispose ID:</strong> {{ $assetDispose->id }}</p>
                        <p><strong>Workshop:</strong> {{ $assetDispose->assetDisposeMst->workshop->name }}</p>
                        <p><strong>Status:</strong> {{ $assetDispose->assetDisposeMst->status }}</p>
                        <p><strong>Prepared By:</strong> {{ $assetDispose->assetDisposeMst->user->name }}</p>
                        <p><strong>Approved By:</strong> {{ $assetDispose->assetDisposeMst->approver }}</p>
                    </td>
                    <td>
                        <p><strong>Dispose Date:</strong> {{ $assetDispose->created_at->format('d-M-Y') }}</p>
                        <p><strong>Panel Members:</strong> {{ $assetDispose->assetDisposeMst->panel_members }}</p>
                    </td>
                </tr>
            </table>

            <table class="report-table">
                <thead>
                    <tr>
                        {{-- <th>SL No</th> --}}
                        <th>Item Name</th>
                        <th>Remarks</th>
                        <th>User</th>
                        <th>Updated By</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>{{ $assetDispose->assetitemModel->asset_no }}</td>
                        <td>{{ $assetDispose->remarks }}</td>
                        <td>{{ $assetDispose->user->name }}</td>
                        <td>{{ $assetDispose->updated_by }}</td>
                    </tr>

                </tbody>
            </table>

            <div class="footer">
                {{-- <p><strong>Total Items:</strong> {{ number_to_words($assetDispose->details->count()) }} ({{ $assetDispose->details->count() }}) items</p> --}}
            </div>

            <div class="note">
                <p><strong>Note:</strong></p>
                <ol>
                    <li>Items disposed are not recoverable.</li>
                    <li>Ensure all items are correctly documented.</li>
                    <li>Report any discrepancies immediately.</li>
                </ol>
            </div>
        </section>
    </main>

    <script src="{{ asset('admin/assets/js/main.js') }}"></script>
</body>
</html>
