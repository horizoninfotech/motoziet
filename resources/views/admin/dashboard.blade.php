@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <!-- Number of Services -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $servicesCount }}</h3>
                    <p>Number of Services</p>
                </div>
                <div class="icon">
                    <i class="fas fa-concierge-bell"></i>
                </div>
                <a href="{{ route('admin.services.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- Number of Users -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $usersCount }}</h3>
                    <p>Number of Users</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>                   
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
                
            </div>
        </div>

        <!-- Number of Companies -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $companiesCount }}</h3>
                    <p>Number of Companies</p>
                </div>
                <div class="icon">
                    <i class="fas fa-building"></i>
                </div>
                <a href="{{ route('admin.companies.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- Number of Countries -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $countriesCount }}</h3>
                    <p>Number of Countries</p>
                </div>
                <div class="icon">
                    <i class="fas fa-globe"></i>
                </div>
                <a href="{{ route('admin.companies.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Services Chart -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Number of Services</h3>
                </div>
                <div class="card-body">
                    <canvas id="servicesChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Users Chart -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Number of Users</h3>
                </div>
                <div class="card-body">
                    <canvas id="usersChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Companies Chart -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Number of Companies</h3>
                </div>
                <div class="card-body">
                    <canvas id="companiesChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function () {
            // Services Chart
            var servicesCount = {{ $servicesCount }};
            var usersCount = {{ $usersCount }};
            var companiesCount = {{ $companiesCount }};

            var servicesCtx = document.getElementById('servicesChart').getContext('2d');
            var servicesChart = new Chart(servicesCtx, {
                type: 'bar',
                data: {
                    labels: ['Services'],
                    datasets: [{
                        label: 'Number of Services',
                        data: [servicesCount],
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Users Chart
            var usersCtx = document.getElementById('usersChart').getContext('2d');
            var usersChart = new Chart(usersCtx, {
                type: 'bar',
                data: {
                    labels: ['Users'],
                    datasets: [{
                        label: 'Number of Users',
                        data: [usersCount],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Companies Chart
            var companiesCtx = document.getElementById('companiesChart').getContext('2d');
            var companiesChart = new Chart(companiesCtx, {
                type: 'bar',
                data: {
                    labels: ['Companies'],
                    datasets: [{
                        label: 'Number of Companies',
                        data: [companiesCount],
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@stop
