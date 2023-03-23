<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/4c68d22cde.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('/dmj/style.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<style>
    .info-box {
        border-bottom-left-radius: 2rem !important;
        border-top-right-radius: 2rem !important;
        border-bottom-right-radius: 1rem !important;
        border-top-left-radius: 1rem !important;
    }

    .card-body i:hover {
        font-size: 2.4rem !important;
        transition: 0.5s;
        cursor: pointer !important;
    }

    .info-box-number {
        font-size: 0.8rem !important;
    }

    th {
        text-align: center !important;
    }

    .card,
    .card-header,
    .card-body {
        border-radius: 1rem !important;
    }

    X #container {
        height: 450px;
    }

    @media (min-width: 768px) {
        .col-md-2 {
            flex: 0 0 auto;
            width: 13%;
        }
    }

    @media only screen and (max-width: 600px) {
        #kolom__jcust {
            width: 120
        }

        /* .info-box{
            width: 12.5rem;
            font-size: 12px;
        } */
    }

    /* i{
        color: #3cd2a5 !important;
    } */
    #analytics-cards-dmj {
        background-color: #1e2936;
        color: white;
        min-height: 120vh !important;
    }

    #rincicardsaleslog {
        background-color: #1e2936;
        color: white;
    }

    #highcharts-data-table-2 {
        width: 35em !important;
    }


    #highcharts-data-table-2,
    tbody,
    td,
    tfoot,
    th,
    thead,
    tr {
        text-align: center;
    }

    body {
        background-color: #1e2936;
    }

    .nav-link,
    .navbar-brand {
        color: white !important;
    }

    .bg-light,
    .bg-light>a {
        color: #75bd3f !important;
    }

    .dropdown-item {
        color: white !important;
    }

    .dropdown-item:hover {
        color: rgb(0, 0, 0) !important;
        background: wheat !important;
    }

    .nav-link:hover {
        color: wheat !important;
    }

    .info-box {

        background: #98b4d7cf !important;
    }
</style>

<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="1800; url=/dashboard_IKA">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <title>DMJ DASHBOARD - 2022</title>
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light px-5"
    style="background-color: #324c5c !important; border: 0.2px rgba(255, 255, 255, 0.425);
border-style: solid; color:aliceblue !important;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
        aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand text-white" href="#">
        <b> INDOKARYA </b>
    </a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Company
                </a>
                <ul class="dropdown-menu"
                    style="background-color: #233945; border: 1px #75bd3f; color: white; border-style: solid;">
                    <li><a class="dropdown-item" href="{{route('DMJBTA')}}">DMJ Batu Raja</a></li>
                    <li><a class="dropdown-item" href="{{ route('DMJS')}}">DMJ Palembang</a></li>
                    <li><a class="dropdown-item" href="{{ route('IKA')}}">IKA Palembang</a></li>
                    <li><a class="dropdown-item" href="{{ route('IKABDG')}}">IKA Bandung</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('IKA') }}">IKA All</a></li>
                    <li><a class="dropdown-item" href="{{ route('DMJS') }}">DMJ ALL</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
        </ul>
        {{-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> --}}
    </div>
</nav>
<div class="wrapper">
    <div class="content">
        <section id="analytics-cards-dmj">
            <div class="dashboard px-3 pt-3">
                {{-- <center class="pb-2">
                    <h5>DASHBOARD DISTRINDO MULTIJAYA</h5> <br>
                </center> --}}
                <div class="row">
                    <div class="col-md">
                        <div class="card"
                            style="background-color: #324c5c !important; border: 0.2px rgba(255, 255, 255, 0.425);
                    border-style: solid;">
                            <div class="card-header"
                                style="background-color: #2e5266 !important; border: 0.2px rgba(255, 255, 255, 0.329);">
                                <h3 class="card-title">INFORMASI MONTHLY </h3>
                                {{-- <a href="" class="btn btn-ouTline-info" data-bs-target="#modallog" data-bs-toggle="modal">FILTER</a> --}}
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-bs-target="#modalfilter"
                                        data-bs-toggle="modal">
                                        <i style="color: rgb(255, 255, 255) !important;" class="fa-solid fa-filter"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                        <i class="fas fa-expand" style="color: rgb(255, 255, 255) !important;"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i style="color: rgb(255, 255, 255) !important;" class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body" style="background-color: #243b47 !important;">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="info-box shadow-lg"
                                            style="background-color: #29404d !important; border: 0.2px rgba(255, 255, 255, 0.329);
                                    border-style: solid;">
                                            <span class="info-box-icon" style="background: transparent !important;">
                                                <a href="#">
                                                    <i class="fa-solid fa-hand-holding-dollar"
                                                        style="color: #75bd3f !important;"></i>
                                                </a>
                                            </span>
                                            <div class="info-box-content">
                                                <?php

                                                setlocale(LC_TIME, 'id_ID.utf8');
                                                $hariIni = new DateTime();
                                                $curent_bln = strftime('%B %Y');

                                                ?>
                                                <span class="info-box-text">Faktur Penjualan </span>
                                                <hr style="padding: 0 !important; margin: 0 !important;">
                                                <span class="info-box-number"> Tatal {{ $penjaualndb22 }} Faktur
                                                    Jual</span>
                                                <span class="info-box-number">
                                                    Penjualan Rp
                                                    {{ number_format($sumpenjualandb22, 0, '.' . '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="info-box shadow-lg"
                                            style="background-color: #29404d !important; border: 0.2px rgba(255, 255, 255, 0.329);
                                    border-style: solid;">
                                            <span class="info-box-icon" style="background: transparent !important;">
                                                <a href="#">
                                                    <i class="fa-solid fa-right-left"
                                                        style="color: #75bd3f !important;"></i>
                                                </a>
                                            </span>
                                            <div class="info-box-content">
                                                <?php

                                                setlocale(LC_TIME, 'id_ID.utf8');
                                                $hariIni = new DateTime();
                                                $curent_bln = strftime('%B %Y');

                                                ?>
                                                <span class="info-box-text">Retur Penjualan </span>
                                                <hr style="padding: 0 !important; margin: 0 !important;">
                                                <span class="info-box-number"> Tatal {{ $countreturgeneral }} Retur
                                                    Jual
                                                </span>
                                                <span class="info-box-number">
                                                    Nilai Retur Rp {{ number_format($sumstretur, 0, '.' . '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="info-box shadow-lg"
                                            style="background-color: #29404d !important; border: 0.2px rgba(255, 255, 255, 0.329);
                                    border-style: solid;">
                                            <span class="info-box-icon" style="background: transparent !important;">
                                                <a href="#">
                                                    <i class="fa-solid fa-money-bill-trend-up"
                                                        style="color: #75bd3f !important;"></i>
                                                </a>
                                            </span>
                                            <div class="info-box-content">
                                                <?php

                                                setlocale(LC_TIME, 'id_ID.utf8');
                                                $hariIni = new DateTime();
                                                $curent_bln = strftime('%B %Y');

                                                ?>
                                                <span class="info-box-text">Piutang </span>
                                                <hr style="padding: 0 !important; margin: 0 !important;">
                                                <span class="info-box-number"> Tatal {{ $countspiutang }} Faktur
                                                    Piutang
                                                </span>
                                                <span class="info-box-number">
                                                    Nilai Piutang Rp
                                                    {{ number_format($sumspiutang, 0, '.' . '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="info-box shadow-lg"
                                            style="background-color: #29404d !important; border: 0.2px rgba(255, 255, 255, 0.329);
                                    border-style: solid;">
                                            <span class="info-box-icon" style="background: transparent !important;">
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">
                                                    <i class="fa-brands fa-cc-mastercard"
                                                        style="color: #75bd3f !important;"></i>
                                                </a>
                                            </span>
                                            <div class="info-box-content">
                                                <?php

                                                setlocale(LC_TIME, 'id_ID.utf8');
                                                $hariIni = new DateTime();
                                                $curent_bln = strftime('%B %Y');

                                                ?>
                                                <span class="info-box-text">Hutang </span>
                                                <hr style="padding: 0 !important; margin: 0 !important;">
                                                <span class="info-box-number"> Tatal {{ $countshutang }} Faktur Hutang
                                                </span>
                                                <span class="info-box-number">
                                                    Nilai Hutang Rp
                                                    {{ number_format($sumshutang, 0, '.' . '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="mt-4">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-8">
                        <div class="card" style="height: 775px; background-color: #29404d !important;">
                            <div class="card-header" style="background-color: #2e5266 !important;">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    Perfomance
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#sales-sum" data-toggle="tab">
                                                <b>Monthly Salesman</b></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="#sales-call" data-toggle="tab"> <b> Call
                                                    Daily </b>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#revenue-chart" data-toggle="tab">
                                                <b>Monthly Sales Out</b></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#sales-chart" data-toggle="tab"> <b> TimeLog
                                                    Salesman</b>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <div class="chart tab-pane active" id="sales-sum"
                                        style="position: relative;height: 556px;">
                                        <div class="card card-secondary">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-sm-9">
                                                        <h3 class="card-title">Sales Out Salesman</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div id="containersumika"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chart tab-pane" id="sales-call"
                                        style="position: relative;height: 675px;">
                                        <div class="card card-secondary">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-sm-9">
                                                        <h3 class="card-title">Effective Call</h3>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button data-bs-target="#rincicardsaleslog"
                                                            data-bs-toggle="modal"
                                                            class="btn btn-outline-info float-right m-2 top-1"
                                                            style="
                                                        padding-top: 3;
                                                        padding-bottom: 3;">Detail
                                                            Log</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body" style="color: rgb(157, 161, 172); text-align:center">
                                                <h3 class="mt-3">EMPTY DATA!!</h3>
                                                <div id="containercall" style="overflow: hidden; padding-top: 3em;">
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="chart tab-pane" id="revenue-chart"
                                        style="position: relative; height: 600px;">
                                        <div id="containercolumnika"></div>
                                    </div>
                                    <div class="chart tab-pane" id="sales-chart"
                                        style="position: relative;height: 556px;">
                                        <div class="card card-secondary">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-sm-9">
                                                        <h3 class="card-title">Time Management Daily</h3>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button data-bs-target="#modallog" data-bs-toggle="modal"
                                                            class="btn btn-outline-info float-right m-2 top-1"
                                                            style="
                                                        padding-top: 3;
                                                        padding-bottom: 3;">Analys
                                                            Log</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body" style="color: rgb(157, 161, 172); text-align:center">
                                                <h3 class="mt-3">EMPTY DATA!!</h3>
                                                <div id="containerareaspline"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box mb-3 bg-white">
                            <span class="info-box-icon text-purple"><i class="fa-solid fa-warehouse"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Warehouse Balance</span>
                                <span class="info-box-number">
                                    Rp {{ number_format($totalsaldostok, 0, '.' . '.') }}
                                </span>
                            </div>

                        </div>

                        <div class="info-box mb-3 bg-white">
                            <span class="info-box-icon text-warning"><i class="fa-solid fa-arrows-rotate"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Monthly Retur Pembelian</span>
                                <span class="info-box-number">
                                    Rp {{ number_format($sumreturbeli, 0, '.' . '.') }}
                                </span>
                            </div>
                        </div>

                        <div class="info-box mb-3 bg-white">
                            <span class="info-box-icon text-info"><i class="fas fa-cloud-download-alt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total SO Daily</span>
                                <span class="info-box-number" style="font-size: 1.3rem">
                                    Rp {{ number_format($sumsodaily, 0, '.' . '.') }}
                                </span>
                            </div>

                        </div>

                        <div class="info-box mb-3 bg-white">
                            <span class="info-box-icon text-red"><i class="fa-solid fa-circle-xmark"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Monthly Faktur Batal</span>
                                <span class="info-box-number">
                                    Rp {{ number_format($fakturbatal, 0, '.' . '.') }}
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script> --}}
{{-- <script src="{{ asset('/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
</script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/plugins/chart.js/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js"></script>

<script>
    const salessumIKA = {!! json_encode($sumsalesmanika) !!}
    const salesoutIKA = {!! json_encode($salesoutsalesmanika) !!}
    console.log(salessumIKA);

    Highcharts.chart('containersumika', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'SALES OUT SALESMAN MONTHLY',
            align: 'center'
        },
        subtitle: {
            text: 'DMJ Source Code - 2022',
            align: 'center'
        },
        xAxis: {
            categories: salessumIKA
        },
        yAxis: {
            allowDecimals: false,
            min: 0,
            labels: {
                format: 'Rp {value}',
                style: {
                    color: Highcharts.getOptions().colors[3]
                }
            },
            title: {
                text: 'Sales Out Salesman',
                style: {
                    color: Highcharts.getOptions().colors[3]
                }
            }
        },
        series: [{
            name: 'Sales Out Salesman',
            data: salesoutIKA,
            zones: [{
                    value: 150000000,
                    color: '#f1014a'
                }, {
                    value: 250000000,
                    color: '#ff8f1c'
                }, {
                    color: '#7ccc6c'
                }]
        }]
    });
</script>

<script>
    const monthika = {!! json_encode($bulanika) !!}
    const pencapaianika = {!! json_encode($nilaiika) !!}
    Highcharts.chart('containercolumnika', {
        title: {
            text: 'Sales of Performance Monthly',
            align: 'center'
        },
        subtitle: {
            text: 'DMJ Source Code - 2022',
            align: 'center'
        },
        xAxis: {
            categories: monthika
        },
        yAxis: {
            allowDecimals: false,
            min: 0,
            labels: {
                format: 'Rp {value}',
                style: {
                    color: Highcharts.getOptions().colors[3]
                }
            },
            title: {
                text: 'Pencapaian',
                style: {
                    color: Highcharts.getOptions().colors[3]
                }
            }
        },
        series: [{
            type: 'column',
            name: 'Pencapaian',
            data: pencapaianika
        }]
    });
</script>

