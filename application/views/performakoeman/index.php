<br>
<div class="content container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Performa Ronald Koeman</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Performa Ronald Koeman</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Grafik</h5>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <canvas id="myChart" style="height: 500px; width: 100%;"></canvas>
                                </div>
                                <script type="text/javascript">
                                    const labels = [
                                        'Positif',
                                        'Negatif',
                                    ];

                                    const data = {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Hasil Sentimen',
                                            backgroundColor: [
                                                'rgba(255, 99, 132, 0.7)',
                                                'rgba(255, 159, 64, 0.7)',
                                            ],
                                            borderColor: [
                                                'rgb(255, 99, 132)',
                                                'rgb(255, 159, 64)',
                                            ],
                                            data: [<?php echo $sentimen_positif; ?>, <?php echo $sentimen_negatif; ?>],
                                        }]
                                    };

                                    const config = {
                                        type: 'bar',
                                        data: data,
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    };
                                    var myChart = new Chart(
                                        document.getElementById('myChart'),
                                        config
                                    );
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>