<div>
    <canvas id="myChart">

    </canvas>
</div>
@once
@push('scripts')
<script>
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart');

new Chart(ctx, {
  type: 'bar',
  data: {
    labels: {!! json_encode($users) !!},
    datasets: [{
      label:`Horas trabajadas y pagadas de {!! json_encode($actual) !!}`,
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
