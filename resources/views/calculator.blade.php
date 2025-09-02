@extends('layouts.app')

@section('title', 'Court Fee Calculator')

@section('content')
    <x-page-banner 
        title="Calculator"
        subtitle="Calculate your legal expenses and make informed decisions."
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Calculator']
        ]"
        backgroundImage="assets/images/backgrounds/page-header-contact-bg.jpg"
    />

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
