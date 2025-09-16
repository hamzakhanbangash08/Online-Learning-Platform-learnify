@extends('layouts.main')

@push('styles')
<style>
    :root {
        --primary-color: #5A67D8;
        --secondary-color: #6B7280;
        --dark-color: #1A202C;
        --light-color: #F7FAFC;
        --card-bg: #FFFFFF;
        --border-color: #E2E8F0;
        --success-color: #48BB78;
        --info-color: #4299E1;
        --font-family-base: "Inter", sans-serif;
    }

    body {
        font-family: var(--font-family-base);
        background-color: var(--light-color);
        color: var(--dark-color);
    }

    .analytics-dashboard-page .container {
        max-width: 1200px;
    }

    /* Page Header */
    .page-header {
        font-size: 2.25rem;
        font-weight: 700;
        color: var(--dark-color);
        margin-bottom: 2rem;
    }

    /* Card Styling */
    .card-analytics {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .card-header {
        background-color: var(--card-bg);
        border-bottom: 1px solid var(--border-color);
        font-weight: 600;
        font-size: 1.25rem;
        color: var(--dark-color);
        padding: 1.5rem;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
    }

    .card-body {
        padding: 1.5rem;

    }



    /* Table Styling */
    .table {
        margin-bottom: 0;
    }

    .table-bordered th, .table-bordered td {
        border-color: var(--border-color);
        padding: 1rem;
    }

    .table-bordered thead th {
        background-color: #EDF2F7;
        color: var(--secondary-color);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.875rem;
    }

    /* Pass Rate Highlighting */
    .pass-rate-success { color: var(--success-color); font-weight: 600; }
    .pass-rate-info { color: var(--info-color); font-weight: 600; }
    .pass-rate-danger { color: var(--danger-color); font-weight: 600; }

    /* Chart Containers */
    .chart-container {
        padding: 1.5rem;
    }

    @media (max-width: 768px) {
        .chart-container.mb-4 {
            margin-bottom: 2rem;
        }
    }



/* Optional: To make sure the fixed header doesn't scroll with the content */
.table thead {
    position: sticky;
    top: 0;
    background-color: #EDF2F7; /* Match the header background color */
    z-index: 10; /* Ensure it stays on top of the scrolling content */
}

.table tbody{
    display: block;
    max-height: 400px; /* Adjust based on your needs */
    overflow-y: auto;
}
</style>
@endpush

@section('content')
<div class="analytics-dashboard-page py-2">
    <div class="container">
        <h2 class="page-header text-center">📊 Analytics Dashboard</h2>
        <!-- <p class="text-center text-muted mb-5">
            A comprehensive overview of course and quiz performance.
        </p> -->


        {{-- Charts Section --}}
        <!-- <h4 class="mt-5 text-center fw-bold">📈 Visual Analytics</h4> -->
        <div class="row g-4 mb-4 justify-content-center">
            <div class="col-12 col-lg-6 d-flex">
                <div class="card card-analytics w-100">
                    <div class="card-header">Course Pass Rate Chart</div>
                    <div class="card-body d-flex align-items-center justify-content-center chart-container">
                        <canvas id="coursePassChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 d-flex">
                <div class="card card-analytics w-100">
                    <div class="card-header">Overall Quiz Pass/Fail Chart</div>
                    <div class="card-body d-flex align-items-center justify-content-center chart-container" style="height:200px" >
                        <canvas id="quizPassFailChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

         {{-- Course Stats Table --}}
        <div class="row">
           <div class="col-md-6">
  <div class="card card-analytics mb-5">
    <div class="card-header">Course Pass Rates</div>
    <div class="card-body p-0 " style="height: 500px; overflow-y: auto;">
      {{-- This is the new container with the scrollbar --}}
      <div class="table-scroll-container">
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead>
              <tr>
                <th>Course</th>
                <th>Total Attempts</th>
                <th>Passed</th>
                <th>Pass Rate (%)</th>
              </tr>
            </thead>
            <tbody class="">
              @forelse($courseStats as $stat)
              <tr>
                <td>{{ $stat['course'] }}</td>
                <td>{{ $stat['total_attempts'] }}</td>
                <td>{{ $stat['passed'] }}</td>
                <td class="{{ $stat['pass_rate'] > 70 ? 'pass-rate-success' : ($stat['pass_rate'] > 40 ? 'pass-rate-info' : 'pass-rate-danger') }}">
                  {{ $stat['pass_rate'] }}%
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="4" class="text-center text-muted py-4">No course data available.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
            <div class="col-md-6">
                 {{-- Quiz Stats Table --}}
        <div class="card card-analytics mb-5">
            <div class="card-header">Quiz Performance Breakdown</div>
            <div class="card-body p-0" style="height: 500px; overflow-y: auto;">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>Quiz</th>
                                <th>Course</th>
                                <th>Total Attempts</th>
                                <th>Passed</th>
                                <th>Failed</th>
                                <th>Pass Rate (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($quizStats as $stat)
                            <tr>
                                <td>{{ $stat['quiz'] }}</td>
                                <td>{{ $stat['course'] }}</td>
                                <td>{{ $stat['total_attempts'] }}</td>
                                <td>{{ $stat['passed'] }}</td>
                                <td>{{ $stat['failed'] }}</td>
                                <td class="{{ $stat['pass_rate'] > 70 ? 'pass-rate-success' : ($stat['pass_rate'] > 40 ? 'pass-rate-info' : 'pass-rate-danger') }}">
                                    {{ $stat['pass_rate'] }}%
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No quiz data available.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // === Course Pass Rate Bar Chart ===
        const courseCtx = document.getElementById('coursePassChart');
        if (courseCtx) {
            new Chart(courseCtx, {
                type: 'bar',
                data: {
                    labels: @json($courseStats->pluck('course')),
                    datasets: [{
                        label: 'Pass Rate (%)',
                        data: @json($courseStats->pluck('pass_rate')),
                        backgroundColor: 'rgba(90, 103, 216, 0.7)',
                        borderColor: 'rgba(90, 103, 216, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        title: { display: true, text: 'Course Pass Rates' }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            title: { display: true, text: 'Pass Rate (%)' }
                        },
                        x: {
                            title: { display: true, text: 'Course' }
                        }
                    }
                }
            });
        }

        // === Overall Quiz Pass/Fail Pie Chart ===
        const quizCtx = document.getElementById('quizPassFailChart');
        if (quizCtx) {
            new Chart(quizCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Passed', 'Failed'],
                    datasets: [{
                        data: [
                            {{ $quizStats->sum('passed') }},
                            {{ $quizStats->sum('failed') }}
                        ],
                        backgroundColor: ['#48BB78', '#F56565'],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'bottom' },
                        title: { display: true, text: 'Overall Quiz Pass/Fail' }
                    }
                }
            });
        }
    });
</script>
@endsection
