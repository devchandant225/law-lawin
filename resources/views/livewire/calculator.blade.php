<div class="p-6 md:p-10">
    {{-- Top Grid: Input and Image --}}
    <div class="grid lg:grid-cols-3 gap-12 items-center mb-12">
        {{-- Input Section --}}
        <div class="lg:col-span-2">
            <div class="mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Estimate Your Fees</h2>
                <p class="text-gray-500">Enter the claimed amount to calculate the official court fee.</p>
            </div>
            
            <div class="space-y-6">
                {{-- Amount Input --}}
                <div class="relative">
                    <label for="amount" class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Claim Amount (NPR)</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-primary text-gray-400">
                            <span class="text-lg font-bold">Rs.</span>
                        </div>
                        <input
                            type="number"
                            wire:model.live="amount"
                            placeholder="e.g. 500,000"
                            id="amount"
                            class="block w-full pl-12 pr-4 py-4 text-xl font-bold rounded-2xl border-2 border-gray-100 bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none text-gray-900 placeholder:text-gray-300"
                        />
                    </div>
                    @if (session()->has('error'))
                        <p class="mt-2 text-sm text-red-600 font-medium flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            {{ session('error') }}
                        </p>
                    @endif
                </div>

                {{-- Action Button --}}
                <button
                    wire:click="calculateLawFee"
                    wire:loading.attr="disabled"
                    class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-4 px-8 rounded-2xl shadow-lg shadow-primary/20 transition-all active:scale-[0.98] flex items-center justify-center gap-3 group"
                >
                    <span wire:loading.remove>Calculate Now</span>
                    <span wire:loading>Processing...</span>
                    <svg wire:loading.remove class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </button>

                {{-- Result Display (Inline) --}}
                <div class="bg-primary/5 rounded-2xl p-6 border border-primary/10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-1">Total Court Fee</span>
                        <div class="text-3xl font-black text-primary">
                            @if($lawFee)
                                <span class="text-sm align-top mr-1">Rs.</span>{{ number_format($lawFee, 2) }}
                            @else
                                <span class="text-gray-200">--.---</span>
                            @endif
                        </div>
                    </div>
                    @if($lawFee)
                        <div class="flex items-center gap-2 px-4 py-2 bg-green-50 text-green-700 rounded-full text-sm font-bold animate-fade-in">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            Verified
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Side Image --}}
        <div class="hidden lg:block">
            <div class="relative">
                <div class="absolute -inset-2 bg-secondary/20 rounded-3xl blur-xl transition duration-1000"></div>
                <img 
                    src="{{ asset('court-fee-calculator.jpg') }}" 
                    alt="Best Law Firm in Nepal - Court Fee Calculator"
                    class="relative w-full aspect-square object-cover rounded-3xl shadow-xl border-4 border-white"
                    onerror="this.src='{{ asset('publication.jpg') }}'"
                >
            </div>
        </div>
    </div>

    {{-- Bottom Row: Breakdown Section --}}
    <div class="bg-gray-50 rounded-3xl p-6 md:p-8 border border-gray-100">
        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            Fee Division Breakdown
        </h3>
        
        <div class="grid md:grid-cols-12 gap-8 items-start">
            <div class="md:col-span-8 space-y-4">
                @if (!$showBreakdown)
                    @foreach(range(1, 3) as $i)
                        <div class="flex justify-between items-center p-4 bg-white rounded-xl border border-gray-100 opacity-50">
                            <div class="h-4 bg-gray-100 rounded w-1/3"></div>
                            <div class="h-4 bg-gray-100 rounded w-1/4"></div>
                        </div>
                    @endforeach
                    <p class="text-sm text-gray-400 italic">Calculate an amount above to see detailed breakdown.</p>
                @else
                    @foreach ($calculationBreakdown as $item)
                        <div class="flex justify-between items-center p-4 bg-white rounded-xl border border-gray-200 hover:shadow-sm transition-shadow animate-fade-in-up">
                            <span class="text-sm font-medium text-gray-600">{{ $item['range'] }}</span>
                            <span class="font-bold text-primary">Rs. {{ number_format($item['fee'], 2) }}</span>
                        </div>
                    @endforeach
                @endif
            </div>

            @if($showBreakdown)
                <div class="md:col-span-4 bg-primary rounded-2xl p-6 text-white shadow-xl shadow-primary/20 animate-fade-in">
                    <span class="font-bold uppercase tracking-widest text-[10px] opacity-70 block mb-2">Total Payable Amount</span>
                    <div class="text-3xl font-black mb-1">Rs. {{ number_format($lawFee, 2) }}</div>
                    <div class="h-1 w-12 bg-secondary rounded-full"></div>
                    <p class="mt-4 text-[10px] opacity-60 leading-relaxed italic">
                        *This estimate includes only the mandatory court fees. Legal representation and administrative costs are extra.
                    </p>
                </div>
            @endif
        </div>

        <div class="mt-8 pt-6 border-t border-gray-200">
            <div class="flex items-start gap-3 text-xs text-gray-400 leading-relaxed">
                <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p>Designed by <span class="text-gray-600 font-semibold">Lawin and Partners</span> for professional transparency in Nepalese legal procedures.</p>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in { from { opacity: 0; } to { opacity: 1; } }
        @keyframes fade-in-up { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fade-in 0.5s ease-out; }
        .animate-fade-in-up { animation: fade-in-up 0.4s ease-out forwards; }
    </style>
</div>
