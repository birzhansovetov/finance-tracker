@extends('layouts.app')

@section('content')

<h1>{{ __('app.finance_tracker') }}</h1>

<div class="row">
    <div class="box">
        <h2>{{ __('app.dashboard') }}</h2>
        <p>{{ __('app.balance') }}: ₸245 000</p>
        <p>{{ __('app.income') }}: ₸600 000</p>
        <p>{{ __('app.expenses') }}: ₸355 000</p>

        @can('create transactions')
            <a href="{{ route('transactions.add') }}" class="btn">{{ __('app.add_transaction') }}</a>
        @endcan

        @can('delete transactions')
            <button class="btn">{{ __('app.delete_transaction') }}</button>
        @endcan
    </div>

    <div class="box" id="ad">
        <div id="dot"></div>
        <h2>{{ __('app.advertisement') }}</h2>
        <p>{{ __('app.upgrade_pro') }}</p>

        <div class="buttons">
            <button id="b1">hide()</button>
            <button id="b2">show()</button>
            <button id="b3">fadeIn()</button>
            <button id="b4">fadeOut()</button>
            <button id="b5">fadeTo()</button>
            <button id="b6">slideUp()</button>
            <button id="b7">slideDown()</button>
            <button id="b8">animate()</button>
            <button id="b9">stop()</button>
        </div>
    </div>
</div>

<div class="row charts">
    <div class="chartBox">
        <h2>{{ __('app.bar_chart') }}</h2>
        <canvas id="barChart"></canvas>
    </div>

    <div class="chartBox">
        <h2>{{ __('app.pie_chart') }}</h2>
        <canvas id="pieChart"></canvas>
    </div>

    <div class="chartBox">
        <h2>{{ __('app.polar_chart') }}</h2>
        <canvas id="polarChart"></canvas>
    </div>

    <div class="chartBox">
        <h2>{{ __('app.line_chart') }}</h2>
        <canvas id="lineChart"></canvas>
    </div>
</div>

@endsection

@section('scripts')
<style>
    .row { display: flex; gap: 20px; align-items: flex-start; flex-wrap: wrap; }
    .box { border: 1px solid #ccc; padding: 15px; width: 50%; min-width: 320px; background: #fff; }
    #ad { background: #f7fff1; border: 2px dashed #6ab04c; position: relative; }
    #dot { width: 12px; height: 12px; background: #6ab04c; position: absolute; top: 10px; right: 10px; }
    .buttons { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 10px; }
    button { padding: 6px 10px; cursor: pointer; }
    .charts { margin-top: 20px; }
    .chartBox { border: 1px solid #ccc; padding: 12px; width: 50%; min-width: 320px; background: #fff; }
    canvas { width: 100% !important; height: 260px !important; }
</style>

<script>
    $(function () {
        $("#b1").click(() => $("#ad").hide());
        $("#b2").click(() => $("#ad").show());
        $("#b3").click(() => $("#ad").fadeIn());
        $("#b4").click(() => $("#ad").fadeOut());
        $("#b5").click(() => $("#ad").fadeTo(300, 0.3));
        $("#b6").click(() => $("#ad").slideUp());
        $("#b7").click(() => $("#ad").slideDown());
        $("#b8").click(() => {
            $("#dot").animate({ top: "60px" }, 500).animate({ top: "10px" }, 500);
        });
        $("#b9").click(() => {
            $("#ad").stop(true, true);
            $("#dot").stop(true, true);
        });
    });

    window.addEventListener("load", () => {
        const categories = ["Food", "Transport", "Bills", "Shopping", "Other"];
        const expenses = [120000, 45000, 80000, 60000, 50000];

        new Chart(document.getElementById("barChart"), {
            type: "bar",
            data: { labels: categories, datasets: [{ label: "Expenses (₸)", data: expenses }] },
            options: { responsive: true, plugins: { legend: { display: true } } }
        });

        new Chart(document.getElementById("pieChart"), {
            type: "pie",
            data: { labels: categories, datasets: [{ data: expenses }] },
            options: { responsive: true }
        });

        new Chart(document.getElementById("polarChart"), {
            type: "polarArea",
            data: { labels: categories, datasets: [{ data: expenses }] },
            options: { responsive: true }
        });

        new Chart(document.getElementById("lineChart"), {
            type: "line",
            data: {
                labels: ["Week 1", "Week 2", "Week 3", "Week 4"],
                datasets: [{ label: "Balance (₸)", data: [180000, 210000, 195000, 245000], tension: 0.3, fill: false }]
            },
            options: { responsive: true, plugins: { legend: { display: true } } }
        });
    });
</script>
@endsection