<?php if(!class_exists('Rain\Tpl')){exit;}?>    <!-- Inicio do Conteúdo da Pagina -->
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

        <!-- Inicio Título da Pagina -->
        <section class="section dashboard">

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" style="min-height: 70vh;">
                            <!-- Projeções Futuras -->
                            <div class="col-md-12 mt-3">

                                <div id="body">
                                    <div id="section">

                                        <div class="swiper mySwiper container">
                                            <div class="swiper-wrapper content">

                                                <div class="swiper-slide card bg-light">
                                                    <div class="card-content">
                                                    
                                                        <div class="media-icons">
                                                            <i class="fab fa-facebook"></i>
                                                            <i class="fab fa-twitter"></i>
                                                            <i class="fab fa-github"></i>
                                                        </div>

                                                        <div class="name-profession text-white">
                                                            <span class="name">Janeiro</span>
                                                            <span class="profession">Mês Atual</span>
                                                        </div>

                                                        <div class="rating pt-5">
                                                            <p><b>Receita:</b> R$500<b> </br> Despesa:</b> R$600</p>
                                                        </div>

                                                        <div class="button">
                                                            <button class="aboutMe">Lançamentos</button>
                                                            <button class="hireMe">Metas</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                        <div class="swiper-pagination"></div>

                                    </div>
                                </div>


                            </div>

                            <!-- Gráficos Barra 12 Mêses -->
                            <div class="col-md-12 mt-5">
                                <div id="columnChart">
                                    <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                            new ApexCharts(document.querySelector("#columnChart"), {
                                                series: [{
                                                    name: 'Receitas',
                                                    data: [80, 55, 57, 56, 61, 58, 63, 60, 66,
                                                        50,
                                                        80, 50
                                                    ]
                                                }, {
                                                    name: 'Despesas',
                                                    data: [76, 85, 101, 98, 87, 105, 91, 114,
                                                        94,
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
                                                colors: ['#32CD32', '#DC143C']
                                            }).render();
                                        });
                                    </script>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- Fim Título da Pagina -->

    </main>
    <!-- Final do main -->