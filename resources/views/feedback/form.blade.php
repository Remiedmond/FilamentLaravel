<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6 font-sans">
<div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
<h1 class="text-2xl font-bold text-gray-900 mb-2 text-center">Votre avis nous intéresse !</h1>
<p class="text-gray-600 mb-8 text-center">
Qu'avez-vous pensé de l'événement




<span class="font-semibold text-blue-600 uppercase tracking-wide">{{ $event->title }}</span> ?
</p>

    <!-- Formulaire de soumission -->
    <form action="{{ route('event.feedback.store', ['event' => $event->slug, 'registration' => $registration->id]) }}" method="POST">

        <!-- Protection CSRF obligatoire pour éviter l'erreur 419 -->
        @csrf

        <!-- Sélection de la note -->
        <div class="mb-10">
            <label class="block text-sm font-semibold text-gray-700 mb-6 text-center text-lg italic">Votre note sur 5</label>
            <div class="flex justify-between items-center px-2">
                @foreach([1, 2, 3, 4, 5] as $i)
                    <label class="group cursor-pointer">
                        <input type="radio" name="rating" value="{{ $i }}" class="sr-only peer" required>
                        <div class="w-12 h-12 flex items-center justify-center rounded-full border-2 border-gray-200 text-xl font-black transition-all duration-200
                            peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600 peer-checked:shadow-lg peer-checked:shadow-blue-200
                            group-hover:border-blue-400 group-hover:text-blue-600">
                            {{ $i }}
                        </div>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Commentaire libre -->
        <div class="mb-8 text-left">
            <label for="comment" class="block text-sm font-medium text-gray-700 mb-2 ml-1">Un petit mot ? (optionnel)</label>
            <textarea name="comment" id="comment" rows="4"
                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 p-4 bg-gray-50 text-gray-900 transition-all"
                placeholder="Dites-nous ce qui vous a plu ou ce qu'on peut améliorer..."></textarea>
        </div>

        <!-- Bouton d'envoi -->
        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-4 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all transform active:scale-95 flex items-center justify-center gap-2">
            <span>Envoyer mon avis</span>
        </button>
    </form>
</div>

<!-- Affichage des erreurs si le formulaire est mal rempli -->
@if ($errors->any())
    <div class="fixed bottom-4 right-4 bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl shadow-2xl z-50">
        <ul class="text-sm font-bold">
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


</body>
