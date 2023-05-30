
const pieData = {
    labels: ['Pendiente', 'Al día'],
    datasets: [{
        label: 'My First Dataset',
        data: [50, 100],
        backgroundColor: [
            '#ffcd56',
            '#00c4a0'
        ],
        hoverOffset: 4
    }]
};

const pieConfig = {
    type: 'pie',
    data: pieData,
    options: {
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    pointStyle: 'circle',
                    usePointStyle: true
                }
            }
        }
    }
};

// Crear el gráfico
var pieChart = new Chart(document.getElementById('myChart'), pieConfig);
