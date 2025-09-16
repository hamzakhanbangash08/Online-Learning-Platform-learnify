@extends('layouts.main') {{-- Aapka admin dashboard master layout --}}

@section('title', 'Admin FAQs')

{{-- CSS ko blade section ke andar shamil kiya gaya hai, taaki ye page specific rahe --}}
@section('styles')
<style>
/* Custom CSS for a better look */

/* Card ko stylish banayein */
.card.shadow-lg {
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1) !important; /* Lighter shadow for a modern look */
}

.card.rounded-4 {
    border-radius: 1.5rem !important;
}

/* Accordion buttons ko design karein */
.accordion-button {
    background-color: #f8f9fa !important; /* light gray background */
    color: #343a40 !important; /* a slightly darker gray for better contrast */
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 1.25rem !important;
    padding: 1.25rem 1.5rem;
    transition: all 0.3s ease-in-out;
}

.accordion-button:hover {
    background-color: #e9ecef !important;
    color: #0d6efd !important; /* Blue on hover */
}

/* Jab button open ho to background aur text color change karein */
.accordion-button:not(.collapsed) {
    background-color: #0d6efd !important; /* Bootstrap's primary blue */
    color: #ffffff !important;
    box-shadow: none;
}

/* Jab accordion open ho to arrow ka color change karein */
.accordion-button:not(.collapsed)::after {
    filter: brightness(0) invert(1);
}

/* Accordion body ka text color */
.accordion-body {
    background-color: #ffffff; /* Accordion body ka background white rakhein */
    padding: 1.5rem;
}

.accordion-body p {
    color: #6c757d; /* Lighter gray text for better readability */
    margin-bottom: 0;
}
</style>
@endsection

@section('content')
<div class="container-fluid py-5"> {{-- Thoda zyada padding ke liye py-5 use kiya --}}
    <h4 class="mb-5 text-center text-primary fw-bold">FAQs (Help & Guide)</h4>

    <div class="card shadow-lg rounded-4 border-0">
        <div class="card-body p-lg-5 p-3"> {{-- Large screens ke liye zyada padding --}}
            <div class="accordion accordion-flush" id="adminFaqs">

                {{-- FAQ 1 --}}
                <div class="accordion-item border-bottom">
                    <h2 class="accordion-header" id="faqHeading1">
                        <button class="accordion-button fs-5 fw-bold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                            New user kaise banayein?
                        </button>
                    </h2>
                    <div id="faqCollapse1" class="accordion-collapse collapse show"
                        aria-labelledby="faqHeading1" data-bs-parent="#adminFaqs">
                        <div class="accordion-body">
                            <p><b>Answer:</b> "Users" menu me jaakar <code>Add User</code> button dabayein, 
                            form fill karke submit karen. System automatically naya user create karega.</p>
                        </div>
                    </div>
                </div>

                {{-- FAQ 2 --}}
                <div class="accordion-item border-bottom">
                    <h2 class="accordion-header" id="faqHeading2">
                        <button class="accordion-button collapsed fs-5 fw-bold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                            Role assign karne ka process kya hai?
                        </button>
                    </h2>
                    <div id="faqCollapse2" class="accordion-collapse collapse"
                        aria-labelledby="faqHeading2" data-bs-parent="#adminFaqs">
                        <div class="accordion-body">
                            <p><b>Answer:</b> "Users" list me jaakar desired user select karein. 
                            "Edit" option choose karke usko role assign karein 
                            (e.g., Admin, Teacher, Student) aur save karein.</p>
                        </div>
                    </div>
                </div>

                {{-- FAQ 3 --}}
                <div class="accordion-item border-bottom">
                    <h2 class="accordion-header" id="faqHeading3">
                        <button class="accordion-button collapsed fs-5 fw-bold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                            Reports export kaise karte hain?
                        </button>
                    </h2>
                    <div id="faqCollapse3" class="accordion-collapse collapse"
                        aria-labelledby="faqHeading3" data-bs-parent="#adminFaqs">
                        <div class="accordion-body">
                            <p><b>Answer:</b> "Reports" section open karein, date range select karein aur 
                            "Export to PDF/Excel" button par click karein.</p>
                        </div>
                    </div>
                </div>

                {{-- FAQ 4 --}}
                <div class="accordion-item border-bottom">
                    <h2 class="accordion-header" id="faqHeading4">
                        <button class="accordion-button collapsed fs-5 fw-bold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                            Profile image update kaise karun?
                        </button>
                    </h2>
                    <div id="faqCollapse4" class="accordion-collapse collapse"
                        aria-labelledby="faqHeading4" data-bs-parent="#adminFaqs">
                        <div class="accordion-body">
                            <p><b>Answer:</b> Top-right corner me apne profile pe click karein → "Profile Settings" 
                            choose karein → "Update Image" upload karein aur save karein.</p>
                        </div>
                    </div>
                </div>

            </div> {{-- accordion end --}}
        </div>
    </div>
</div>
@endsection