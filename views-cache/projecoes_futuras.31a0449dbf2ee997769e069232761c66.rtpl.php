<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Inicio do Conteúdo da Pagina -->
<main id="main" class="main">

    <!-- Inicio Título da Pagina -->
    <div class="pagetitle">
        <h1>Projeções Futuras</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
                <li class="breadcrumb-item active">Projeções Futuras</li>
            </ol>
        </nav>
    </div>
    <!-- Fim Título da Pagina -->

    <section class="section dashboard">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="min-height: 70vh;">

                        <!-- Gráficos Barra 12 Mêses -->
                        <div class="col-md-12 mt-5">
                            <div id="columnChart">
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#columnChart"), {
                                            series: [{
                                                name: 'Receitas',
                                                data: [80, 55, 57, 56, 61, 58, 63, 60, 66, 50,
                                                    80, 50
                                                ]
                                            }, {
                                                name: 'Despesas',
                                                data: [76, 85, 101, 98, 87, 105, 91, 114, 94,
                                                    80, 100, 98
                                                ]
                                            }, ],
                                            chart: {
                                                type: 'bar',
                                                height: 250,
                                            },
                                            plotOptions: {
                                                bar: {
                                                    horizontal: false,
                                                    columnWidth: '65%',
                                                    endingShape: 'rounded'
                                                },
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                show: true,
                                                width: 2,
                                                colors: ['transparent']
                                            },
                                            xaxis: {
                                                categories: ['Janeiro', 'Fevereiro', 'Março', 'Abril',
                                                    'Maio', 'Junho', 'Julho',
                                                    'Agosto',
                                                    'Setembro', 'Outubro', 'Novembro', 'Dezembro'
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
                                            colors: ['#32CD32', '#DC143C']
                                        }).render();
                                    });
                                </script>
                            </div>
                        </div>

                        <!-- Projeções Futuras -->
                        <div class="col-md-12 mt-3 bg-warning">

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>

</main>
<!-- Final do main -->