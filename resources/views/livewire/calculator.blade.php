<div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-2">
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-6">Calculate your Court Fee</h2>
            
            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mt-5">
                <label for="amount" class="block text-gray-700 font-medium mb-2">Enter your amount (NPR):</label>
                <div class="flex flex-col sm:flex-row gap-4">
                    <input
                        type="number"
                        wire:model.live="amount"
                        placeholder="e.g. 20000"
                        id="amount"
                        class="font-sans py-3 px-4 w-full sm:w-2/3 rounded shadow focus:shadow-lg border border-gray-300 focus:border-primary focus:outline-none transition-all duration-300"
                    />
                    <button
                        wire:click="calculateLawFee"
                        class="bg-primary hover:bg-primary/90 text-white font-bold py-3 px-8 rounded shadow hover:shadow-lg transition-all duration-300 active:scale-95"
                    >
                        Calculate
                    </button>
                </div>
            </div>

            <div class="mt-8 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                <label for="court_fee_result" class="text-gray-700 font-medium">
                    Court Fee to be paid before court:
                </label>
                <div class="w-full sm:w-64">
                    <input
                        type="text"
                        id="court_fee_result"
                        value="{{ $lawFee ? number_format($lawFee, 2) : '' }}"
                        placeholder="Calculated Amount"
                        readonly
                        class="font-sans py-3 px-4 w-full rounded shadow border border-gray-300 bg-gray-50 text-primary font-bold focus:outline-none"
                    />
                </div>
            </div>
        </div>

        <div class="hidden md:block">
            <img
                src="{{ asset('calculator.jpg') }}"
                onerror="this.src='{{ asset('publication.jpg') }}'"
                class="w-full h-auto object-cover rounded-xl shadow-lg"
                alt="Court Fee Calculator Nepal"
            />
        </div>
    </div>

    <div class="mt-12">
        <h3 class="text-xl font-bold text-primary mb-4">Division of Fee :</h3>
        
        @if (!$showBreakdown)
            <div class="overflow-x-auto">
                <table class="w-full md:w-2/3 border-collapse">
                    <thead>
                        <tr class="text-left border-b-2 border-gray-200">
                            <th class="py-3 px-4 text-gray-700">Range</th>
                            <th class="py-3 px-4 text-gray-700">Fee</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600">
                        <tr class="border-b border-gray-100">
                            <td class="py-3 px-4">Upto 25,000</td>
                            <td class="py-3 px-4">Rs..........</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-3 px-4">25,001 to 50,000</td>
                            <td class="py-3 px-4">Rs..........</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-3 px-4">50,001 to 1,00,000</td>
                            <td class="py-3 px-4">Rs..........</td>
                        </tr>
                        <tr class="font-bold text-gray-800">
                            <td class="py-3 px-4">Total</td>
                            <td class="py-3 px-4">Rs..........</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
            <div class="overflow-x-auto">
                <p class="mb-4 text-gray-600 font-medium">Calculation Display Table :</p>
                <table class="w-full md:w-2/3 border-collapse">
                    <thead>
                        <tr class="text-left border-b-2 border-gray-200">
                            <th class="py-3 px-4 text-gray-700">Range</th>
                            <th class="py-3 px-4 text-gray-700">Fee (NPR)</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600">
                        @foreach ($calculationBreakdown as $item)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                <td class="py-3 px-4">{{ $item['range'] }}</td>
                                <td class="py-3 px-4 font-medium text-primary">Rs. {{ number_format($item['fee'], 2) }}</td>
                            </tr>
                        @endforeach
                        <tr class="font-bold text-gray-800 bg-gray-50">
                            <td class="py-3 px-4 uppercase tracking-wider">Total</td>
                            <td class="py-3 px-4 text-lg text-primary border-t-2 border-gray-200">
                                Rs. {{ number_format($lawFee, 2) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
