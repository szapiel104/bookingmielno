@extends('layouts.app')

@section('title', 'W budowie - BookingMielno')

@section('content')
<section class="hero-section" style="min-height: 90vh; display: flex; align-items: center; justify-content: center;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <div style="margin-bottom: 40px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto; filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.3));">
                        <path d="M6 9h12M6 9a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2M6 9v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V9M10 4v5m4-5v5"></path>
                        <line x1="9" y1="15" x2="9" y2="19"></line>
                        <line x1="15" y1="15" x2="15" y2="19"></line>
                    </svg>
                </div>

                <h1 style="font-size: 3.5rem; font-weight: 700; margin-bottom: 20px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                    🔨 W Budowie
                </h1>
                
                <p style="font-size: 1.5rem; margin-bottom: 30px; color: rgba(255,255,255,0.9);">
                    Przepraszamy, strona jest w trakcie prac konserwacyjnych
                </p>

                <p style="font-size: 1.1rem; margin-bottom: 40px; color: rgba(255,255,255,0.8); max-width: 600px; margin-left: auto; margin-right: auto;">
                    Pracujemy nad czymś ekscytującego dla naszych gości. Wróć wkrótce, aby zarezerwować swój wymarzony pobyt!
                </p>

                <div style="margin-top: 50px;">
                    <a href="/" class="btn btn-light btn-lg" style="padding: 12px 40px; font-size: 1.1rem; border-radius: 8px;">
                        ← Powrót do strony głównej
                    </a>
                </div>

                <p style="margin-top: 60px; color: rgba(255,255,255,0.6); font-size: 0.95rem;">
                    W razie pytań prosimy o kontakt: 
                    <a href="mailto:info@bookingmielno.pl" style="color: rgba(255,255,255,0.9); text-decoration: underline;">
                        info@bookingmielno.pl
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
