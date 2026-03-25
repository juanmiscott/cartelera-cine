@props(['faqs'])

<section class="faqs">
    <h2 class="faqs__title">Preguntas Frecuentes</h2>

    <div class="faqs__list">
        @forelse ($faqs as $faq)
            <div class="faqs__item">
                <h3 class="faqs__question">{{ $faq->locale[App::getLocale()]['title'] ?? $faq->locale['es']['title'] ?? '-' }}</h3>
                <p class="faqs__answer">{{ $faq->locale[App::getLocale()]['description'] ?? $faq->locale['es']['description'] ?? '-' }}</p>
            </div>
        @empty
            <p>No hay preguntas frecuentes disponibles.</p>
        @endforelse
    </div>
</section>