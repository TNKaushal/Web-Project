<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Script to generate the pie chart -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('overviewPieChart').getContext('2d');
        var overviewPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Total Products', 'Total Orders', 'Total Customers'],
                datasets: [{
                    label: 'Overview',
                    data: [<?php echo $totalProducts; ?>, <?php echo $totalOrders; ?>, <?php echo $totalCustomers; ?>],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)', // Light teal
                        'rgba(153, 102, 255, 0.2)', // Light purple
                        'rgba(255, 159, 64, 0.2)'  // Light orange
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)', // Teal
                        'rgba(153, 102, 255, 1)', // Purple
                        'rgba(255, 159, 64, 1)'  // Orange
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                var label = context.label || '';
                                var value = context.raw || 0;
                                return label + ': ' + value;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
