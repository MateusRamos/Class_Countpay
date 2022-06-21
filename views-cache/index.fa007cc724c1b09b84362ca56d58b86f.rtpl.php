<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Inicio do Conteúdo da Pagina -->
<main id="main" class="main">

    <!-- Inicio Título da Pagina -->
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
    <!-- Fim Título da Pagina -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Inicio Receita -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Receita </br> <span>Este mês</span></h5>

                                <div class="d-flex align-items-center">
                                    <a href="lancamentos_receita.html">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bx bx-plus"></i>
                                        </div>
                                    </a>
                                    <div class="ps-3">
                                        <h6>+R$1.450,00</h6>
                                        <span class="text-muted small pt-2 ps-1">Entrada atual</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Fim Receita -->

                    <!-- Inicio Despesa -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">

                            <div class="card-body">
                                <h5 class="card-title">Despesa </br> <span>Este mês</span></h5>

                                <div class="d-flex align-items-center">
                                    <a href="lancamento_despesa.html">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bx bx-minus"></i>
                                        </div>
                                    </a>
                                    <div class="ps-3">
                                        <h6>-R$1.450,00</h6>
                                        <span class="text-muted small pt-2 ps-1">Saída atual</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Fim Despesa -->

                    <!-- Inicio Transferência -->
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card customers-card">

                            <div class="card-body">
                                <h5 class="card-title">Transferência</br><span>Este mês</span></h5>

                                <div class="d-flex align-items-center">
                                    <a href="#">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bx bx-transfer" style="color: #0AA8D0;"></i>
                                        </div>
                                    </a>
                                    <div class="ps-3">
                                        <h6>R$10.450,00</h6>
                                        <span class="text-muted small pt-2 ps-1">Valor transferido</span>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- Fim Transferência -->

                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <h5 class="card-title">Reports <span>/Today</span></h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [{
                                                name: 'Sales',
                                                data: [31, 40, 28, 51, 42, 82, 56],
                                            }, {
                                                name: 'Revenue',
                                                data: [11, 32, 45, 32, 34, 52, 41]
                                            }, {
                                                name: 'Customers',
                                                data: [15, 11, 32, 18, 9, 24, 11]
                                            }],
                                            chart: {
                                                height: 350,
                                                type: 'area',
                                                toolbar: {
                                                    show: false
                                                },
                                            },
                                            markers: {
                                                size: 4
                                            },
                                            colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                            fill: {
                                                type: "gradient",
                                                gradient: {
                                                    shadeIntensity: 1,
                                                    opacityFrom: 0.3,
                                                    opacityTo: 0.4,
                                                    stops: [0, 90, 100]
                                                }
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                curve: 'smooth',
                                                width: 2
                                            },
                                            xaxis: {
                                                type: 'datetime',
                                                categories: ["2018-09-19T00:00:00.000Z",
                                                    "2018-09-19T01:30:00.000Z",
                                                    "2018-09-19T02:30:00.000Z",
                                                    "2018-09-19T03:30:00.000Z",
                                                    "2018-09-19T04:30:00.000Z",
                                                    "2018-09-19T05:30:00.000Z",
                                                    "2018-09-19T06:30:00.000Z"
                                                ]
                                            },
                                            tooltip: {
                                                x: {
                                                    format: 'dd/MM/yy HH:mm'
                                                },
                                            }
                                        }).render();
                                    });
                                </script>
                                <!-- End Line Chart -->

                            </div>

                        </div>
                    </div><!-- End Reports -->
                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">

                <!-- Recent Activity -->
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Últimas Transações</h5>

                        <div class="activity">

                            <div class="activity-item d-flex">
                                <div class="activite-label"><?php echo htmlspecialchars( $dados["0"]["tempo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></div>
                                <i class='bi bi-circle-fill activity-badge align-self-start' style='color: <?php echo htmlspecialchars( $dados["0"]["cor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>;'></i>
                                <div class="activity-content">
                                    <a href="#" class="link-dark">
                                        <b><?php echo htmlspecialchars( $dados["0"]["tipo_lancamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b> <?php echo htmlspecialchars( $dados["0"]["descricao_lancamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php echo htmlspecialchars( $dados["0"]["valor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                    </a>
                                </div>
                            </div><!-- End activity item-->

                            <div class="activity-item d-flex">
                                <div class="activite-label"><?php echo htmlspecialchars( $dados["1"]["tempo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></div>
                                <i class='bi bi-circle-fill activity-badge align-self-start' style='color: <?php echo htmlspecialchars( $dados["1"]["cor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>;'></i>
                                <div class="activity-content">
                                    <a href="#" class="link-dark">
                                        <b><?php echo htmlspecialchars( $dados["1"]["tipo_lancamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b> <?php echo htmlspecialchars( $dados["1"]["descricao_lancamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php echo htmlspecialchars( $dados["1"]["valor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                    </a>
                                </div>
                            </div><!-- End activity item-->

                            <div class="activity-item d-flex">
                                <div class="activite-label"><?php echo htmlspecialchars( $dados["2"]["tempo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></div>
                                <i class='bi bi-circle-fill activity-badge align-self-start' style='color: <?php echo htmlspecialchars( $dados["2"]["cor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>;'></i>
                                <div class="activity-content">
                                    <a href="#" class="link-dark">
                                        <b><?php echo htmlspecialchars( $dados["2"]["tipo_lancamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b> <?php echo htmlspecialchars( $dados["2"]["descricao_lancamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php echo htmlspecialchars( $dados["2"]["valor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                    </a>
                                </div>
                            </div><!-- End activity item-->

                            <div class="activity-item d-flex">
                                <div class="activite-label"><?php echo htmlspecialchars( $dados["3"]["tempo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></div>
                                <i class='bi bi-circle-fill activity-badge align-self-start' style='color: <?php echo htmlspecialchars( $dados["3"]["cor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>;'></i>
                                <div class="activity-content">
                                    <a href="#" class="link-dark">
                                        <b><?php echo htmlspecialchars( $dados["3"]["tipo_lancamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b> <?php echo htmlspecialchars( $dados["3"]["descricao_lancamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php echo htmlspecialchars( $dados["3"]["valor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                    </a>
                                </div>
                            </div><!-- End activity item-->

                            <div class="activity-item d-flex">
                                <div class="activite-label"><?php echo htmlspecialchars( $dados["4"]["tempo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></div>
                                <i class='bi bi-circle-fill activity-badge align-self-start' style='color: <?php echo htmlspecialchars( $dados["4"]["cor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>;'></i>
                                <div class="activity-content">
                                    <a href="#" class="link-dark">
                                        <b><?php echo htmlspecialchars( $dados["4"]["tipo_lancamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b> <?php echo htmlspecialchars( $dados["4"]["descricao_lancamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php echo htmlspecialchars( $dados["4"]["valor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                    </a>
                                </div>
                            </div><!-- End activity item-->

                            <div class="activity-item d-flex">
                                <div class="activite-label"><?php echo htmlspecialchars( $dados["5"]["tempo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></div>
                                <i class='bi bi-circle-fill activity-badge align-self-start' style='color: <?php echo htmlspecialchars( $dados["5"]["cor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>;'></i>
                                <div class="activity-content">
                                    <a href="#" class="link-dark">
                                        <b><?php echo htmlspecialchars( $dados["5"]["tipo_lancamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b> <?php echo htmlspecialchars( $dados["5"]["descricao_lancamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php echo htmlspecialchars( $dados["5"]["valor"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                    </a>
                                </div>
                            </div><!-- End activity item-->

                        </div>

                    </div>
                </div><!-- End Recent Activity -->




                


            </div>



            
                

        </div>
    </section>

</main><!-- End #main -->