<section id="landingContact" class="section-py bg-body landing-contact">
    <div class="container">
        <div class="text-center mb-3 pb-1">
            <span class="badge bg-label-primary">Contact US</span>
        </div>
        <h3 class="text-center mb-1">Let's work together</h3>
        <p class="text-center mb-4 mb-lg-5 pb-md-3">Any question or remark? just write us a message</p>
        <div class="row gy-4">
            <div class="col-lg-5">
                <div class="contact-img-box position-relative border p-2 h-100">
                    <img src="{{ Helper::assets('assets/img/front-pages/icons/contact-border.png') }}" alt="contact border" class="contact-border-img position-absolute d-none d-md-block scaleX-n1-rtl" />
                    <img src="{{ Helper::assets('assets/img/front-pages/landing-page/contact-customer-service.png') }}" alt="contact customer service" class="contact-img w-100 scaleX-n1-rtl" />
                    <div class="pt-3 px-4 pb-1">
                        <div class="row gy-3 gx-md-4">
                            <div class="col-md-6 col-lg-12 col-xl-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge bg-label-primary rounded p-2 me-2"><i class="bx bx-envelope bx-sm"></i></div>
                                    <div>
                                        <p class="mb-0">Email</p>
                                        <h5 class="mb-0">
                                            <a href="mailto:bhargavkapadiya80@gmail.com" class="text-heading">bhargavkapadiya80@gmail.com</a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-12 col-xl-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge bg-label-success rounded p-2 me-2">
                                        <i class="bx bx-phone-call bx-sm"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0">Phone</p>
                                        <h5 class="mb-0"><a href="tel:+919638364455" class="text-heading">+919638364455</a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-1">Send a message</h4>
                        <p class="mb-4">
                            Whether it's a project idea, job opportunity, freelance work, <br class="d-none d-lg-block" /> or just a hello — I'd love to hear from you.
                        </p>
                        <form id="contactForm" class="contact" action="{{ route('contact.enquiry') }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label" for="contact-form-fullname">Full Name</label>
                                    <input type="text" class="form-control" id="contact-form-fullname" name="name" placeholder="Enter your full name" required />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="contact-form-email">Email</label>
                                    <input type="text" class="form-control" id="contact-form-email" name="email" placeholder="Enter your email" required />
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="contact-form-subject">Subject</label>
                                    <input type="text" class="form-control" id="contact-form-subject" name="subject" placeholder="Subject" required />
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="contact-form-message">Message</label>
                                    <textarea class="form-control" id="contact-form-message" name="message" rows="6" cols="6" placeholder="Write a message" required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Send inquiry</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
