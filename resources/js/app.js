    import './bootstrap';
    import 'flowbite';
    import jQuery from 'jquery';

    window.$ = jQuery;


//     document.addEventListener('DOMContentLoaded', function () {
//     var ctx1 = document.getElementById('myChart').getContext('2d');
//     var myChart1 = new Chart(ctx1, {
        
//         type: 'bar',
//         data: {
//             labels: ['College Of Computing Studies', 'College Of Engineering', 'College Of Nursing', 'College Of Architecture', 'College Of Law', 'College Of Social Work',
//             'College Of Criminal Justice'],
//             datasets: [{
//                 label: 'Collected Payment',
//                 data: [25000, 30000, 35000, 51000, 20000, 32000, 12000, 26000, 15000, 25000, 25000],
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
//             responsive: true,

//         }
//     });
// });



//     document.addEventListener('DOMContentLoaded', function () {
//         console.log('Initializing Chart.js');
//         var ctx = document.getElementById('myChart2').getContext('2d');
//         console.log('Canvas Element:', ctx);
//                 var myChart = new Chart(ctx, {
//             type: 'bar',
//             data: {
//                 labels: ['College Of Computing Studies', 'College Of Engineering', 'College Of Nursing', 'College Of Architecture', 'College Of Law', 'College Of Social Work',
//                 'College Of Criminal Justice'],
//                 datasets: [{
//                     label: 'Collected Payment',
//                     data: [25000, 30000, 35000, 51000, 20000, 32000, 12000, 26000, 15000, 25000, 25000],
//                     backgroundColor: [
//                         'rgba(255, 99, 132, 0.2)',
//                         'rgba(54, 162, 235, 0.2)',
//                         'rgba(255, 206, 86, 0.2)',
//                         'rgba(75, 192, 192, 0.2)',
//                         'rgba(153, 102, 255, 0.2)',
//                         'rgba(255, 159, 64, 0.2)'
//                     ],
//                     borderColor: [
//                         'rgba(255, 99, 132, 1)',
//                         'rgba(54, 162, 235, 1)',
//                         'rgba(255, 206, 86, 1)',
//                         'rgba(75, 192, 192, 1)',
//                         'rgba(153, 102, 255, 1)',
//                         'rgba(255, 159, 64, 1)'
//                     ],
//                     borderWidth: 2
//                 }]
//             },
//                 options: {
//                 responsive: true
//             }
//         });
//     });
    
// //     // Doughnut Chart 1 

//     document.addEventListener('DOMContentLoaded', function () {
//         console.log('Initializing Chart.js');
//         var ctx = document.getElementById('cscChart1').getContext('2d');
//         console.log('Canvas Element:', ctx);
//                 var myChart = new Chart(ctx, {
//             type: 'doughnut',
//             data: {
//                 labels: ['Department Of Computer Science', 'Department Of Information Technology', 'Associate Of Computer Technology'],
//                 datasets: [{
//                     label: 'Collected Payment',
//                     data: [25000, 30000, 35000,],
//                     backgroundColor: [
//                         'rgba(255, 99, 132, 0.2)',
//                         'rgba(54, 162, 235, 0.2)',
//                         'rgba(255, 206, 86, 0.2)',
//                         'rgba(75, 192, 192, 0.2)',
//                         'rgba(153, 102, 255, 0.2)',
//                         'rgba(255, 159, 64, 0.2)'
//                     ],
//                     borderColor: [
//                         'rgba(255, 99, 132, 1)',
//                         'rgba(54, 162, 235, 1)',
//                         'rgba(255, 206, 86, 1)',
//                         'rgba(75, 192, 192, 1)',
//                         'rgba(153, 102, 255, 1)',
//                         'rgba(255, 159, 64, 1)'
//                     ],
//                     borderWidth: 2
//                 }]
//             },
//                 options: {
//                 responsive: true
//             }
//         });
//     });
    
// // Doughnut Chart 2 

//     document.addEventListener('DOMContentLoaded', function () {
//         console.log('Initializing Chart.js');
//         var ctx = document.getElementById('cscChart2').getContext('2d');
//         console.log('Canvas Element:', ctx);
//                 var myChart = new Chart(ctx, {
//             type: 'doughnut',
//             data: {
//                 labels: ['First Semester', 'Second Semester'],
//                 datasets: [{
//                     label: 'Collected Payment',
//                     data: [30000, 25000,],
//                     backgroundColor: [
//                         'rgba(255, 99, 132, 0.2)',
//                         'rgba(54, 162, 235, 0.2)',
//                         'rgba(255, 206, 86, 0.2)',
//                         'rgba(75, 192, 192, 0.2)',
//                         'rgba(153, 102, 255, 0.2)',
//                         'rgba(255, 159, 64, 0.2)'
//                     ],
//                     borderColor: [
//                         'rgba(255, 99, 132, 1)',
//                         'rgba(54, 162, 235, 1)',
//                         'rgba(255, 206, 86, 1)',
//                         'rgba(75, 192, 192, 1)',
//                         'rgba(153, 102, 255, 1)',
//                         'rgba(255, 159, 64, 1)'
//                     ],
//                     borderWidth: 2
//                 }]
//             },
//                 options: {
//                 responsive: true
//             }
//         });
//     });

//     //Bar Graph 1 

// var ctxSchoolYear = document.getElementById('FeeChart').getContext('2d');
// var schoolYearRemittedChart = new Chart(ctxSchoolYear, {
//     type: 'bar',
//     data: {
//         labels: ['University Fee', 'Local Fee'], 
//         datasets: [{
//             label: 'Total Remitted',
//             data: [25000, 35000], 
//             backgroundColor: [
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(255, 99, 132, 0.2)',
//             ],
//             borderColor: [
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(255, 99, 132, 1)',
//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         scales: {
//             y: {
//                 beginAtZero: true
//             }
//         }
//     }
// });

// var ctxSemester = document.getElementById('semesterRemittedChart').getContext('2d');
// var semesterRemittedChart = new Chart(ctxSemester, {
//     type: 'bar',
//     data: {
//         labels: ['First Semester', 'Second Semester'],
//         datasets: [{
//             label: 'Total Amount Collected',
//             data: [15000, 25000], 
//             backgroundColor: [
//                 'rgba(255, 206, 86, 0.2)',
//                 'rgba(75, 192, 192, 0.2)',
//             ],
//             borderColor: [
//                 'rgba(255, 206, 86, 1)',
//                 'rgba(75, 192, 192, 1)',
//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         indexAxis: 'y',
//         responsive: true,
//         maintainAspectRatio: false, 
//         scales: {
//             y: {
//                 beginAtZero: true
//             }
//         }
//     }
// });

