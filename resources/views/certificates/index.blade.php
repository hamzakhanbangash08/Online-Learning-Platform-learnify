@extends('layouts.main')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">📊 Certificates Management</h1>

    <!-- 🔍 Filters -->
    <form method="GET" class="mb-6 flex gap-4 flex-wrap">
        <input type="text" name="user" placeholder="Search User"
               value="{{ request('user') }}"
               class="border p-2 rounded">
        <input type="text" name="quiz" placeholder="Search Quiz"
               value="{{ request('quiz') }}"
               class="border p-2 rounded">
        <input type="date" name="from" value="{{ request('from') }}"
               class="border p-2 rounded">
        <input type="date" name="to" value="{{ request('to') }}"
               class="border p-2 rounded">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Filter</button>
    </form>

    <!-- 📥 Export Buttons -->
    <div class="flex gap-3 mb-6">
        <a href="{{ route('admin.certificates.export.excel') }}" class="px-4 py-2 bg-green-600 text-white rounded">⬇️ Excel</a>
        <a href="{{ route('admin.certificates.export.csv') }}" class="px-4 py-2 bg-blue-600 text-white rounded">⬇️ CSV</a>
        <a href="{{ route('admin.certificates.export.pdf') }}" class="px-4 py-2 bg-red-600 text-white rounded">⬇️ PDF</a>
        @if($certificates)
    <a href="{{ route('certificate.verify', $certificates->first()->token) }}" target="_blank"
       class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
       🔗 Verify Certificates
    </a>
@endif
    </div>

    <!-- 📄 Table -->
    <table class="w-full border-collapse bg-white shadow-lg rounded">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3 border">User</th>
                <th class="p-3 border">Quiz</th>
                <th class="p-3 border">Course</th>
                <th class="p-3 border">Issued At</th>
                <th class="p-3 border">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($certificates as $cert)
                <tr>
                    <td class="p-3 border">{{ $cert->user->name }}</td>
                    <td class="p-3 border">{{ $cert->quiz->title }}</td>
                    <td class="p-3 border">{{ $cert->quiz->course->title ?? 'N/A' }}</td>
                    <td class="p-3 border">{{ \Carbon\Carbon::parse($cert->issued_at)->format('d M, Y') }}</td>
                    <td class="p-3 border">
                        <a href="{{ route('certificate.download', $cert->id) }}"
                           class="px-3 py-1 bg-indigo-600 text-white rounded">Download</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-6">
        {{ $certificates->links() }}
    </div>
</div>
@endsection
