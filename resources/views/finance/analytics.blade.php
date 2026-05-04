@extends('layouts.app')

@section('content')
<div class="card">
    <h2>{{ __('app.analytics') }}</h2>
    <p>{{ __('app.analytics_desc') }}</p>
</div>

<div class="row charts">
    <div class="chartBox">
        <h2>{{ __('app.bar_chart') }}</h2>
        <canvas id="analyticsBar"></canvas>
    </div>

    <div class="chartBox">
        <h2>{{ __('app.pie_chart') }}</h2>
        <canvas id="analyticsPie"></canvas>
    </div>

    <div class="chartBox">
        <h2>{{ __('app.polar_chart') }}</h2>
        <canvas id="analyticsPolar"></canvas>
    </div>

    <div class="chartBox">
        <h2>{{ __('app.line_chart') }}</h2>
        <canvas id="analyticsLine"></canvas>
    </div>
</div>
@endsection

@section('scripts')
<style>
    .row { display: flex; gap: 20px; flex-wrap: wrap; }
    .chartBox { border: 1px solid #ccc; padding: 12px; width: 48%; min-width: 320px; background: #fff; }
    canvas { width: 100% !important; height: 260px !important; }
</style>

<script>
window.addEventListener("load", () => {
    const labels = ["Jan", "Feb", "Mar", "Apr", "May"];
    const data = [120, 190, 150, 220, 260];

    new Chart(document.getElementById("analyticsBar"), {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{ label: "{{ __('app.expenses') }}", data: data }]
        }
    });

    new Chart(document.getElementById("analyticsPie"), {
        type: "pie",
        data: {
            labels: [
                "{{ __('app.food') }}",
                "{{ __('app.bills') }}",
                "{{ __('app.shopping') }}",
                "{{ __('app.other') }}"
            ],
            datasets: [{ data: [35, 25, 20, 20] }]
        }
    });

    new Chart(document.getElementById("analyticsPolar"), {
        type: "polarArea",
        data: {
            labels: ["Netflix", "{{ __('app.internet') }}", "{{ __('app.gym') }}", "Spotify"],
            datasets: [{ data: [15, 25, 20, 10] }]
        }
    });

    new Chart(document.getElementById("analyticsLine"), {
        type: "line",
        data: {
            labels: labels,
            datasets: [{
                label: "{{ __('app.savings') }}",
                data: [50, 80, 120, 170, 240],
                tension: 0.3,
                fill: false
            }]
        }
    });
});
</script>
@endsection