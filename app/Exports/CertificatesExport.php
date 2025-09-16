<?php
namespace App\Exports;

use App\Models\Certificate;
use Maatwebsite\Excel\Concerns\FromCollection;

class CertificatesExport implements FromCollection
{
    public function collection()
    {
        return Certificate::with('user', 'quiz')->get();
    }

    //
    public function headings(): array
    {
        return [
            'ID',
            'User Name',
            'Quiz Title',
            'Score',
            'Percentage',
            'Issued At',
            'File Path',
        ];
    }

    public function map($certificate): array
    {
        return [
            $certificate->id,
            $certificate->user->name ?? 'N/A',
            $certificate->quiz->title ?? 'N/A',
            $certificate->attempt->score ?? '0',
            $certificate->attempt->percentage ?? '0%',
            $certificate->issued_at ? $certificate->issued_at->format('d M Y') : 'N/A',
            $certificate->file_path,
        ];
    }
}
