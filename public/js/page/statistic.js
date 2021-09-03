var reportOptions = {
    responsive              : true,
    maintainAspectRatio     : false,
    datasetFill             : false,
    legend: {
        display: false
    },
    tooltips: {
        callbacks: {
            label: function(tooltipItem) {
                return tooltipItem.yLabel;
            }
        }
    }
}

function last12MonthsChart() {
    var datasets = [
        {
            label               : 'Requests',
            backgroundColor     : '#1f5dff',
            pointHighlightFill  : '#fff',
            data                : [],
        },
    ];

    var areaChartData = {
        labels  : dataLast12Months.labels,
        datasets: datasets
    };
    areaChartData.datasets[0].data = dataLast12Months.data[0].data;

    var dataLast12MonthsCanvas = $('#last12MonthsChart').get(0).getContext('2d');

    new Chart(dataLast12MonthsCanvas, {
        type: 'bar',
        data: areaChartData,
        options: reportOptions
    });
}

function last7DaysChart() {
    var datasets = [
        {
            label               : 'Requests',
            backgroundColor     : '#20d387',
            pointHighlightFill  : '#fff',
            data                : [],
        },
    ];

    var areaChartData = {
        labels  : dataLast7Days.labels,
        datasets: datasets
    };
    areaChartData.datasets[0].data = dataLast7Days.data[0].data;

    var dataLast7DaysCanvas = $('#last7DaysChart').get(0).getContext('2d');
    var last7DaysReportData = jQuery.extend(true, {}, areaChartData);
    last7DaysReportData.datasets[0] = areaChartData.datasets[0];

    new Chart(dataLast7DaysCanvas, {
        type: 'bar',
        data: last7DaysReportData,
        options: reportOptions
    });
}

$(function () {
    last12MonthsChart();
    last7DaysChart();
});
