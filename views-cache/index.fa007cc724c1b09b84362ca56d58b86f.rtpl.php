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
                                        <h6>+R$<?php echo htmlspecialchars( $receita["0"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h6>
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
                                        <h6>-R$<?php echo htmlspecialchars( $despesa["0"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h6>
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
                                <h5 class="card-title">Lançamentos Receita x Despesa<span> 2022</span></h5>

                                <div id="columnChart">
                                    <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                            new ApexCharts(document.querySelector("#columnChart"), {
                                                series: [{
                                                    name: 'Receitas',
                                                    data: [<?php echo htmlspecialchars( $grafico["01"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $grafico["02"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $grafico["03"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $grafico["04"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $grafico["05"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $grafico["06"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $grafico["07"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $grafico["08"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $grafico["09"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>,
                                                    <?php echo htmlspecialchars( $grafico["10"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $grafico["11"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $grafico["12"]["receita"], ENT_COMPAT, 'UTF-8', FALSE ); ?>]
                                                }, {
                                                    name: 'Despesas',
                                                    data: [<?php echo htmlspecialchars( $grafico["01"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $grafico["02"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $grafico["03"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $grafico["04"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $grafico["05"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $grafico["06"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $grafico["07"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $grafico["08"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $grafico["09"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>,
                                                    <?php echo htmlspecialchars( $grafico["10"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $grafico["11"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $grafico["12"]["despesa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>]
                                                }, ],
                                                chart: {
                                                    type: 'bar',
                                                    height: 350,
                                                },
                                                plotOptions: {
                                                    bar: {
                                                        horizontal: false,
                                                        columnWidth: '80%',
                                                        endingShape: 'rounded'
                                                    },
                                                },
                                                dataLabels: {
                                                    enabled: true
                                                },
                                                stroke: {
                                                    show: true,
                                                    width: 2,
                                                    colors: ['transparent']
                                                },
                                                xaxis: {
                                                    categories: ['Janeiro', 'Fevereiro', 'Março',
                                                        'Abril',
                                                        'Maio', 'Junho', 'Julho',
                                                        'Agosto',
                                                        'Setembro', 'Outubro', 'Novembro',
                                                        'Dezembro'
                                                    ],
                                                },
                                                yaxis: {
                                                    title: {
                                                        text: 'R$ (reais)'
                                                    }
                                                },
                                                dataLabels: {
                                                    style: {
                                                        colors: ['#FFFFFF']
                                                    }
                                                },
                                                fill: {
                                                    opacity: 1
                                                },
                                                tooltip: {
                                                    y: {
                                                        formatter: function (val) {
                                                            return "R$ " + val + " reais"
                                                        }
                                                    }
                                                },
                                                colors: ['#26A234', '#E54640']
                                            }).render();
                                        });
                                    </script>
                                </div>

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