@props(['faqs', 'title' => 'Frequently Asked Question'])

@if ($faqs && $faqs->count() > 0)
    <x-page-section-title :title="'<span>' . $title . '</span>'" />
    <section class="py-8 bg-gray-900 relative overflow-hidden">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 relative z-10">
                @foreach ($faqs as $faq)
                    <div class="faq-item group relative bg-blue-100 rounded-xl border shadow hover:shadow-xl transition-all duration-300 overflow-hidden">
                        <button class="faq-question w-full text-left px-4 py-3 flex justify-between items-center gap-4 outline-none">
                            <span class="text-base font-semibold text-gray-800 group-hover:text-primary transition-colors duration-300">
                                {{ ($loop->index + 1) . " . " . $faq->question }}
                            </span>
                            <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-white/50 flex items-center justify-center transition-all duration-500 group-[.active]:bg-white group-hover:bg-white/80">
                                <svg class="w-4 h-4 text-gray-800 group-[.active]:text-primary group-[.active]:rotate-180 transition-all duration-500"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div class="faq-answer overflow-hidden max-h-0 opacity-0 transition-all duration-500 ease-in-out">
                            <div class="px-4 pb-4">
                                <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed text-justify border-t border-gray-200/50 pt-3">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @once
        @push('styles')
            <style>
                .faq-answer {
                    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                }
                .faq-answer ol { list-style: decimal; padding-left: 1.25rem; }
                .faq-answer ul { list-style: disc; padding-left: 1.25rem; }
                .faq-item.active {
                    border-color: rgba(15, 140, 202, 0.2);
                    box-shadow: 0 25px 50px -12px rgba(15, 140, 202, 0.1);
                }
            </style>
        @endpush

        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const faqItems = document.querySelectorAll('.faq-item');
                    faqItems.forEach(item => {
                        const question = item.querySelector('.faq-question');
                        const answer = item.querySelector('.faq-answer');
                        question.addEventListener('click', function() {
                            const isActive = item.classList.contains('active');
                            faqItems.forEach(otherItem => {
                                otherItem.classList.remove('active');
                                const otherAnswer = otherItem.querySelector('.faq-answer');
                                otherAnswer.style.maxHeight = null;
                                otherAnswer.style.opacity = '0';
                            });
                            if (!isActive) {
                                item.classList.add('active');
                                answer.style.maxHeight = answer.scrollHeight + "px";
                                answer.style.opacity = '1';
                            }
                        });
                    });
                });
            </script>
        @endpush
    @endonce
@endif
