<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Attendance Summary - {{ \Carbon\Carbon::parse($date)->format('d-M-Y') }}</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 5mm;
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 7.5pt;
            margin: 0;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 5mm;
            padding-bottom: 2mm;
            border-bottom: 1px solid #ddd;
        }
        h1 {
            font-size: 14pt;
            margin: 0 0 2mm 0;
            color: #2c3e50;
        }
        h3 {
            font-size: 9pt;
            margin: 0;
            font-weight: normal;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        th, td {
            border: 0.5px solid #999;
            padding: 2px 3px;
            text-align: center;
            vertical-align: middle;
            line-height: 1.3;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .subject {
            font-size: 7pt;
            color: #666;
        }
        .attendance-ratio {
            font-weight: bold;
        }
        .high-attendance {
            color: #27ae60;
        }
        .low-attendance {
            color: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>DAILY ATTENDANCE SUMMARY REPORT</h1>
        <h3>Date: {{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }}</h3>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 8%;">Class</th>
                @for ($p = 1; $p <= 8; $p++)
                    <th style="width: 11.5%;">Period {{ $p }}<br>Teacher</th>
                    <th style="width: 5.5%;">Attendance</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $className => $periods)
                <tr>
                    <td><strong>{{ $className }}</strong></td>
                    @foreach ($periods as $period => $details)
                        <td>
                            {{ $details['teacher'] ?? '-' }}
                            @if(!empty($details['subject']))
                                <div class="subject">({{ $details['subject'] }})</div>
                            @endif
                        </td>
                        <td class="attendance-ratio {{ $details['present']/$details['total_students'] < 0.8 ? 'low-attendance' : 'high-attendance' }}">
                            {{ $details['present'] }}/{{ $details['total_students'] }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 3mm; font-size: 7pt; text-align: right;">
        Generated on {{ now()->format('Y-m-d H:i') }} | {{ config('app.name') }}
    </div>
</body>
</html>



