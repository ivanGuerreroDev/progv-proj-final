<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Debugger') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-5 mb-5 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-200">Execute MapReduce debugger</h3>
                <form id="execute-mapreduce" method="POST" action="{{ route('mapReduce.execute') }}">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div class="grid grid-cols-1 gap-6">
                            <div class="col-span-1">
                                <button class="js-modal-trigger btn btn-info" data-target="modal-js-csvcolumns">
                                    See csv columns
                                </button>
                            </div>
                            <div class="col-auto">
                                <label for="data" class="block text-sm mb-0 font-medium text-gray-700 dark:text-gray-200">
                                    Input csv file hdfs route
                                </label>
                                <input
                                    type="text"
                                    name="inputHdfsFile"
                                    id="inputHdfsFile"
                                    value="/tmp/input.csv"
                                    placeholder="Insert hdfs route of csv file"
                                    class="block w-full px-3 py-2 mt-1 text-gray-700 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                                <div class="flex justify-end">
                                    <button id="execute-btn" type="submit" class="border border-transparent dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-gray-300 inline-flex items-center px-4 py-2 bg-gray-800 text-sm font-medium rounded-md text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                        Execute
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-white p-5 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-200">Save data into database</h3>
                <form id="save-mapreduce" method="POST" action="{{ route('mapReduce.saveToDb') }}">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div class="grid grid-cols-1 gap-6">
                            <div class="col-span-1">
                                <button class="js-modal-trigger btn btn-info" data-target="modal-js-csvcolumns">
                                    See csv columns
                                </button>
                            </div>
                            <div class="col-auto">
                                <label for="data" class="block text-sm mb-0 font-medium text-gray-700 dark:text-gray-200">
                                    Csv file hdfs route
                                </label>
                                <input
                                    type="text"
                                    name="outputHdfsFile"
                                    id="outputHdfsFile"
                                    value="/tmp/output.csv"
                                    placeholder="Insert hdfs route of csv file"
                                    class="block w-full px-3 py-2 mt-1 text-gray-700 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                                <div class="flex justify-end">
                                    <button id="execute-btn" type="submit" class="border border-transparent dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-gray-300 inline-flex items-center px-4 py-2 bg-gray-800 text-sm font-medium rounded-md text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                        Execute
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal" id="modal-js-execute-response">
                    <div class="modal-background"></div>
                    <div class="modal-card">
                        <header class="modal-card-head">
                            <p class="modal-card-title">Execute response:</p>
                            <button class="delete" aria-label="close"></button>
                        </header>
                        <section class="modal-card-body">

                        </section>
                        <footer class="modal-card-foot">
                            <div class="buttons">
                                <button class="button">Cancel</button>
                            </div>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="modal-js-csvcolumns">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Columns of csv:</p>
                    <button class="delete" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <ul>
                        <li>Carpetilla</li>
                        <li>Audiencia</li>
                        <li>Fecha de Solicitud</li>
                        <li>Fecha de Programación</li>
                        <li>Año</li>
                        <li>Mes</li>
                        <li>Hora de Programación</li>
                        <li>Días de Atraso en el Registro de la Audiencia</li>
                        <li>Título del Delito 1</li>
                        <li>Título del Delito 2</li>
                        <li>Título del Delito 3</li>
                        <li>Título del Delito 4</li>
                        <li>Título del Delito 5</li>
                        <li>Título del Delito 6</li>
                        <li>Título del Delito 7</li>
                        <li>Delito Genérico Depurado</li>
                        <li>Delito Genérico Agrupado</li>
                        <li>Capítulo del Delito 1</li>
                        <li>Capítulo del Delito 2</li>
                        <li>Capítulo del Delito 3</li>
                        <li>Capítulo del Delito 4</li>
                        <li>Capítulo del Delito 5</li>
                        <li>Capítulo del Delito 6</li>
                        <li>Capítulo del Delito 7</li>
                        <li>Artículo del Delito 1</li>
                        <li>Artículo del Delito 2</li>
                        <li>Artículo del Delito 3</li>
                        <li>Artículo del Delito 4</li>
                        <li>Artículo del Delito 5</li>
                        <li>Artículo del Delito 6</li>
                        <li>Artículo del Delito 7</li>
                        <li>Delito Específico Depurado</li>
                        <li>Delitos Agrupados</li>
                        <li>Total de Peticiones</li>
                        <li>Sujetos</li>
                        <li>Peticiones</li>
                        <li>Petición Depurada</li>
                        <li>Seleccione la Subpetición de Actos de Investigación</li>
                        <li>Ampliación de la Petición</li>
                        <li>Petición Hecha por: (Manual, Plataforma, Audiencia)</li>
                        <li>¿Se Realizó?: Sí/No</li>
                        <li>Fase de la Audiencia</li>
                        <li>¿Si no se Realizó?: Causa de no Realización</li>
                        <li>Decisión Resumida</li>
                        <li>Decisión Depurada</li>
                        <li>Detalle de la Decisión o de la Pena</li>
                        <li>Número de la Sentencia</li>
                        <li>Medidas de Suspensión, Medida Cautelar y Protección</li>
                        <li>Hora de Inicio</li>
                        <li>Hora Final</li>
                        <li>Tiempo Total Utilizado</li>
                        <li>Defensa Depurada</li>
                        <li>Sexo del Implicado</li>
                        <li>Edad del Implicado</li>
                        <li>Fecha de Nacimiento</li>
                        <li>Estado Civil del Implicado</li>
                        <li>Nacionalidad</li>
                        <li>Etnia del Implicado</li>
                        <li>Discapacidad del Implicado</li>
                        <li>Ayuda del Implicado</li>
                        <li>Tipo de Ayuda del Implicado</li>
                        <li>¿Trabaja el Implicado?</li>
                        <li>¿Ocupación del Implicado?</li>
                        <li>Nivel Académico del Implicado</li>
                        <li>Condición Procesal del Implicado Antes de la Audiencia</li>
                        <li>Condición Procesal del Implicado Después de la Audiencia</li>
                        <li>Fecha de Aprehensión</li>
                        <li>Relación del Implicado con la Víctima</li>
                    </ul>
                </section>
                <footer class="modal-card-foot">
                    <div class="buttons">
                        <button class="button">Cancel</button>
                    </div>
                </footer>
            </div>
        </div>
        <div class="modal" id="modal-js-execute-response">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Execute response:</p>
                    <button class="delete" aria-label="close"></button>
                </header>
                <section class="modal-card-body">

                </section>
                <footer class="modal-card-foot">
                    <div class="buttons">
                        <button class="button">Cancel</button>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Functions to open and close a modal
            function openModal($el) {
                $el.classList.add('is-active');
            }

            function closeModal($el) {
                $el.classList.remove('is-active');
            }

            function closeAllModals() {
                (document.querySelectorAll('.modal') || []).forEach(($modal) => {
                    closeModal($modal);
                });
            }

            // Add a click event on buttons to open a specific modal
            (document.querySelectorAll('.js-modal-trigger') || []).forEach(($trigger) => {
                const modal = $trigger.dataset.target;
                const $target = document.getElementById(modal);

                $trigger.addEventListener('click', () => {
                    openModal($target);
                });
            });

            // Add a click event on various child elements to close the parent modal
            (document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button') || []).forEach(($close) => {
                const $target = $close.closest('.modal');

                $close.addEventListener('click', () => {
                    closeModal($target);
                });
            });

            // Add a keyboard event to close all modals
            document.addEventListener('keydown', (event) => {
                if (event.key === "Escape") {
                    closeAllModals();
                }
            });

            let formExecuteMapReduce = document.getElementById('execute-mapreduce');
            let executeBtn = document.getElementById('execute-btn');
            let executeResponseModal = document.getElementById('modal-js-execute-response');
            // prevent defautl form submit
            formExecuteMapReduce.addEventListener('submit', function(event) {
                event.preventDefault();
                let formData = new FormData(formExecuteMapReduce);
                // validate form
                if (!formData.get('inputHdfsFile')) {
                    alert('Please insert hdfs route of csv file');
                    return;
                }
                executeBtn.innerHTML = `
                <svg width="20" height="20" viewBox="0 0 57 57" xmlns="http://www.w3.org/2000/svg" stroke="#fff">
                    <g fill="none" fill-rule="evenodd">
                        <g transform="translate(1 1)" stroke-width="2">
                            <circle cx="5" cy="50" r="5">
                                <animate attributeName="cy"
                                    begin="0s" dur="2.2s"
                                    values="50;5;50;50"
                                    calcMode="linear"
                                    repeatCount="indefinite" />
                                <animate attributeName="cx"
                                    begin="0s" dur="2.2s"
                                    values="5;27;49;5"
                                    calcMode="linear"
                                    repeatCount="indefinite" />
                            </circle>
                            <circle cx="27" cy="5" r="5">
                                <animate attributeName="cy"
                                    begin="0s" dur="2.2s"
                                    from="5" to="5"
                                    values="5;50;50;5"
                                    calcMode="linear"
                                    repeatCount="indefinite" />
                                <animate attributeName="cx"
                                    begin="0s" dur="2.2s"
                                    from="27" to="27"
                                    values="27;49;5;27"
                                    calcMode="linear"
                                    repeatCount="indefinite" />
                            </circle>
                            <circle cx="49" cy="50" r="5">
                                <animate attributeName="cy"
                                    begin="0s" dur="2.2s"
                                    values="50;50;5;50"
                                    calcMode="linear"
                                    repeatCount="indefinite" />
                                <animate attributeName="cx"
                                    from="49" to="49"
                                    begin="0s" dur="2.2s"
                                    values="49;5;27;49"
                                    calcMode="linear"
                                    repeatCount="indefinite" />
                            </circle>
                        </g>
                    </g>
                </svg>
                Processing...`;
                executeBtn.setAttribute('disabled', 'disabled');
                let targetModal = document.getElementById('modal-js-execute-response');
                fetch(formExecuteMapReduce.action, {
                        method: formExecuteMapReduce.method,
                        body: formData
                    }).then(response => response.json())
                    .then(data => {
                        executeBtn.innerHTML = 'Execute';
                        executeBtn.removeAttribute('disabled');
                        executeResponseModal.querySelector('.modal-card-body').innerHTML = `
                        <h5 class="text-lg font-medium text-gray-900 dark:text-gray-200">Success:</h5>
                        <p class="text-gray-700 dark:text-gray-300">Csv debugged saved in: ${data.output}</p>
                        <pre>${data.results}</pre>
                    `;
                        openModal(targetModal);
                    })
                    .catch(error => {
                        executeBtn.innerHTML = 'Execute';
                        executeBtn.removeAttribute('disabled');
                        console.error(error.response);
                        executeResponseModal.querySelector('.modal-card-body').innerHTML = `
                        <h5 class="text-lg font-medium text-gray-900 dark:text-gray-200">Errors:</h5>
                    `;
                        openModal(targetModal);
                        console.error(error);
                    });
            });
        });
    </script>
</x-app-layout>
