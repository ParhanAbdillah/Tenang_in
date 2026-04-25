<form action="{{ route('mental-health.submit') }}" method="POST">
    @csrf
    <input type="hidden" name="category_id" value="{{ $category->id }}">

    @foreach($category->questions as $question)
        <div class="mb-6">
            <p class="font-bold">{{ $loop->iteration }}. {{ $question->question_text }}</p>
            <div class="space-y-2">
                @foreach($question->options as $option)
                    <label class="block">
                        <input type="radio" name="options[{{ $question->id }}]" value="{{ $option->points }}" required>
                        {{ $option->option_text }}
                    </label>
                @endforeach
            </div>
        </div>
    @endforeach

    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg">Selesai & Lihat Hasil</button>
</form>