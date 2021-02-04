

<div class="col-md-8 col-lg-9">
    <hr>
        <h3 class="card-title text-center">Currencies charts</h3>
    <hr>
    <canvas id="bar-chart-horizontal" width="800" height="1750"></canvas>
</div>

<script>
new Chart(document.getElementById("bar-chart-horizontal"), {
    type: 'horizontalBar',
    data: {
      labels: [<?=$labels?>],
      datasets: [
        {
          label: "currency value",
          backgroundColor: getRandomColor(),
          data: [<?=$values?>]
        }
      ]
    },
    options: {
        scales: {
        xAxes:[{
            ticks: {
                min:0,
                max:100
            }
        }   ],
        },
       responsive: true,
      legend: { display: false },
      title: {
        display: true,
        text: 'Currencies with values under 100$ by Openexchangerates'
      }
    }
});

function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
</script>