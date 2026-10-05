<!-- Floating Help Tab & Center Modal -->
<div id="floating-help-container">
    {{-- 1. Vertical Floating Tab Button on Right Side (Vertically Centered) --}}
    <button type="button" id="floatingHelpBtn" class="floating-help-tab" aria-label="Open Quick Help Modal"
        onclick="toggleHelpModal()">

        {{-- Vertical Text Label --}}
        <span class="tab-vertical-text">{{ __('Need Help?') }}</span>

    </button>

    {{-- 2. Dark Blurred Backdrop Overlay --}}
    <div id="helpModalBackdrop" class="help-modal-backdrop" onclick="closeHelpModal()"></div>

    {{-- 3. Center Popup Modal --}}
    <div id="helpModalDialog" class="help-modal-dialog" role="dialog" aria-modal="true"
        aria-labelledby="helpModalTitle">
        {{-- Modal Header --}}
        <div class="help-modal-header">
            <div class="d-flex align-items-center gap-3" style="gap: 1rem">
                <div class="help-modal-logo-icon">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="rotary-rotating-logo"
                        style="width: 34px; height: 34px; object-fit: contain;">
                </div>
                <div>
                    <h4 id="helpModalTitle" class="help-modal-title">{{ __('Need Assistance?') }}</h4>
                    <p class="help-modal-sub">{{ site_setting('org_name', 'Rotary Club of Shantinagar Dhaka') }}</p>
                </div>
            </div>
            <button type="button" class="help-modal-close-btn" onclick="closeHelpModal()" aria-label="Close Modal">
                <i class="fas fa-times"></i>
            </button>
        </div>

        {{-- Modal Body Form --}}
        <div class="help-modal-body scrollbar">
            <div class="help-intro-box mb-3">
                <p class="mb-0">
                    <i class="fas fa-info-circle me-1" style="color: var(--theme-primary, #005daa);"></i>
                    {{ __('Have questions about donations, relief projects, or volunteering? Leave your details below and our team will contact you.') }}
                </p>
            </div>

            {{-- Help Form (Name, Phone, Message) --}}
            <form id="quickHelpForm" action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="subject" value="Quick Help Inquiry (Center Modal)">

                {{-- Name --}}
                <div class="form-group mb-3">
                    <label for="help_name" class="form-label text-dark fw-bold" style="font-size: 13px;">
                        {{ __('Full Name') }} <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0" style="color: #64748b; font-size: 13px;">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" id="help_name" name="name" class="form-control border-start-0"
                            placeholder="{{ __('Enter your full name') }}" required style="font-size: 13.5px; height: 42px;">
                    </div>
                </div>

                {{-- Phone --}}
                <div class="form-group mb-3">
                    <label for="help_phone" class="form-label text-dark fw-bold" style="font-size: 13px;">
                        {{ __('Phone Number') }} <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0" style="color: #64748b; font-size: 13px;">
                            <i class="fas fa-phone"></i>
                        </span>
                        <input type="tel" id="help_phone" name="phone" class="form-control border-start-0"
                            placeholder="017XXXXXXXX" required style="font-size: 13.5px; height: 42px;">
                    </div>
                </div>

                {{-- Message --}}
                <div class="form-group mb-4">
                    <label for="help_message" class="form-label text-dark fw-bold" style="font-size: 13px;">
                        {{ __('Your Message / Question') }} <span class="text-danger">*</span>
                    </label>
                    <textarea id="help_message" name="message" class="form-control" rows="3"
                        placeholder="{{ __('How can we assist you today?') }}" required
                        style="font-size: 13.5px; resize: none;"></textarea>
                </div>

                {{-- Submit Button --}}
                <button type="submit" id="quickHelpSubmitBtn" class="help-modal-submit-btn">
                    <span id="quickHelpBtnText">{{ __('Send Message') }}</span>
                    <i id="quickHelpBtnIcon" class="fas fa-paper-plane ms-2"></i>
                </button>
            </form>

            {{-- Direct Hotline Call Box --}}
            <div class="help-modal-hotline mt-3 p-2 text-center">
                <span class="text-muted me-2" style="font-size: 11.5px; font-weight: 600; text-transform: uppercase;">{{ __('Or Call Directly:') }}</span>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', site_setting('hotline', '+8801711000000')) }}"
                    class="fw-bold text-decoration-none" style="color: var(--theme-primary, #005daa); font-size: 14px;">
                    <i class="fas fa-phone me-1"></i> {{ site_setting('hotline', '+880 1711-000000') }}
                </a>
            </div>
        </div>

        {{-- Modal Footer --}}
        <div class="help-modal-footer py-2 px-3 text-center border-top">
            {{ site_setting('org_name', 'Rotary Club of Shantinagar Dhaka') }} &bull; {{ __('Developed by') }} <strong
                style="color: var(--theme-primary, #005daa);">Inceptia</strong>
        </div>
    </div>
</div>

<style>
    /* ==========================================================================
       Floating Vertical Help Tab (Right Side, Vertically Middle)
       ========================================================================== */
    .floating-help-tab {
        position: fixed;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        z-index: 99998;
        background-color: var(--theme-primary, #005daa);
        color: #ffffff;
        border: 1.5px solid rgba(255, 255, 255, 0.25);
        border-right: none;
        border-radius: 14px 0 0 14px;
        padding: 12px 9px 12px 11px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        cursor: pointer;
        box-shadow: -4px 0 20px rgba(0, 93, 170, 0.35);
        transition: all 0.25s ease;
        outline: none;
        user-select: none;
    }

    .floating-help-tab:hover {
        background-color: var(--theme-secondary);
    }

    .floating-help-tab:hover .tab-vertical-text {
        color: var(--theme-primary);
    }

    .floating-help-tab .tab-icon-circle {
        width: 30px;
        height: 30px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        color: #ffffff;
        flex-shrink: 0;
    }

    .floating-help-tab .icon-close {
        display: none;
    }

    .floating-help-tab.is-active .icon-help {
        display: none;
    }

    .floating-help-tab.is-active .icon-close {
        display: inline-block;
    }

    .floating-help-tab.is-active {
        background-color: var(--theme-primary-hover, #004c8c);
        box-shadow: -4px 0 20px rgba(0, 93, 170, 0.45);
    }

    /* Vertical Text */
    .floating-help-tab .tab-vertical-text {
        writing-mode: vertical-rl;
        transform: rotate(180deg);
        font-size: 12.5px;
        font-weight: 700;
        letter-spacing: 0.06em;
        white-space: nowrap;
        color: #ffffff;
        padding: 3px 0;
        font-family: inherit;
    }

    /* Live Pulse Dot */
    .floating-help-tab .tab-live-indicator {
        position: relative;
        width: 12px;
        height: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .floating-help-tab .live-dot-core {
        width: 7px;
        height: 7px;
        background-color: #ffffff;
        border-radius: 50%;
    }

    .floating-help-tab .live-dot-ring {
        position: absolute;
        inset: 0;
        border-radius: 50%;
        border: 1.5px solid #ffffff;
        animation: helpLiveDotPulse 2s infinite;
    }

    @keyframes helpLiveDotPulse {
        0% {
            transform: scale(0.8);
            opacity: 1;
        }

        100% {
            transform: scale(2.2);
            opacity: 0;
        }
    }

    /* ==========================================================================
       Dark Blurred Backdrop Overlay
       ========================================================================== */
    .help-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.65);
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        z-index: 99999;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.25s ease, visibility 0.25s ease;
    }

    .help-modal-backdrop.is-open {
        opacity: 1;
        visibility: visible;
    }

    /* ==========================================================================
       Center Popup Modal Dialog
       ========================================================================== */
    .help-modal-dialog {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -46%) scale(0.95);
        width: 440px;
        max-width: calc(100vw - 32px);
        max-height: calc(100vh - 40px);
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
        z-index: 100000;
        opacity: 0;
        visibility: hidden;
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.25s ease, visibility 0.25s ease;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .help-modal-dialog.is-open {
        opacity: 1;
        visibility: visible;
        transform: translate(-50%, -50%) scale(1);
    }

    .help-modal-header {
        padding: 15px 18px;
        background: linear-gradient(135deg, var(--theme-primary, #005daa) 0%, #003e73 100%);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-shrink: 0;
    }

    .help-modal-logo-icon {
        width: 38px;
        height: 38px;
        background: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .help-modal-title {
        font-size: 16px;
        font-weight: 800;
        color: #ffffff;
        margin: 0;
        line-height: 1.2;
    }

    .help-modal-sub {
        font-size: 11.5px;
        color: rgba(255, 255, 255, 0.85);
        margin: 0;
    }

    .help-modal-close-btn {
        width: 32px;
        height: 32px;
        background: rgba(255, 255, 255, 0.15);
        border: none;
        border-radius: 50%;
        color: #ffffff;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.2s ease, transform 0.2s ease;
    }

    .help-modal-close-btn:hover {
        background: var(--theme-primary, #005daa);
        transform: rotate(90deg);
    }

    .help-modal-body {
        padding: 18px 20px;
        flex: 1 1 auto;
        overflow-y: auto;
    }

    .help-intro-box {
        background: #e8f1f8;
        border-left: 3px solid var(--theme-primary, #005daa);
        padding: 9px 12px;
        border-radius: 6px;
        font-size: 12px;
        color: #1e293b;
        line-height: 1.4;
    }

    .help-modal-body .form-control:focus {
        border-color: var(--theme-primary, #005daa);
        box-shadow: 0 0 0 3px rgba(0, 93, 170, 0.15);
        outline: none;
    }

    .help-modal-submit-btn {
        width: 100%;
        height: 44px;
        background: var(--theme-primary, #005daa);
        color: #ffffff;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .help-modal-submit-btn:hover {
        background: var(--theme-primary-hover, #004c8c);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 93, 170, 0.35);
    }

    .help-modal-hotline {
        background: #f8fafc;
        border-radius: 6px;
        border: 1px dashed #cbd5e1;
    }

    .help-modal-footer {
        background: #f8fafc;
        font-size: 11px;
        color: #64748b;
        flex-shrink: 0;
    }

    @media (max-width: 576px) {
        .help-modal-dialog {
            width: calc(100vw - 24px);
        }

        .floating-help-tab {
            padding: 10px 8px;
        }

        .floating-help-tab .tab-vertical-text {
            font-size: 11.5px;
        }
    }
</style>

<script>
    function toggleHelpModal() {
        const dialog = document.getElementById('helpModalDialog');
        const backdrop = document.getElementById('helpModalBackdrop');
        const btn = document.getElementById('floatingHelpBtn');

        if (dialog && dialog.classList.contains('is-open')) {
            closeHelpModal();
        } else {
            openHelpModal();
        }
    }

    function openHelpModal() {
        const dialog = document.getElementById('helpModalDialog');
        const backdrop = document.getElementById('helpModalBackdrop');
        const btn = document.getElementById('floatingHelpBtn');

        if (dialog) dialog.classList.add('is-open');
        if (backdrop) backdrop.classList.add('is-open');
        if (btn) btn.classList.add('is-active');
        document.body.style.overflow = 'hidden';
    }

    function closeHelpModal() {
        const dialog = document.getElementById('helpModalDialog');
        const backdrop = document.getElementById('helpModalBackdrop');
        const btn = document.getElementById('floatingHelpBtn');

        if (dialog) dialog.classList.remove('is-open');
        if (backdrop) backdrop.classList.remove('is-open');
        if (btn) btn.classList.remove('is-active');
        document.body.style.overflow = '';
    }

    // Close on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeHelpModal();
        }
    });

    // AJAX Form Handling for Smooth Instant User Experience
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('quickHelpForm');
        const submitBtn = document.getElementById('quickHelpSubmitBtn');
        const btnText = document.getElementById('quickHelpBtnText');
        const btnIcon = document.getElementById('quickHelpBtnIcon');

        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                if (submitBtn) submitBtn.disabled = true;
                if (btnText) btnText.textContent = 'Sending...';
                if (btnIcon) btnIcon.className = 'fas fa-spinner fa-spin ms-2';

                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                    .then(response => {
                        if (response.ok) {
                            return response.json().catch(() => ({ success: true }));
                        }
                        throw new Error('Network error');
                    })
                    .then(data => {
                        if (window.toastr) {
                            toastr.success('Thank you! Your message has been received. Our team will contact you shortly.', 'Inquiry Sent');
                        } else {
                            alert('Thank you! Your message has been received.');
                        }
                        form.reset();
                        setTimeout(function () {
                            closeHelpModal();
                        }, 1200);
                    })
                    .catch(error => {
                        // Fallback to regular form submission
                        form.submit();
                    })
                    .finally(() => {
                        if (submitBtn) submitBtn.disabled = false;
                        if (btnText) btnText.textContent = 'Send Message';
                        if (btnIcon) btnIcon.className = 'fas fa-paper-plane ms-2';
                    });
            });
        }
    });
</script>