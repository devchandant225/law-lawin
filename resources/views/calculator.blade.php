@extends('layouts.app')

@section('title', 'Court Fee Calculator')

@section('content')
<section class="page-header pt-100 pb-80" style="background: linear-gradient(135deg, var(--procounsel-primary) 0%, var(--procounsel-base) 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-12">
                <div class="page-header__content">
                    <h2 style="color: var(--procounsel-white); font-family: var(--procounsel-heading-font); font-size: 3rem; font-weight: 600; margin-bottom: 10px;">
                        Court Fee Calculator
                    </h2>
                    <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem; margin: 0;">
                        Calculate accurate court fees for legal proceedings in Nepal
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-12" style="text-align: center;">
                <div class="page-header__shape" style="opacity: 0.3;">
                    <svg width="200" height="200" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="100" cy="100" r="80" stroke="white" stroke-width="2" fill="none"/>
                        <path d="M60 100h80M100 60v80" stroke="white" stroke-width="2"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pt-120 pb-120" style="background-color: var(--procounsel-white);">
    <div class="container">
        @livewire('calculator')
    </div>
</section>

<section class="pt-80 pb-80" style="background-color: var(--procounsel-gray);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div style="text-align: center;">
                    <h3 style="color: var(--procounsel-primary); font-family: var(--procounsel-heading-font); font-size: 2rem; margin-bottom: 30px;">
                        How Court Fee Calculation Works
                    </h3>
                    <div class="row mt-50">
                        <div class="col-lg-4 col-md-6 mb-40">
                            <div style="background: var(--procounsel-white); padding: 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); text-align: center; height: 100%;">
                                <div style="width: 60px; height: 60px; background: var(--procounsel-base); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: white; font-weight: bold; font-size: 1.5rem;">1</div>
                                <h4 style="color: var(--procounsel-primary); margin-bottom: 15px;">Enter Amount</h4>
                                <p style="color: var(--procounsel-text); line-height: 1.6;">Enter the case value or claim amount for which you need to calculate court fees</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-40">
                            <div style="background: var(--procounsel-white); padding: 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); text-align: center; height: 100%;">
                                <div style="width: 60px; height: 60px; background: var(--procounsel-base); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: white; font-weight: bold; font-size: 1.5rem;">2</div>
                                <h4 style="color: var(--procounsel-primary); margin-bottom: 15px;">Calculate Fee</h4>
                                <p style="color: var(--procounsel-text); line-height: 1.6;">Our system calculates the fee based on the progressive rate structure set by Nepal's court system</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-40">
                            <div style="background: var(--procounsel-white); padding: 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); text-align: center; height: 100%;">
                                <div style="width: 60px; height: 60px; background: var(--procounsel-base); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: white; font-weight: bold; font-size: 1.5rem;">3</div>
                                <h4 style="color: var(--procounsel-primary); margin-bottom: 15px;">Get Breakdown</h4>
                                <p style="color: var(--procounsel-text); line-height: 1.6;">View detailed breakdown showing how the total fee is calculated across different amount ranges</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    @media (max-width: 768px) {
        .page-header h2 {
            font-size: 2rem !important;
        }
        .page-header p {
            font-size: 1rem !important;
        }
    }
</style>
@endpush

@endsection
