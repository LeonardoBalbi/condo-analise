<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análise de Dados de Condomínio - Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center font-sans">
    <div class="bg-white p-10 rounded-xl shadow-lg w-full max-w-lg border border-gray-200">
        <h1 class="text-3xl font-extrabold mb-2 text-center text-blue-700">Painel de Análise</h1>
        <p class="text-center text-gray-500 mb-8 text-sm uppercase tracking-wide">Interface Laravel + API Python</p>
        
        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded mb-6 text-sm" role="alert">
                <p class="font-bold">Atenção!</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <form action="{{ route('analysis.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2 uppercase tracking-tight" for="file">
                    Arquivo PDF ou CSV
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-blue-400 transition-colors">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="file" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>Clique para selecionar</span>
                                <input id="file" name="file" type="file" class="sr-only" required>
                            </label>
                            <p class="pl-1">ou arraste e solte</p>
                        </div>
                        <p class="text-xs text-gray-500">
                            Apenas arquivos .PDF ou .CSV até 10MB
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50 w-full transition duration-300 transform active:scale-95 uppercase">
                    Enviar para Processamento
                </button>
            </div>
        </form>

        <div class="mt-10 border-t border-gray-100 pt-6">
            <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest text-center mb-4">Como Funciona</h2>
            <div class="grid grid-cols-1 gap-4 text-xs text-gray-500 px-2">
                <div class="flex items-start">
                    <span class="bg-blue-100 text-blue-700 rounded-full h-5 w-5 flex items-center justify-center mr-2 flex-shrink-0">1</span>
                    <p>Você envia o PDF do condomínio através desta interface Laravel.</p>
                </div>
                <div class="flex items-start">
                    <span class="bg-blue-100 text-blue-700 rounded-full h-5 w-5 flex items-center justify-center mr-2 flex-shrink-0">2</span>
                    <p>O Laravel comunica-se com a API Python (FastAPI) para extração inteligente dos dados.</p>
                </div>
                <div class="flex items-start">
                    <span class="bg-blue-100 text-blue-700 rounded-full h-5 w-5 flex items-center justify-center mr-2 flex-shrink-0">3</span>
                    <p>A API Python gera um Excel (.xlsx) e o Laravel devolve o arquivo pronto para download.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Atualiza o texto do input file quando selecionado
        const fileInput = document.getElementById('file');
        const fileLabel = fileInput.previousElementSibling;
        
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                fileLabel.innerHTML = `<span class='text-blue-700 font-bold'>Selecionado: ${e.target.files[0].name}</span>`;
            }
        });
    </script>
</body>
</html>
