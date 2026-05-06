<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        @page {
            margin: 0;
            size: landscape;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            width: 11in;
            height: 8.5in;
            position: relative;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            overflow: hidden;
        }
        
        /* Outer Border */
        .outer-border {
            position: absolute;
            top: 0.3in;
            left: 0.3in;
            right: 0.3in;
            bottom: 0.3in;
            border: 6px solid #1e40af;
            border-radius: 12px;
        }
        
        /* Inner Border */
        .inner-border {
            position: absolute;
            top: 0.45in;
            left: 0.45in;
            right: 0.45in;
            bottom: 0.45in;
            border: 2px solid #3b82f6;
            border-radius: 8px;
        }
        
        /* Corner Decorations */
        .corner {
            position: absolute;
            width: 60px;
            height: 60px;
        }
        
        .corner-tl {
            top: 0.45in;
            left: 0.45in;
            border-top: 4px solid #f59e0b;
            border-left: 4px solid #f59e0b;
            border-radius: 8px 0 0 0;
        }
        
        .corner-tr {
            top: 0.45in;
            right: 0.45in;
            border-top: 4px solid #f59e0b;
            border-right: 4px solid #f59e0b;
            border-radius: 0 8px 0 0;
        }
        
        .corner-bl {
            bottom: 0.45in;
            left: 0.45in;
            border-bottom: 4px solid #f59e0b;
            border-left: 4px solid #f59e0b;
            border-radius: 0 0 0 8px;
        }
        
        .corner-br {
            bottom: 0.45in;
            right: 0.45in;
            border-bottom: 4px solid #f59e0b;
            border-right: 4px solid #f59e0b;
            border-radius: 0 0 8px 0;
        }
        
        /* Content */
        .content {
            position: absolute;
            top: 0.65in;
            left: 0.8in;
            right: 0.8in;
            bottom: 0.65in;
            text-align: center;
        }
        
        /* Logo & Header */
        .header {
            margin-bottom: 0.15in;
        }
        
        .logo-placeholder {
            width: 60px;
            height: 60px;
            margin: 0 auto 8px;
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20pt;
            font-weight: 900;
        }
        
        .company-name {
            font-size: 14pt;
            font-weight: 700;
            color: #1e40af;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 3px;
        }
        
        .certificate-title {
            font-size: 32pt;
            font-weight: 900;
            color: #1e40af;
            letter-spacing: 4px;
            text-transform: uppercase;
            margin: 8px 0;
        }
        
        .subtitle {
            font-size: 11pt;
            color: #64748b;
            font-weight: 400;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }
        
        /* Decorative Line */
        .line {
            width: 50%;
            height: 2px;
            background: linear-gradient(to right, transparent, #f59e0b, transparent);
            margin: 10px auto;
        }
        
        /* Main Content */
        .presented-to {
            font-size: 12pt;
            color: #475569;
            font-style: italic;
            margin: 8px 0 6px 0;
        }
        
        .student-name {
            font-size: 24pt;
            font-weight: 700;
            color: #0f172a;
            margin: 6px 0 8px 0;
            font-style: italic;
            border-bottom: 2px solid #f59e0b;
            display: inline-block;
            padding-bottom: 4px;
        }
        
        .completion-text {
            font-size: 10pt;
            color: #475569;
            line-height: 1.4;
            margin: 8px 0;
            max-width: 75%;
            margin-left: auto;
            margin-right: auto;
        }
        
        .course-name {
            font-size: 16pt;
            font-weight: 700;
            color: #1e40af;
            margin: 6px 0;
        }
        
        /* Dates */
        .dates {
            display: flex;
            justify-content: space-around;
            margin: 12px 0 8px 0;
            padding: 0 40px;
        }
        
        .date-item {
            text-align: center;
        }
        
        .date-label {
            font-size: 8pt;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 2px;
        }
        
        .date-value {
            font-size: 10pt;
            color: #0f172a;
            font-weight: 600;
        }
        
        /* Signature Section */
        .signatures {
            display: flex;
            justify-content: space-around;
            margin-top: 15px;
            padding: 0 60px;
        }
        
        .signature-item {
            text-align: center;
            width: 200px;
        }
        
        .signature-line {
            border-top: 2px solid #1e40af;
            margin: 0 0 4px 0;
            padding-top: 4px;
        }
        
        .signature-name {
            font-size: 9pt;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 2px;
        }
        
        .signature-title {
            font-size: 7pt;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        /* Certificate Number */
        .cert-number {
            position: absolute;
            bottom: 0.5in;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 7pt;
            color: #94a3b8;
            letter-spacing: 1px;
        }
        
        /* Watermark */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 80pt;
            font-weight: 900;
            color: rgba(30, 64, 175, 0.03);
            pointer-events: none;
            letter-spacing: 15px;
        }
        
        /* Seal */
        .seal {
            position: absolute;
            bottom: 0.85in;
            right: 1in;
            width: 70px;
            height: 70px;
            border: 3px solid #f59e0b;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle, #fef3c7 0%, #f59e0b 100%);
        }
        
        .seal-text {
            font-size: 8pt;
            font-weight: 900;
            color: #1e40af;
            text-align: center;
            line-height: 1.2;
        }
        
        /* QR Code */
        .qr-code {
            position: absolute;
            bottom: 0.85in;
            left: 1in;
            width: 60px;
            height: 60px;
            background: white;
            border: 1px solid #e2e8f0;
            padding: 4px;
        }
        
        .qr-code img {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <!-- Borders -->
    <div class="outer-border"></div>
    <div class="inner-border"></div>
    
    <!-- Corner Decorations -->
    <div class="corner corner-tl"></div>
    <div class="corner corner-tr"></div>
    <div class="corner corner-bl"></div>
    <div class="corner corner-br"></div>
    
    <!-- Watermark -->
    <div class="watermark">CERTIFIED</div>
    
    <!-- Main Content -->
    <div class="content">
        <!-- Header -->
        <div class="header">
            <div class="logo-placeholder">AFG</div>
            <div class="company-name">AFG Engineering Association</div>
            <div class="certificate-title">Certificate</div>
            <div class="subtitle">OF COMPLETION</div>
            <div class="line"></div>
        </div>
        
        <!-- Student Name -->
        <div class="presented-to">This certificate is proudly presented to</div>
        <div class="student-name">{{ $studentName }}</div>
        
        <div class="completion-text">
            For the successful completion of all requirements and coursework in
        </div>
        
        <div class="course-name">{{ $courseName }}</div>
        
        <div class="line"></div>
        
        <!-- Dates -->
        <div class="dates">
            <div class="date-item">
                <div class="date-label">Start Date</div>
                <div class="date-value">{{ $startDate }}</div>
            </div>
            <div class="date-item">
                <div class="date-label">Completion Date</div>
                <div class="date-value">{{ $endDate }}</div>
            </div>
        </div>
        
        <!-- Signatures -->
        <div class="signatures">
            <div class="signature-item">
                <div class="signature-line"></div>
                <div class="signature-name">Program Director</div>
                <div class="signature-title">AFG Engineering Association</div>
            </div>
            <div class="signature-item">
                <div class="signature-line"></div>
                <div class="signature-name">Lead Instructor</div>
                <div class="signature-title">Course Instructor</div>
            </div>
        </div>
    </div>
    
    <!-- QR Code -->
    <div class="qr-code">
        <img src="{{ public_path('images/qr-placeholder.png') }}" alt="QR" onerror="this.style.display='none'; this.parentElement.innerHTML='<div style=\'width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:8pt;color:#94a3b8;\'>QR</div>';">
    </div>
    
    <!-- Seal -->
    <div class="seal">
        <div class="seal-text">AFG<br>CERTIFIED</div>
    </div>
    
    <!-- Certificate Number -->
    <div class="cert-number">
        Certificate ID: {{ $certificateNumber }} | Verify at: afg-eng.com/verify/{{ $certificateNumber }}
    </div>
</body>
</html>
