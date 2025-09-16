@extends('layouts.main')

@section('content')
<div class="container py-4">
    <div class="card shadow border-0 rounded-3">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="bi bi-list-check"></i> Options for Question: 
                <span class="fw-bold">{{ $question->question_text }}</span>
            </h5>
        </div>
        <div class="card-body">

            <!-- Add Button -->
            <div class="mb-3 text-end">
                <a href="{{ route('admin.options.create', $question->id) }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Add Option
                </a>
            </div>

            <!-- Table -->
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Option</th>
                        <th class="text-center">Correct?</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($options as $option)
                        <tr>
                            <td>{{ $option->option_text }}</td>
                            <td class="text-center">
                                @if($option->is_correct)
                                    <span class="badge bg-success"><i class="bi bi-check-circle"></i> Yes</span>
                                @else
                                    <span class="badge bg-danger"><i class="bi bi-x-circle"></i> No</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.options.edit', [$question->id, $option->id]) }}" 
                                   class="btn btn-sm btn-warning me-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.options.destroy', [$question->id, $option->id]) }}" 
                                      method="POST" class="d-inline delete-form">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No options yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "This option will be deleted permanently!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endsection
