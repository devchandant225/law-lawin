<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-5xl font-bold text-accent mb-6 uppercase tracking-wider">
                Court Fee Calculator
            </h1>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto leading-relaxed">
                Estimate your court fee budget using the Lawin and Partners Court Fee Calculator, the most reliable tool for estimating court submission fees in Nepal.
            </p>
        </div>

        @if (session()->has('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 max-w-4xl mx-auto">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <!-- Calculator Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden max-w-6xl mx-auto mb-12">
            <div class="grid lg:grid-cols-3 gap-0">
                <!-- Input Section -->
                <div class="lg:col-span-2 p-6 md:p-8">
                    <div class="space-y-6">
                        <!-- Amount Input -->
                        <div>
                            <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">
                                Enter your amount (NPR)
                            </label>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <div class="flex-1">
                                    <input 
                                        type="number" 
                                        wire:model="amount"
                                        placeholder="e.g., 20,000"
                                        id="amount"
                                        class="w-full px-4 py-4 text-lg rounded-xl border-2 border-gray-200 outline-none transition-all duration-300 focus:border-accent focus:ring-4 focus:ring-accent/20 bg-gray-50 focus:bg-white"
                                    />
                                </div>
                                <button 
                                    wire:click="calculateLawFee"
                                    class="px-8 py-4 text-lg font-semibold rounded-xl bg-accent text-white transition-all duration-300 hover:bg-accent/90 hover:scale-105 hover:shadow-lg sm:min-w-[140px] active:scale-95"
                                >
                                    Calculate
                                </button>
                            </div>
                        </div>

                        <!-- Result Display -->
                        <div class="bg-gradient-to-r from-accent/5 to-accent/10 p-6 rounded-xl border border-accent/20">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                Court Fee to be paid before court:
                            </label>
                            <div class="relative">
                                <input 
                                    type="text"
                                    placeholder="Amount will appear here"
                                    value="{{ $lawFee ? 'NPR ' . number_format($lawFee, 2) : '' }}"
                                    readonly
                                    class="w-full px-4 py-4 text-xl font-bold text-accent rounded-xl border-2 border-accent/30 bg-white/80 backdrop-blur-sm"
                                />
                                @if($lawFee)
                                    <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Image Section -->
                <div class="bg-gradient-to-br from-accent/10 to-accent/20 p-6 md:p-8 flex items-center justify-center">
                    <div class="text-center">
                        <img 
                            src="data:image/jpeg;base64,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" 
                            class="w-full max-w-xs mx-auto rounded-2xl shadow-2xl transform hover:scale-105 transition-transform duration-300"
                            alt="Best law firm in Nepal"
                        />
                        <div class="mt-4 text-sm text-gray-600">
                            <p class="font-semibold">Professional Legal Services</p>
                            <p>Accurate Court Fee Calculations</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fee Breakdown Section -->
    @if (!$showBreakdown || $showBreakdown)
        <div class="max-w-6xl mx-auto px-4">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-accent to-accent/80 px-6 py-8">
                    <h2 class="text-2xl md:text-3xl font-bold text-white text-center">
                        {{ $showBreakdown ? 'Detailed Fee Breakdown' : 'Fee Structure' }}
                    </h2>
                    @if($showBreakdown)
                        <p class="text-accent-100 text-center mt-2">Based on your entered amount</p>
                    @endif
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    @if (!$showBreakdown)
                        <!-- Static Fee Structure -->
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200">
                                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                                        Amount Range (NPR)
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                                        Court Fee
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 text-sm text-gray-900 font-medium">Up to 25,000</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">As per court schedule</td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 text-sm text-gray-900 font-medium">25,001 to 50,000</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">As per court schedule</td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 text-sm text-gray-900 font-medium">50,001 to 1,00,000</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">As per court schedule</td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <!-- Dynamic Breakdown -->
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200">
                                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                                        Amount Range (NPR)
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                                        Court Fee (NPR)
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($calculationBreakdown as $index => $item)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200 {{ $index % 2 == 0 ? 'bg-gray-25' : '' }}">
                                        <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                                            {{ $item['range'] }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-semibold text-accent">
                                            Rs. {{ number_format($item['fee'], 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- Total Row -->
                                <tr class="bg-accent text-white font-bold">
                                    <td class="px-6 py-4 text-sm uppercase tracking-wider">
                                        Total Court Fee
                                    </td>
                                    <td class="px-6 py-4 text-lg">
                                        Rs. {{ number_format($lawFee, 2) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <!-- Additional Info Card -->
    <div class="max-w-6xl mx-auto px-4 mt-12">
        <div class="bg-gradient-to-r from-accent/5 to-accent/10 rounded-2xl p-6 md:p-8 border border-accent/20">
            <div class="text-center">
                <h3 class="text-xl font-bold text-accent mb-4">Important Notes</h3>
                <div class="grid md:grid-cols-2 gap-6 text-sm text-gray-700">
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-accent mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <p class="font-semibold">Calculation Accuracy</p>
                            <p>Fees calculated based on current court schedules and may vary.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-accent mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <p class="font-semibold">Professional Advice</p>
                            <p>Consult with legal experts for complex cases and final confirmation.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
