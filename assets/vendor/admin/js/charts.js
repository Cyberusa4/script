(function($) {
    "use strict";
    const ctxUsers = $('#vironeer-users-charts'),
        ctxEarnings = $('#vironeer-earnings-charts'),
        ctxUploads = $('#vironeer-uploads-charts');
    const charts = {
        initUsers: function() { this.usersChartsData() },
        initEarnings: function() { this.earningsChartsData() },
        initUploads: function() { this.uploadsChartsData() },
        usersChartsData: function() {
            const dataUrl = BASE_URL + '/dashboard/charts/users';
            const request = $.ajax({
                method: 'GET',
                url: dataUrl
            });
            request.done(function(response) {
                charts.createUsersCharts(response);
            });
        },
        earningsChartsData: function() {
            const dataUrl = BASE_URL + '/dashboard/charts/earnings';
            const request = $.ajax({
                method: 'GET',
                url: dataUrl
            });
            request.done(function(response) {
                charts.createEarningsCharts(response);
            });
        },
        uploadsChartsData: function() {
            const dataUrl = BASE_URL + '/dashboard/charts/uploads';
            const request = $.ajax({
                method: 'GET',
                url: dataUrl
            });
            request.done(function(response) {
                charts.createUploadsCharts(response);
            });
        },
        createUsersCharts: function(response) {
            const max = response.suggestedMax;
            const labels = response.usersChartLabels;
            const data = response.usersChartData;
            window.Chart && (new Chart(ctxUsers, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Users',
                        data: data,
                        fill: true,
                        tension: 0.3,
                        backgroundColor: "#d4e3f9",
                        borderColor: "#0045ad",
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    scales: {
                        y: {
                            suggestedMax: max,
                        }
                    }
                }
            })).render();
        },
        createEarningsCharts: function(response) {
            const max = response.suggestedMax;
            const labels = response.earningsChartLabels;
            const data = response.earningsChartData;
            window.Chart && (new Chart(ctxEarnings, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Earnings',
                        data: data,
                        fill: true,
                        tension: 0.3,
                        backgroundColor: "#e2f3e1",
                        borderColor: "#30b244",
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';

                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += WEBSITE_CURRENCY + context.parsed.y;
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            ticks: {
                                beginAtZero: true,
                                callback: function(value, index, values) {
                                    return value + ' ' + WEBSITE_CURRENCY;
                                }
                            },
                            suggestedMax: max,
                        }
                    },
                }
            })).render();
        },
        createUploadsCharts: function(response) {
            const max = response.suggestedMax;
            const labels = response.uploadsChartLabels;
            const data = response.uploadsChartData;
            window.Chart && (new Chart(ctxUploads, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Uploads',
                        data: data,
                        fill: true,
                        tension: 0.3,
                        backgroundColor: SECONDARY_COLOR,
                        borderColor: SECONDARY_COLOR,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    scales: {
                        y: {
                            suggestedMax: max,
                        }
                    }
                }
            })).render();
        },
    }
    charts.initUsers();
    charts.initUploads();
    if (LICENCE_TYPE == 2) {
        charts.initEarnings();
    }
})(jQuery);