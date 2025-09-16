<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Certificate</title>
    {{-- Include a custom font from Google Fonts for a professional look --}}
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* General Body and Page Styling */
        body {
            font-family: 'Montserrat', sans-serif;
            text-align: center;
            padding: 20px;
            background-color: #f4f7f9; /* Light gray background */
            color: #333;
        }

        /* Certificate Container */
        .certificate-container {
            width: 90%;
            max-width: 800px;
            margin: 0 auto;
            border: 10px solid #e0e7ff; /* A modern, light blue border */
            padding: 50px;
            background-color: #ffffff; /* White background for the content area */
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); /* Soft shadow for depth */
            position: relative;
            overflow: hidden;
        }

        /* Decorative Ribbon Border (New Addition) */
        .certificate-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 15px solid #a3b1ff; /* A slightly darker blue for the inner frame */
            border-radius: 10px;
            pointer-events: none;
        }

        /* Certificate Heading */
        .certificate-title {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            color: #4b6cb7; /* A professional blue color */
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .certificate-subtitle {
            font-size: 24px;
            font-weight: 600;
            color: #7f8c8d;
            margin-top: 0;
            margin-bottom: 30px;
        }

        /* Recipient Name */
        .recipient-name {
            font-family: 'Playfair Display', serif;
            font-size: 38px;
            color: #1a237e; /* A rich, deep blue */
            margin-top: 30px;
            margin-bottom: 10px;
            border-bottom: 2px solid #ccc;
            display: inline-block;
            padding-bottom: 5px;
        }

        /* Details of Achievement */
        .details-text {
            font-size: 18px;
            line-height: 1.6;
            color: #555;
            margin-top: 30px;
        }

        .details-text strong {
            color: #2c3e50;
            font-weight: 600;
        }

        .score-info {
            font-size: 22px;
            font-weight: bold;
            color: #16a085; /* A vibrant green for the score */
            margin-top: 15px;
        }

        /* Footer and Date */
        .footer {
            margin-top: 50px;
            font-size: 16px;
            color: #7f8c8d;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .footer .date {
            text-align: left;
        }

        .footer .signature-area {
            text-align: right;
        }

        .footer .signature-line {
            display: block;
            width: 150px;
            border-top: 1px solid #7f8c8d;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <h1 class="certificate-title">Certificate of Achievement</h1>
        <p class="certificate-subtitle">PROUDLY PRESENTED TO</p>

        <p class="recipient-name">{{ $user->name }}</p>

        <p class="details-text">
            For successfully completing the quiz:<br>
            <strong>{{ $quiz->title }}</strong>
        </p>
        <p class="score-info">
            With a score of {{ $score }}/{{ $quiz->questions->count() }} ({{ $percentage }}%)
        </p>

        

        <div class="footer">
            <div class="date">
                <p>Date: {{ $date }}</p>
            </div>
            <div class="signature-area">
                <p>Signature</p>
                <span class="signature-line"></span>
            </div>
        </div>
    </div>
</body>
</html>