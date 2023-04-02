<div>
    <div class="row sales layout-top-spacing">
        <div class="col-sm-10 col-md-10 mt-5 add">
            <div class="row">
                <div class="col-sm-12">
                    <div class="widget widget-chart-one">
                        <canvas id="myChart">
                        </canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@once
    @push('scripts')
        <script></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($users) !!},
                    datasets: [{
                        label: `Horas trabajadas y pagadas de {!! json_encode($actual) !!}`,
                        data: {!! json_encode($horas) !!},
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
        </script>
    @endpush
@endonce
<style>

</style>
