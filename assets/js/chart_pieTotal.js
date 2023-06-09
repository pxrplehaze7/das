const data2 = {
  labels: [
    'Al Día',
    'Pendiente'

  ],
  datasets: [{
    label: 'My First Dataset',
    data: [ 50, 100],
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)'
    ],
    hoverOffset: 4
  }]
};

const config2 = {
  type: 'pie',
  data: data2,
  options: {
    plugins: {
      legend: {
        position: 'bottom',
      },
      tooltip: {
        callbacks: {
          label: (context) => {
            const label = context.label || '';
            const value = context.raw || '';
            const percentage = ((context.parsed / context.dataset.data.reduce((a, b) => a + b)) * 100).toFixed(2);
            return `${label}: ${value} (${percentage}%)`;
          }
        }
      }
    }
  }
};

const ctx2 = document.getElementById('myChart').getContext('2d');
const myPieChart = new Chart(ctx2, config2);
