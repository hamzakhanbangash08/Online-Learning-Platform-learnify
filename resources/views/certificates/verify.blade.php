
@extends('layouts.master')
@section('title', 'Certificate Verification')

@section('styles')
  <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: #333;
        } */

        .container {
            max-width: 1000px;
            width: 100%;
            margin: 0 auto;
        }

        .certificate-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
            position: relative;
            margin-bottom: 30px;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .certificate-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.18);
        }

        .certificate-header {
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
            padding: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .certificate-header.invalid {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        }

        .certificate-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 60%);
            transform: rotate(30deg);
        }

        .certificate-badge {
            width: 120px;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            position: relative;
            z-index: 2;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .certificate-badge i {
            font-size: 50px;
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .certificate-badge.invalid i {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .certificate-title {
            font-family: 'Playfair Display', serif;
            font-size: 36px;
            font-weight: 700;
            color: white;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .certificate-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 18px;
            position: relative;
            z-index: 2;
        }

        .certificate-body {
            padding: 40px;
        }
        
        .certificate-body.invalid {
            text-align: center;
            padding: 40px 20px;
        }

        .recipient-info {
            text-align: center;
            margin-bottom: 30px;
        }

        .recipient-name {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .course-info {
            font-size: 20px;
            color: #7f8c8d;
            margin-bottom: 5px;
        }

        .course-title {
            font-size: 24px;
            font-weight: 600;
            color: #2980b9;
            margin-bottom: 30px;
        }
        
        .course-title.invalid {
            margin-top: 10px;
            font-size: 20px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .detail-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .detail-card:hover {
            transform: translateY(-5px);
        }

        .detail-card i {
            font-size: 28px;
            color: #27ae60;
            margin-bottom: 15px;
        }

        .detail-label {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 5px;
        }

        .detail-value {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .action-buttons.linkedin {
            grid-template-columns: 1fr;
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-decoration: none;
        }

        .btn i {
            margin-right: 10px;
        }

        .btn-download {
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
            color: white;
        }

        .btn-download:hover {
            background: linear-gradient(135deg, #27ae60 0%, #219653 100%);
            box-shadow: 0 8px 20px rgba(39, 174, 96, 0.3);
        }

        .btn-copy {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
        }

        .btn-copy:hover {
            background: linear-gradient(135deg, #2980b9 0%, #1c6ea4 100%);
            box-shadow: 0 8px 20px rgba(41, 128, 185, 0.3);
        }

        .btn-linkedin {
            background: linear-gradient(135deg, #0077b5 0%, #005582 100%);
            color: white;
        }

        .btn-linkedin:hover {
            background: linear-gradient(135deg, #005582 0%, #003d5e 100%);
            box-shadow: 0 8px 20px rgba(0, 87, 130, 0.3);
        }

        .btn-linkedin-add {
            background: linear-gradient(135deg, #6f42c1 0%, #4a2d8f 100%);
            color: white;
            grid-column: span 2;
        }

        .btn-linkedin-add:hover {
            background: linear-gradient(135deg, #5a2d9e 0%, #3d237c 100%);
            box-shadow: 0 8px 20px rgba(111, 66, 193, 0.3);
        }

        .verification-section {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
        }

        .verification-title {
            text-align: center;
            font-size: 16px;
            color: #7f8c8d;
            margin-bottom: 15px;
        }

        .link-copy-container {
            display: flex;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .link-input {
            flex-grow: 1;
            padding: 15px;
            border: none;
            background: #f8f9fa;
            font-size: 14px;
            color: #2c3e50;
        }

        .copy-btn {
            padding: 15px 20px;
            background: #3498db;
            color: white;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .copy-btn:hover {
            background: #2980b9;
        }

        .watermark {
            position: absolute;
            bottom: 20px;
            right: 20px;
            opacity: 0.03;
            font-size: 120px;
            color: #000;
            z-index: 0;
        }

        .footer {
            text-align: center;
            color: #7f8c8d;
            font-size: 14px;
            margin-top: 30px;
        }

        .toast {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
            z-index: 1000;
        }

        .toast.show {
            opacity: 1;
            visibility: visible;
        }

        .toast i {
            margin-right: 10px;
            color: #2ecc71;
        }

        @media (max-width: 768px) {
            .details-grid, .action-buttons {
                grid-template-columns: 1fr;
            }
            .certificate-title, .recipient-name {
                font-size: 28px;
            }
        }
        
        .bg-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.03;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%2327ae60' fill-rule='evenodd'/%3E%3C/svg%3E");
            pointer-events: none;
        }

        .corner-decoration {
            position: absolute;
            width: 120px;
            height: 120px;
            opacity: 0.1;
        }

        .corner-top-left {
            top: 0;
            left: 0;
            border-top: 4px solid #27ae60;
            border-left: 4px solid #27ae60;
            border-top-left-radius: 20px;
        }

        .corner-top-right {
            top: 0;
            right: 0;
            border-top: 4px solid #27ae60;
            border-right: 4px solid #27ae60;
            border-top-right-radius: 20px;
        }

        .corner-bottom-left {
            bottom: 0;
            left: 0;
            border-bottom: 4px solid #27ae60;
            border-left: 4px solid #27ae60;
            border-bottom-left-radius: 20px;
        }

        .corner-bottom-right {
            bottom: 0;
            right: 0;
            border-bottom: 4px solid #27ae60;
            border-right: 4px solid #27ae60;
            border-bottom-right-radius: 20px;
        }
    </style>
@endsection
@section('content')
 @if(isset($certificate))
        <div class="container">
            <div class="certificate-card">
                <div class="bg-pattern"></div>
                <div class="corner-decoration corner-top-left"></div>
                <div class="corner-decoration corner-top-right"></div>
                <div class="corner-decoration corner-bottom-left"></div>
                <div class="corner-decoration corner-bottom-right"></div>

                <div class="certificate-header">
                    <div class="certificate-badge">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h1 class="certificate-title">Certificate of Completion</h1>
                    <p class="certificate-subtitle">This certifies that</p>
                </div>

                <div class="certificate-body">
                    <div class="recipient-info">
                        <h2 class="recipient-name">{{ $certificate->user->name }}</h2>
                        <p class="course-info">has successfully completed the course</p>
                        <p class="course-title">{{ $certificate->quiz->title }}</p>
                    </div>

                    <div class="details-grid">
                        <div class="detail-card">
                            <i class="fas fa-calendar-alt"></i>
                            <div class="detail-label">Issued On</div>
                            <div class="detail-value">{{ \Carbon\Carbon::parse($certificate->issued_at)->format('d M, Y') }}</div>
                        </div>

                        <div class="detail-card">
                            <i class="fas fa-fingerprint"></i>
                            <div class="detail-label">Certificate ID</div>
                            <div class="detail-value">{{ $certificate->token }}</div>
                        </div>
                    </div>

                    <div class="action-buttons">
                        <a href="{{ route('certificate.download', $certificate->id) }}" class="btn btn-download">
                            <i class="fas fa-download"></i> Download Certificate
                        </a>

                        <button class="btn btn-copy" onclick="copyLink()">
                            <i class="fas fa-link"></i> Copy Link
                        </button>
                    </div>
                    
                    {{-- LinkedIn Buttons --}}
                    @php
                        $org = setting('organization_name', config('app.name'));
                        $url = route('certificate.download', $certificate->token);
                    @endphp
                    <div class="action-buttons linkedin">
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($url) }}"
                            target="_blank" class="btn btn-linkedin">
                            <i class="fab fa-linkedin"></i> Share on LinkedIn
                        </a>
                        <a href="https://www.linkedin.com/profile/add?startTask=CERTIFICATION_NAME&name={{ urlencode($certificate->quiz->title) }}&organizationName={{ urlencode($org) }}&issueYear={{ $certificate->issued_at->format('Y') }}&issueMonth={{ $certificate->issued_at->format('m') }}&certUrl={{ urlencode($url) }}"
                            target="_blank" class="btn btn-linkedin-add">
                            <i class="fab fa-linkedin"></i> Add to LinkedIn Profile
                        </a>
                    </div>

                    <div class="verification-section">
                        <p class="verification-title">Verify this certificate at any time</p>
                        <div class="link-copy-container">
                            <input type="text" class="link-input" id="verifyLink" value="{{ route('certificate.verify', $certificate->token) }}" readonly>
                            <button class="copy-btn" onclick="copyLink()">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="watermark">
                    <i class="fas fa-award"></i>
                </div>
            </div>

            <footer class="footer">
                {!! setting('footer_text', '© '.date('Y').' '.config('app.name')) !!}
            </footer>
        </div>
    @else
        <div class="container">
            <div class="certificate-card" style="box-shadow: none;">
                <div class="certificate-header invalid">
                    <div class="certificate-badge invalid">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h1 class="certificate-title">Invalid or Expired</h1>
                    <p class="certificate-subtitle">Certificate Not Found</p>
                </div>
                <div class="certificate-body invalid">
                    <p class="course-info">The certificate token could not be verified.</p>
                    <p class="course-title invalid">Please check the link or try again.</p>
                </div>
            </div>
        </div>
    @endif

    <div id="toast" class="toast">
        <i class="fas fa-check-circle"></i> Verification link copied to clipboard!
    </div>
@endsection

@section('scripts')
<script>
        function copyLink() {
            const copyText = document.getElementById("verifyLink");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            
            const toast = document.getElementById("toast");
            toast.classList.add("show");
            
            setTimeout(function() {
                toast.classList.remove("show");
            }, 3000);
        }
    </script>
@endsection