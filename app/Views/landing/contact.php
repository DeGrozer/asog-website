<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  SECTION: CONTACT US                                               ║
     ║  Light bg · info column + form column                              ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<?php
    $contactEmail = 'asogtbi@cspc.edu.ph';
    $contactPhone = '+63 (054) 473-8226';
    $contactAddr  = 'Camarines Sur Polytechnic Colleges, San Miguel, Nabua, Camarines Sur';
    $fbUrl        = 'https://www.facebook.com/ASOGTBI';
    $igUrl        = 'https://www.instagram.com/ASOGTBI';
    $xUrl         = 'https://x.com/ASOGTBI';
    $threadsUrl   = 'https://www.threads.net/@ASOGTBI';
?>
<section id="contact" class="relative overflow-hidden bg-off py-16 md:py-24 px-6 md:px-10 lg:px-14">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>
    <div class="ai-cross hidden lg:block" style="top:30%;right:12%"></div>
    <div class="ai-cross hidden lg:block" style="bottom:22%;left:18%"></div>

    <div id="contact-details" class="scroll-mt-28"></div>

    <div class="max-w-[1200px] mx-auto relative z-[2]">
        <div class="grid grid-cols-1 lg:grid-cols-[1fr_1px_1fr] gap-10 lg:gap-14">
            <!-- Left — Contact Details -->
            <div class="reveal">
                <div class="flex items-center gap-2 mb-3">
                    <span class="block w-[18px] h-[1.5px] bg-gold"></span>
                    <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-gold">Get In Touch</span>
                </div>
                <h2 class="font-display text-3xl md:text-[2.1rem] leading-[1.12] text-dark mb-6">Contact <em class="italic text-gold">Us</em></h2>

                <!-- Contact Details -->
                <div class="space-y-5 mb-8">
                    <div>
                        <span class="text-[.54rem] font-bold tracking-[.16em] uppercase text-dark/30 block mb-1.5">Email</span>
                        <a href="mailto:<?= esc($contactEmail) ?>" class="text-[.9rem] text-dark/70 font-light no-underline hover:text-gold transition-colors duration-200"><?= esc($contactEmail) ?></a>
                    </div>
                    <div>
                        <span class="text-[.54rem] font-bold tracking-[.16em] uppercase text-dark/30 block mb-1.5">Phone</span>
                        <a href="tel:<?= esc($contactPhone) ?>" class="text-[.9rem] text-dark/70 font-light no-underline hover:text-gold transition-colors duration-200"><?= esc($contactPhone) ?></a>
                    </div>
                    <div>
                        <span class="text-[.54rem] font-bold tracking-[.16em] uppercase text-dark/30 block mb-1.5">Location</span>
                        <span class="text-[.9rem] text-dark/70 font-light"><?= esc($contactAddr) ?></span>
                    </div>
                </div>

                <!-- Social Media -->
                <div>
                    <span class="text-[.54rem] font-bold tracking-[.16em] uppercase text-dark/30 block mb-3">Follow Us</span>
                    <div class="flex flex-wrap gap-3">
                        <a href="<?= esc($fbUrl !== '#' && ! empty($fbUrl) ? $fbUrl : 'https://facebook.com') ?>" target="_blank" rel="noopener"
                            class="group flex items-center gap-2 text-dark/50 no-underline border border-dark/[.1] px-4 py-2.5 rounded-sm transition-all duration-200 hover:text-gold hover:border-gold/40 hover:bg-gold/[.05]">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            <span class="text-[.6rem] font-semibold tracking-[.12em] uppercase">Facebook</span>
                        </a>
                        <a href="<?= esc($igUrl !== '#' && ! empty($igUrl) ? $igUrl : 'https://instagram.com') ?>" target="_blank" rel="noopener"
                            class="group flex items-center gap-2 text-dark/50 no-underline border border-dark/[.1] px-4 py-2.5 rounded-sm transition-all duration-200 hover:text-gold hover:border-gold/40 hover:bg-gold/[.05]">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            <span class="text-[.6rem] font-semibold tracking-[.12em] uppercase">Instagram</span>
                        </a>
                        <a href="<?= esc($xUrl !== '#' && ! empty($xUrl) ? $xUrl : 'https://x.com') ?>" target="_blank" rel="noopener"
                            class="group flex items-center gap-2 text-dark/50 no-underline border border-dark/[.1] px-4 py-2.5 rounded-sm transition-all duration-200 hover:text-gold hover:border-gold/40 hover:bg-gold/[.05]">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            <span class="text-[.6rem] font-semibold tracking-[.12em] uppercase">X</span>
                        </a>
                        <a href="<?= esc($threadsUrl !== '#' && ! empty($threadsUrl) ? $threadsUrl : 'https://threads.net') ?>" target="_blank" rel="noopener"
                            class="group flex items-center gap-2 text-dark/50 no-underline border border-dark/[.1] px-4 py-2.5 rounded-sm transition-all duration-200 hover:text-gold hover:border-gold/40 hover:bg-gold/[.05]">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.186 24h-.007c-3.581-.024-6.334-1.205-8.184-3.509C2.35 18.44 1.5 15.586 1.472 12.01v-.017c.03-3.579.879-6.43 2.525-8.482C5.845 1.205 8.6.024 12.18 0h.014c2.746.02 5.043.725 6.826 2.098 1.677 1.29 2.858 3.13 3.509 5.467l-2.04.569c-1.104-3.96-3.898-5.984-8.304-6.015-2.91.022-5.11.936-6.54 2.717C4.307 6.504 3.616 8.914 3.59 12c.025 3.086.718 5.496 2.057 7.164 1.432 1.781 3.632 2.695 6.54 2.717 2.227-.017 4.074-.582 5.49-1.68 1.295-1.005 2.039-2.37 2.213-4.07.12-1.162-.073-2.12-.576-2.847-.376-.544-.905-.942-1.55-1.18a9.2 9.2 0 01-.124 2.394c-.309 1.58-1.004 2.816-2.07 3.674-1.097.884-2.512 1.352-4.09 1.352h-.009c-1.256-.009-2.398-.36-3.3-1.015-1.042-.757-1.67-1.878-1.768-3.152-.098-1.286.396-2.47 1.39-3.335.886-.77 2.1-1.225 3.509-1.316 1.104-.071 2.12.033 3.042.306-.057-.76-.282-1.347-.672-1.746-.486-.497-1.27-.755-2.327-.766h-.058c-.79.007-1.718.2-2.499.546l-.835-1.812c1.005-.464 2.218-.726 3.39-.737h.076c1.563.019 2.812.494 3.716 1.415.758.773 1.212 1.8 1.347 3.05.49.122.942.29 1.352.506 1.16.613 2.017 1.573 2.481 2.775.441 1.145.516 2.503.217 3.927-.377 1.792-1.387 3.337-2.913 4.458C17.623 23.254 15.14 23.98 12.186 24zm-1.584-8.063c-.018 0-.035 0-.053.001-.857.055-1.544.305-1.985.724-.406.385-.583.897-.528 1.524.056.627.373 1.164.918 1.56.584.425 1.36.644 2.306.65h.006c1.133 0 2.05-.318 2.726-.944.657-.608 1.075-1.47 1.243-2.558a7.5 7.5 0 00.096-1.278c-.68-.28-1.56-.454-2.622-.454-.668 0-1.369.06-2.107.175z"/></svg>
                            <span class="text-[.6rem] font-semibold tracking-[.12em] uppercase">Threads</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Divider (desktop only) -->
            <div class="hidden lg:block bg-dark/[.08] reveal reveal-d1"></div>

            <!-- Right — Form -->
            <div class="reveal reveal-d2">
                <form action="<?= site_url('contact/send') ?>" method="post" class="space-y-5">
                    <?= csrf_field() ?>
                    <div>
                        <label class="text-[.54rem] font-bold tracking-[.50em] uppercase text-dark/60 block mb-2">Name</label>
                        <input type="text" name="name"
                            class="w-full bg-white border border-dark/[.2] rounded-sm px-4 py-3 text-[.85rem] text-dark font-light outline-none transition-colors duration-200 focus:border-gold/50 focus:shadow-sm focus:shadow-gold/10 placeholder:text-dark/45"
                            placeholder="Your full name" required>
                    </div>
                    <div>
                        <label class="text-[.54rem] font-bold tracking-[.16em] uppercase text-dark/60 block mb-2">Email</label>
                        <input type="email" name="email"
                            class="w-full bg-white border border-dark/[.2] rounded-sm px-4 py-3 text-[.85rem] text-dark font-light outline-none transition-colors duration-200 focus:border-gold/50 focus:shadow-sm focus:shadow-gold/10 placeholder:text-dark/45"
                            placeholder="your@email.com" required>
                    </div>
                    <div>
                        <label class="text-[.54rem] font-bold tracking-[.16em] uppercase text-dark/60 block mb-2">Message</label>
                        <textarea rows="4" name="message"
                            class="w-full bg-white border border-dark/[.2] rounded-sm px-4 py-3 text-[.85rem] text-dark font-light outline-none resize-none transition-colors duration-200 focus:border-gold/50 focus:shadow-sm focus:shadow-gold/10 placeholder:text-dark/45"
                            placeholder="How can we help?" required></textarea>
                    </div>
                    <button type="submit"
                        class="font-body text-[.65rem] font-bold tracking-[.14em] uppercase text-dark bg-gold px-8 py-3 rounded-sm border-none cursor-pointer transition-all duration-200 hover:bg-gold-dk">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>