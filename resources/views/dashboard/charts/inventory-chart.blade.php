<canvas id="inventoryChart" height="200"></canvas>
<script>
$(document).ready(function() {
    var ctx = document.getElementById('inventoryChart').getContext('2d');
    var inventoryChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['In Stock', 'Low Stock', 'Out of Stock', 'Damaged'],
            datasets: [{
                data: [1560, 85, 24, 12],
                backgroundColor: [
                    'rgba(40, 167, 69, 0.8)',
                    'rgba(255, 193, 7, 0.8)',
                    'rgba(220, 53, 69, 0.8)',
                    'rgba(108, 117, 125, 0.8)'
                ],
                borderColor: [
                    'rgba(40, 167, 69, 1)',
                    'rgba(255, 193, 7, 1)',
                    'rgba(220, 53, 69, 1)',
                    'rgba(108, 117, 125, 1)'
                ],
                borderWidth: 1,
                hoverOffset: 15
            }]
        },
        options: {
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var label = context.label || '';
                            var value = context.raw || 0;
                            var total = context.dataset.data.reduce((a, b) => a + b, 0);
                            var percentage = Math.round((value / total) * 100);
                            return label + ': ' + value + ' items (' + percentage + '%)';
                        }
                    }
                }
            }
        }
    });
});
</script>

<div class="row text-center mt-3">
    <div class="col-6">
        <div class="h4 font-weight-bold">1,681</div>
        <small class="text-muted">Total Items</small>
    </div>
    <div class="col-6">
        <div class="h4 font-weight-bold">Rs 245,800</div>
        <small class="text-muted">Total Value</small>
    </div>
</div>