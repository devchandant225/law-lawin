<div>
    <div class="row">
        <div class="col-lg-8 col-md-12">
            <div style="font-size: 2.5rem; font-weight: bold; color: var(--procounsel-primary); margin-bottom: 20px;">
                Calculate your Court Fee
            </div>
            
            @if (session()->has('error'))
                <div style="color: red; margin-bottom: 15px;">
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="mt-30">
                <label for="amount" style="font-weight: 600; color: var(--procounsel-text);">Enter your amount:</label>
                <div style="display: flex; gap: 30px; margin-top: 10px; align-items: center;" class="calculator-input-group">
                    <input 
                        type="number" 
                        wire:model="amount"
                        placeholder="20000"
                        id="amount"
                        style="
                            font-family: var(--procounsel-font);
                            padding: 12px 15px;
                            width: 70%;
                            border-radius: 8px;
                            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                            border: 1px solid var(--procounsel-border-color);
                            outline: none;
                            transition: all 0.3s ease;
                        "
                        onfocus="this.style.boxShadow='0 4px 8px rgba(0,0,0,0.15)'; this.style.borderColor='var(--procounsel-base)'"
                        onblur="this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)'; this.style.borderColor='var(--procounsel-border-color)'"
                    />
                    <button 
                        wire:click="calculateLawFee"
                        style="
                            background-color: var(--procounsel-primary);
                            color: var(--procounsel-white);
                            border: 2px solid var(--procounsel-primary);
                            border-radius: 6px;
                            padding: 12px 20px;
                            font-size: 1.1rem;
                            transition: all 0.15s ease;
                            cursor: pointer;
                            min-width: 120px;
                        "
                        onmouseover="this.style.backgroundColor='transparent'; this.style.color='var(--procounsel-primary)'"
                        onmouseout="this.style.backgroundColor='var(--procounsel-primary)'; this.style.color='var(--procounsel-white)'"
                    >
                        Calculate
                    </button>
                </div>
            </div>
            
            <div class="mt-30" style="display: flex; gap: 15px; align-items: center;">
                <label style="padding-top: 8px; font-weight: 600; color: var(--procounsel-text);">
                    Court Fee to be paid before court:
                </label>
                <div style="width: 290px;">
                    <input 
                        type="number"
                        placeholder="Calculated Amount"
                        value="{{ $lawFee ? number_format($lawFee, 2) : '' }}"
                        readonly
                        style="
                            font-family: var(--procounsel-font);
                            padding: 12px 15px;
                            width: 100%;
                            border-radius: 8px;
                            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                            border: 1px solid var(--procounsel-border-color);
                            background-color: #f9f9f9;
                        "
                    />
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-12" style="text-align: center;">
            <img 
                src="/img/calculator.jpg" 
                style="
                    aspect-ratio: 16/9;
                    width: 100%;
                    object-fit: cover;
                    border-radius: 8px;
                    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                "
                alt="Best law firm in Nepal"
            />
        </div>
    </div>
    
    <div class="mt-60">
        @if (!$showBreakdown)
            <div>
                <div style="font-size: 1.25rem; font-weight: 600; color: var(--procounsel-primary); margin-bottom: 15px;">
                    Division of Fee:
                </div>
                <table style="
                    margin-top: 15px;
                    width: 65%;
                    border-collapse: collapse;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                    border-radius: 8px;
                    overflow: hidden;
                ">
                    <thead>
                        <tr style="background-color: var(--procounsel-primary); color: var(--procounsel-white);">
                            <th style="padding: 15px; text-align: left; font-weight: 600;">Range</th>
                            <th style="padding: 15px; text-align: left; font-weight: 600;">Fee</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background-color: var(--procounsel-gray);">
                            <td style="padding: 12px 15px; border-bottom: 1px solid var(--procounsel-border-color);">Upto 25,000</td>
                            <td style="padding: 12px 15px; border-bottom: 1px solid var(--procounsel-border-color);">Rs..........</td>
                        </tr>
                        <tr>
                            <td style="padding: 12px 15px; border-bottom: 1px solid var(--procounsel-border-color);">25,001 to 50,000</td>
                            <td style="padding: 12px 15px; border-bottom: 1px solid var(--procounsel-border-color);">Rs..........</td>
                        </tr>
                        <tr style="background-color: var(--procounsel-gray);">
                            <td style="padding: 12px 15px; border-bottom: 1px solid var(--procounsel-border-color);">50,001 to 1,00,000</td>
                            <td style="padding: 12px 15px; border-bottom: 1px solid var(--procounsel-border-color);">Rs..........</td>
                        </tr>
                        <tr style="background-color: var(--procounsel-base); color: var(--procounsel-white); font-weight: 600;">
                            <td style="padding: 12px 15px;">Total</td>
                            <td style="padding: 12px 15px;">Rs..........</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    
    <div class="mt-80">
        @if ($showBreakdown)
            <div>
                <div style="font-size: 1.25rem; font-weight: 600; color: var(--procounsel-primary); margin-bottom: 15px;">
                    Division of Fee:
                </div>
                <p style="margin-top: 15px; font-size: 1.25rem; font-weight: 600; color: var(--procounsel-text);">
                    Calculation Display Table:
                </p>
                
                <table style="
                    margin-top: 15px;
                    width: 65%;
                    border-collapse: collapse;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                    border-radius: 8px;
                    overflow: hidden;
                ">
                    <thead>
                        <tr style="background-color: var(--procounsel-primary); color: var(--procounsel-white);">
                            <th style="padding: 15px; text-align: left; font-weight: 600;">Range</th>
                            <th style="padding: 15px; text-align: left; font-weight: 600;">Fee</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($calculationBreakdown as $index => $item)
                            <tr style="{{ $index % 2 == 0 ? 'background-color: var(--procounsel-gray);' : '' }}">
                                <td style="padding: 12px 15px; border-bottom: 1px solid var(--procounsel-border-color);">{{ $item['range'] }}</td>
                                <td style="padding: 12px 15px; border-bottom: 1px solid var(--procounsel-border-color);">Rs.{{ number_format($item['fee'], 2) }}</td>
                            </tr>
                        @endforeach
                        <tr style="background-color: var(--procounsel-base); color: var(--procounsel-white); font-weight: 600;">
                            <td style="padding: 12px 15px;">Total</td>
                            <td style="padding: 12px 15px;">Rs.{{ number_format($lawFee, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    
    <style>
        @media (max-width: 768px) {
            .calculator-input-group {
                flex-direction: column !important;
                gap: 15px !important;
            }
            .calculator-input-group input {
                width: 100% !important;
            }
            .calculator-input-group button {
                width: 100% !important;
            }
            table {
                width: 100% !important;
            }
        }
    </style>
</div>
