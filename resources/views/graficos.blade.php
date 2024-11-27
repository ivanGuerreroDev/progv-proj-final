<!DOCTYPE html>
<html>
<head>
    <title>Gráficos de Delitos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f6f9;
        }
        h2 {
            color: #2C3E50;
        }
        .chart-container {
            margin-bottom: 50px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 10px;
            padding: 20px;
            background-color: #ffffff;
        }
        canvas {
            width: 100% !important;
            max-width: 800px;
            margin: auto;
        }
    </style>
</head>
<body>
    <h1>Visualización de Datos de Delitos</h1>
    <div id="charts"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const data = [
                {
                    "CARPETILLA": 202300094891,
                    "Audiencia": 4003428,
                    "Fecha de Solicitud": "12/07/2024",
                    "Fecha de Programación": "12/08/2024",
                    "Año": 2024,
                    "Mes": "julio",
                    "Hora de Programación": "10:00:00",
                    "Delito Generico depurado": "Contra la Vida y la Integridad Personal",
                    "Capítulo del Delito": "Homicidio",
                    "Delito específico depurado": "Tentativa De Femicidio",
                    "Total de Peticiones": 1,
                    "Petición depurada": "Formulación de Acusación"
                },
                {
                    "CARPETILLA": 202300066319,
                    "Audiencia": 4055501,
                    "Fecha de Solicitud": "24/07/2024",
                    "Fecha de Programación": "09/08/2024",
                    "Año": 2024,
                    "Mes": "septiembre",
                    "Hora de Programación": "15:00:00",
                    "Delito Generico depurado": "Contra El Orden Jurídico Familiar y El Estado Civil",
                    "Capítulo del Delito": "Violencia Doméstica",
                    "Delito específico depurado": "Violencia Doméstica",
                    "Total de Peticiones": 1,
                    "Petición depurada": "Suspensión del Proceso"
                },
                {
                    "CARPETILLA": 202200076242,
                    "Audiencia": 3971921,
                    "Fecha de Solicitud": "27/06/2024",
                    "Fecha de Programación": "08/07/2024",
                    "Año": 2024,
                    "Mes": "junio",
                    "Hora de Programación": "08:15:00",
                    "Delito Generico depurado": "Contra La Libertad E Integridad Sexual",
                    "Capítulo del Delito": "Abuso Sexual",
                    "Delito específico depurado": "Abuso Sexual a Menores",
                    "Total de Peticiones": 2,
                    "Petición depurada": "Audiencia Inicial"
                },
                {
                    "CARPETILLA": 202300022219,
                    "Audiencia": 3981221,
                    "Fecha de Solicitud": "05/08/2024",
                    "Fecha de Programación": "15/08/2024",
                    "Año": 2024,
                    "Mes": "agosto",
                    "Hora de Programación": "12:30:00",
                    "Delito Generico depurado": "Delito Contra El Patrimonio Económico",
                    "Capítulo del Delito": "Robo",
                    "Delito específico depurado": "Robo Agravado",
                    "Total de Peticiones": 3,
                    "Petición depurada": "Imposición de Medidas"
                },
                {
                    "CARPETILLA": 202300055120,
                    "Audiencia": 3998822,
                    "Fecha de Solicitud": "19/07/2024",
                    "Fecha de Programación": "01/08/2024",
                    "Año": 2024,
                    "Mes": "julio",
                    "Hora de Programación": "09:00:00",
                    "Delito Generico depurado": "Delito Contra La Seguridad Colectiva",
                    "Capítulo del Delito": "Tráfico de Drogas",
                    "Delito específico depurado": "Posesión y Tráfico de Sustancias Ilícitas",
                    "Total de Peticiones": 2,
                    "Petición depurada": "Audiencia de Juicio"
                }
            ];

            const groupedData = data.reduce((acc, item) => {
                const key = item["Delito Generico depurado"];
                acc[key] = (acc[key] || 0) + item["Total de Peticiones"];
                return acc;
            }, {});

            // Gráficos
            const chartContainer = document.getElementById('charts');

            // Gráfico de barras
            const barDiv = document.createElement('div');
            barDiv.classList.add('chart-container');
            barDiv.innerHTML = `
                <h2>Delitos por Total de Peticiones</h2>
                <canvas id="bar-chart"></canvas>
            `;
            chartContainer.appendChild(barDiv);

            new Chart(document.getElementById('bar-chart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: Object.keys(groupedData),
                    datasets: [{
                        label: 'Total de Peticiones',
                        data: Object.values(groupedData),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Gráfico de pastel
            const pieDiv = document.createElement('div');
            pieDiv.classList.add('chart-container');
            pieDiv.innerHTML = `
                <h2>Distribución de Delitos</h2>
                <canvas id="pie-chart"></canvas>
            `;
            chartContainer.appendChild(pieDiv);

            new Chart(document.getElementById('pie-chart').getContext('2d'), {
                type: 'pie',
                data: {
                    labels: Object.keys(groupedData),
                    datasets: [{
                        data: Object.values(groupedData),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true
                }
            });
        });
    </script>
</body>
</html>





