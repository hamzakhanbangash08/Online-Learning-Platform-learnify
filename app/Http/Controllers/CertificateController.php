<?php
namespace App\Http\Controllers;

use App\Exports\CertificatesExport;
use App\Models\Certificate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CertificateController extends Controller
{
    //
    // public function index()
    // {
    // //   all certificate show on dashboard
    //     $certificates = Certificate::with('quiz')
    //         ->orderBy('issued_at', 'desc')
    //         ->get();

    //     return view('certificates.index', compact('certificates'));
    // }

    public function index(Request $request)
    {
        $query = Certificate::with(['user', 'quiz.course']);

        // 🔍 Filters
        if ($request->filled('user')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user . '%');
            });
        }

        if ($request->filled('quiz')) {
            $query->whereHas('quiz', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->quiz . '%');
            });
        }

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('issued_at', [$request->from, $request->to]);
        }

        $certificates = $query->latest()->paginate(15);

        return view('certificates.index', compact('certificates'));
    }

    public function exportExcel()
    {
        return Excel::download(new CertificatesExport, 'all_certificates.xlsx');
    }

    public function exportCsv()
    {
        return Excel::download(new CertificatesExport, 'all_certificates.csv');
    }

    public function exportPdf()
    {
        $certificates = Certificate::with(['user', 'quiz.course'])->latest()->get();
        $pdf          = Pdf::loadView('exports.certificates-admin-pdf', compact('certificates'));
        return $pdf->download('all_certificates.pdf');
    }

    public function download(Certificate $certificate)
    {
        // security: sirf apne certificate download kar paaye
        if ($certificate->user_id !== Auth::id()) {
            abort(403);
        }

        $path = public_path($certificate->file_path);

        if (! file_exists($path)) {
            return back()->with('error', 'Certificate not found.');
        }

        return response()->download($path, 'certificate.pdf');
    }


   public function verify($token)
    {
        $certificate = Certificate::with(['user', 'quiz','attempt'])
            ->where('token', $token)
            ->first();

        // Pass certificate (or null if not found) to view
        return view('certificates.verify', compact('certificate'));
    }
}