@extends('layouts.Frontend.master')
@section('title')
    QuickCount Pemira 2021
@endsection

@section('content')
    <!-- section one -->
    <section class="one">
        <h4 class="text-center judul">QuickCount</h4>
        <h5 class="text-center text-muted mt-4">Pantauan Hasil Suara Pemira</h5>
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-6 col-12">
                    <canvas id="myChart" width="100px"></canvas>
                </div>
                <div class="col-md-6 col-12">
                    {{-- paslon hayukkk --}}

                    @foreach ($paslon as $calon)
                        <div class="card p-3 bayangan_2 vote_hasil">
                            <div class="d-flex mb-2">
                                <h5 class="font-weight-bold">Paslon #{{ $calon->nomor_urut }}</h5>
                                <button type="button" id="hasil-{{ $calon->id }}" data-paslon="{{ $calon->id }}"
                                    class="btn btn-secondary btn-sm ml-auto"
                                    data-url="{{ route('hasil_vote', $calon->id) }}"><i class="fas fa-sync"></i>
                                    Refresh</button>
                            </div>
                            <div class="progress mt-1">
                                <div class="progress-bar paslon-{{ $calon->id }}" role="progressbar" style="width: 0%;"
                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                            </div>
                            <div>
                                <p class="text-muted"></p>
                            </div>
                        </div>
                    @endforeach

                    {{-- kelar --}}
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js-tambahan')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        let pemilih = {{ $total_pemilih }}
        let suara = {{ $suara_masuk }}
        let golput = {{ $golput }}
        const datasheet = {
            labels: [
                'Total Suara',
                'Suara Masuk',
                'Golput'
            ],
            datasets: [{
                label: 'Realtime Quick Count',
                data: [pemilih, suara, golput],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(75, 192, 192)',
                    'rgb(201, 203, 207)',
                ]
            }]
        };
        const configurasi = {
            type: 'polarArea',
            data: datasheet,
            options: {}
        };
        var myChart = new Chart(
            document.getElementById('myChart'),
            configurasi
        );
        console.log(suara);

    </script>
    @foreach ($paslon as $item)
        <script type="text/javascript">
            $(document).ready(function() {
                $("#hasil-{{ $item->id }}").click(function() {
                    var paslon = $(this).data('paslon');
                    let url = $(this).data('url');
                    $.get(url, function(data) {
                        console.log(data + "%")
                        console.log("paslon ke " + paslon)
                        $(".paslon-" + paslon).css("width", data + "%");
                        $(".paslon-" + paslon).text(data + "%");
                    })
                });
            });

        </script>
    @endforeach
@endsection
