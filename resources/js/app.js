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
                label: 'Remitted Payment',
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
                    label: 'Remitted Payment',
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
    


    
    // const semesterData = {
    //     "First Semester": {
    //       "CCS Fee": 150,
    //       "Palaro Fee": 50,
    //       "Total": 200
    //     },
    //     "Second Semester": {
    //       "CSB Fee": 200,
    //       "CAT Fee": 100,
    //       "Total": 300
    //     },
    //   };
      
    //   const schoolYearData = {
    //     "2023-2024": {
    //       "First Semester": 1,
    //       "Second Semester": 2,
    //     },
    //   };    

    //   document.addEventListener('DOMContentLoaded', function () {
    //     console.log('Initializing Chart.js');
    //     var ctx = document.getElementById('myChart3').getContext('2d');
    //     console.log('Canvas Element:', ctx);
    
    //     const schoolYearLabels = Object.keys(schoolYearData);
    //     const combinedLabels = schoolYearLabels.reduce((acc, schoolYear) => {
    //         const semesterNames = Object.keys(schoolYearData[schoolYear]);
    //         return acc.concat(semesterNames.map(semester => `${schoolYear} - ${semester}`));
    //     }, []);
    
    //     const combinedFees = schoolYearLabels.reduce((acc, schoolYear) => {
    //         const semesterNames = Object.keys(schoolYearData[schoolYear]);
    //         const semesterFees = semesterNames.map(semester => semesterData[semester]);
    //         return acc.concat(semesterFees.map(semester => semester.Total));
    //     }, []);
    
    //     var myChart = new Chart(ctx, {
    //         type: 'doughnut',
    //         data: {
    //             labels: combinedLabels,
    //             datasets: [{
    //                 label: 'Collected Payment',
    //                 data: combinedFees,
    //                 backgroundColor: [
    //                     'rgba(255, 99, 132, 0.2)',
    //                     'rgba(54, 162, 235, 0.2)',
    //                     'rgba(255, 206, 86, 0.2)',
    //                     'rgba(75, 192, 192, 0.2)',
    //                     'rgba(153, 102, 255, 0.2)',
    //                     'rgba(255, 159, 64, 0.2)'
    //                 ],
    //                 borderColor: [
    //                     'rgba(255, 99, 132, 1)',
    //                     'rgba(54, 162, 235, 1)',
    //                     'rgba(255, 206, 86, 1)',
    //                     'rgba(75, 192, 192, 1)',
    //                     'rgba(153, 102, 255, 1)',
    //                     'rgba(255, 159, 64, 1)'
    //                 ],
    //                 borderWidth: 2
    //             }]
    //         },
    //         options: {
    //             responsive: true
    //         }
    //     });
    // });
    