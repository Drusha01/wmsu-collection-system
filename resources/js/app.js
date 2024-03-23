    import './bootstrap';
    import 'flowbite';
    import jQuery from 'jquery';
    import Chart from 'chart.js/auto'; 

    window.$ = jQuery;


    document.addEventListener('DOMContentLoaded', function () {
    var ctx1 = document.getElementById('myChart').getContext('2d');
    var myChart1 = new Chart(ctx1, {
        
        type: 'bar',
        data: {
            labels: ['College Of Computing Studies', 'College Of Engineering', 'College Of Nursing', 'College Of Architecture', 'College Of Law', 'College Of Social Work',
            'College Of Criminal Justice'],
            datasets: [{
                label: 'Collected Payment',
                data: [25000, 30000, 35000, 51000, 20000, 32000, 12000, 26000, 15000, 25000, 25000],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,

        }
    });
});



    document.addEventListener('DOMContentLoaded', function () {
        console.log('Initializing Chart.js');
        var ctx = document.getElementById('myChart2').getContext('2d');
        console.log('Canvas Element:', ctx);
                var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['College Of Computing Studies', 'College Of Engineering', 'College Of Nursing', 'College Of Architecture', 'College Of Law', 'College Of Social Work',
                'College Of Criminal Justice'],
                datasets: [{
                    label: 'Collected Payment',
                    data: [25000, 30000, 35000, 51000, 20000, 32000, 12000, 26000, 15000, 25000, 25000],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 2
                }]
            },
                options: {
                responsive: true
            }
        });
    });
    
    document.addEventListener('DOMContentLoaded', function () {
        console.log('Initializing Chart.js');
        var ctx = document.getElementById('myChart3').getContext('2d');
        console.log('Canvas Element:', ctx);
                var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Department Of Computer Science', 'Department Of Information Technology', 'Associate Of Computer Technology'],
                datasets: [{
                    label: 'Collected Payment',
                    data: [25000, 30000, 35000,],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 2
                }]
            },
                options: {
                responsive: true
            }
        });
    });
    

var ctxSchoolYear = document.getElementById('schoolYearRemittedChart').getContext('2d');
var schoolYearRemittedChart = new Chart(ctxSchoolYear, {
    type: 'bar',
    data: {
        labels: ['2023', '2024'], 
        datasets: [{
            label: 'Total Remitted',
            data: [25000, 35000], // 
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 99, 132, 0.2)',
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
            ],
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

// Chart for Semester 1 and 2 Total Remitted
var ctxSemester = document.getElementById('semesterRemittedChart').getContext('2d');
var semesterRemittedChart = new Chart(ctxSemester, {
    type: 'bar',
    data: {
        labels: ['Semester 1', 'Semester 2'],
        datasets: [{
            label: 'Total Remitted',
            data: [15000, 25000], 
            backgroundColor: [
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
            ],
            borderColor: [
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
            ],
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

// Chart for List of Fees and Total Amount Remitted
var ctxFees = document.getElementById('feesRemittedChart').getContext('2d');
var feesRemittedChart = new Chart(ctxFees, {
    type: 'bar',
    data: {
        labels: ['UNIV FEE', 'Other Fee'], 
        datasets: [{
            label: 'Total Amount Remitted',
            data: [21000, 15000], 
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 99, 132, 0.2)',
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
            ],
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

// Chart for Different Colleges Remitted Total
var ctxColleges = document.getElementById('collegesRemittedChart').getContext('2d');
var collegesRemittedChart = new Chart(ctxColleges, {
    type: 'bar',
    data: {
        labels: ['CCS', 'CLA', 'CSM'], 
        datasets: [{
            label: 'Total Amount Remitted',
            data: [10000, 15000, 20000], 
            backgroundColor: [
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
            ],
            borderColor: [
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
            ],
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
