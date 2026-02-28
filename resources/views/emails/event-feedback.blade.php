
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Votre avis nous intéresse !</h1>
        <p class="text-gray-600 mb-8">Qu'avez-vous pensé de l'événement <span class="font-semibold text-blue-600">{{ $event->title }}</span> ?</p>

        <form action="{{ route('event.feedback.store', ['event' => $event->slug, 'registration' => $registration->id]) }}" method="POST">
            @csrf

            <div class="mb-8">
                <label class="block text-sm font-medium text-gray-700 mb-4 text-center text-lg">Votre note</label>
                <div class="flex justify-between items-center px-2">
                    @foreach([1, 2, 3, 4, 5] as $i)
                        <label class="group cursor-pointer">
                            <input type="radio" name="rating" value="{{ $i }}" class="sr-only peer" required>
                            <div class="w-12 h-12 flex items-center justify-center rounded-full border-2 border-gray-200 text-xl font-bold transition-all
                                peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600 group-hover:border-blue-400">
                                {{ $i }}
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="mb-8">
                <label for="comment" class="blocak text-sm font-medium text-gray-700 mb-2">Un petit mot ? (optionnel)</label>
                <textarea name="comment" id="comment" rows="4"
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 bg-gray-50"
                    placeholder="Ce que vous avez aimé ou ce qu'on peut améliorer..."></textarea>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-4 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all">
                Envoyer mon avis
            </button>
        </form>
    </div>
</body>
