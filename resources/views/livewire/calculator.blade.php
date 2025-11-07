<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-5xl font-bold text-accent mb-4">
                Calculate your Court Fee
            </h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Get an accurate estimate of court fees for your legal proceedings in Nepal
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
                            src="/img/calculator.jpg" 
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
