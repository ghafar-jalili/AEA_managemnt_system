<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Enrollment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    /**
     * Generate PDF certificate for student
     */
    public function generatePdf(Certificate $certificate)
    {
        // Check if user owns this certificate
        if (Auth::user()->id !== $certificate->user_id && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        // Check if certificate is verified (approved by admin)
        if (!$certificate->is_verified) {
            abort(403, 'Certificate is not yet approved by admin.');
        }

        $data = [
            'studentName' => $certificate->student_name,
            'courseName' => $certificate->course_name,
            'startDate' => $certificate->start_date ? $certificate->start_date->format('F d, Y') : 'N/A',
            'endDate' => $certificate->issue_date->format('F d, Y'),
            'certificateNumber' => $certificate->certificate_number,
        ];

        $pdf = Pdf::loadView('certificate.template', $data);
        
        // Set paper size to landscape letter
        $pdf->setPaper('letter', 'landscape');
        
        // Set options for better rendering
        $pdf->setOption('isHtml5ParserEnabled', true);
        $pdf->setOption('isRemoteEnabled', true);
        
        $fileName = "Certificate_{$certificate->certificate_number}.pdf";
        
        return $pdf->download($fileName);
    }

    /**
     * Claim certificate (student requests after completing course)
     */
    public function claim(Enrollment $enrollment)
    {
        $user = Auth::user();

        // Verify ownership
        if ($enrollment->user_id !== $user->id) {
            abort(403, 'Unauthorized access.');
        }

        // Check if enrollment is approved or completed
        if (!in_array($enrollment->status, ['approved', 'completed'])) {
            return back()->with('error', 'You must be enrolled and approved to claim a certificate.');
        }

        // Check if certificate already exists (any status)
        $existingCertificate = Certificate::where('user_id', $user->id)
            ->where('course_id', $enrollment->course_id)
            ->first();

        if ($existingCertificate) {
            if ($existingCertificate->is_verified) {
                return back()->with('error', 'You have already claimed and received a certificate for this course.');
            }
            return back()->with('info', 'Your certificate request is pending admin approval.');
        }

        // Create certificate request (pending admin approval)
        Certificate::create([
            'user_id' => $user->id,
            'course_id' => $enrollment->course_id,
            'certificate_number' => Certificate::generateCertificateNumber(),
            'student_name' => $user->name,
            'course_name' => $enrollment->course->title,
            'issue_date' => now(),
            'start_date' => $enrollment->enrolled_at,
            'is_verified' => false, // Pending admin approval
        ]);

        // Increment certificates notification for all admin users
        $adminUsers = \App\Models\User::where('role', 'admin')->get();
        foreach ($adminUsers as $admin) {
            \App\Models\Notification::incrementCount($admin->id, 'certificates');
        }

        return back()->with('success', 'Certificate request submitted! Admin will review and approve your certificate.');
    }

    /**
     * ADMIN: View all certificate requests
     */
    public function adminIndex()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        // Clear certificates notification for the admin
        \App\Models\Notification::clearCount(auth()->id(), 'certificates');

        $certificates = Certificate::with(['user', 'course'])
            ->latest()
            ->paginate(20);

        return view('admin.certificates.index', compact('certificates'));
    }

    /**
     * ADMIN: Approve certificate
     */
    public function approve(Certificate $certificate)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $certificate->update([
            'is_verified' => true,
        ]);

        return back()->with('success', 'Certificate approved successfully! Student can now download it.');
    }

    /**
     * ADMIN: Reject certificate
     */
    public function reject(Certificate $certificate)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $certificate->delete();

        return back()->with('success', 'Certificate request rejected.');
    }

    /**
     * Public certificate verification
     */
    public function verify($certificateNumber)
    {
        $certificate = Certificate::where('certificate_number', $certificateNumber)
            ->with(['user', 'course'])
            ->first();

        if (!$certificate || !$certificate->is_verified) {
            return view('certificate.verify', [
                'verified' => false,
                'message' => 'Certificate not found or not verified.'
            ]);
        }

        return view('certificate.verify', [
            'verified' => true,
            'certificate' => $certificate
        ]);
    }
}
