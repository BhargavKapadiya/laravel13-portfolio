@if (isset($faqs) && !empty($faqs) && $faqs->count())
    <section id="landingFAQ" class="section-py bg-body landing-faq">
        <div class="container">
            <div class="text-center mb-3 pb-1">
                <span class="badge bg-label-primary">FAQ</span>
            </div>
            <h3 class="text-center mb-1">Frequently asked questions</h3>
            <p class="text-center mb-5 pb-3">Browse through these FAQs to find answers to commonly asked questions.</p>
            <div class="row gy-5">
                <div class="col-lg-5">
                    <div class="text-center">
                        <img src="{{ Helper::assets('assets/img/front-pages/landing-page/faq-boy-with-logos.png') }}" alt="faq boy with logos" class="faq-image" />
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="accordion" id="accordionExample">
                        @foreach ($faqs as $faq)
                            <div class="card accordion-item {{ $loop->first ? 'active' : '' }}">
                                <h2 class="accordion-header" id="heading-{{ $faq->id }}">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordion-{{ $faq->id }}" aria-expanded="true" aria-controls="accordionOne">
                                        {{ $faq->question }}
                                    </button>
                                </h2>

                                <div id="accordion-{{ $faq->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#accordionExample" aria-labelledby="heading-{{ $faq->id }}">
                                    <div class="accordion-body">
                                        {!! Helper::convertInHtml($faq->answer) !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
