<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  SECTION: CONTACT US                                               ║
     ║  Light bg · info column + form column                              ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<?php
    $contactEmail = $contact['contactEmail']   ?? 'asogtbi@cspc.edu.ph';
    $contactAddr  = $contact['contactAddress'] ?? 'Camarines Sur Polytechnic Colleges, Nabua, Camarines Sur';
    $contactPhone = $contact['contactPhone']   ?? '';
    $fbUrl        = $contact['facebookUrl']    ?? '#';
    $igUrl        = $contact['instagramUrl']   ?? '#';
?>
<section id="contact" class="relative overflow-hidden bg-off py-16 md:py-24 px-6 md:px-10 lg:px-14">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>
    <div class="ai-cross hidden lg:block" style="top:30%;right:12%"></div>
    <div class="ai-cross hidden lg:block" style="bottom:22%;left:18%"></div>

    <div class="max-w-[1200px] mx-auto relative z-[2]">
        <div class="grid grid-cols-1 lg:grid-cols-[1fr_1px_1fr] gap-10 lg:gap-14">
            <!-- Left — Info -->
            <div class="reveal">
                <div class="flex items-center gap-2 mb-3">
                    <span class="block w-[18px] h-[1.5px] bg-gold"></span>
                    <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-gold">Get In Touch</span>
                </div>
                <h2 class="font-display text-3xl md:text-[2.1rem] leading-[1.12] text-dark mb-6">Contact <em class="italic text-gold">Us</em></h2>
                <div class="space-y-5">
                    <div>
                        <span class="text-[.54rem] font-bold tracking-[.16em] uppercase text-dark/30 block mb-1.5">Email</span>
                        <a href="mailto:<?= esc($contactEmail) ?>" class="text-[.9rem] text-dark/55 font-light no-underline hover:text-gold transition-colors duration-200"><?= esc($contactEmail) ?></a>
                    </div>
                    <?php if (! empty($contactPhone)): ?>
                    <div>
                        <span class="text-[.54rem] font-bold tracking-[.16em] uppercase text-dark/30 block mb-1.5">Phone</span>
                        <a href="tel:<?= esc($contactPhone) ?>" class="text-[.9rem] text-dark/55 font-light no-underline hover:text-gold transition-colors duration-200"><?= esc($contactPhone) ?></a>
                    </div>
                    <?php endif; ?>
                    <div>
                        <span class="text-[.54rem] font-bold tracking-[.16em] uppercase text-dark/30 block mb-1.5">Location</span>
                        <span class="text-[.9rem] text-dark/55 font-light"><?= esc($contactAddr) ?></span>
                    </div>
                    <div>
                        <span class="text-[.54rem] font-bold tracking-[.16em] uppercase text-dark/30 block mb-1.5">Social</span>
                        <div class="flex gap-3 mt-1">
                            <?php if (! empty($fbUrl) && $fbUrl !== '#'): ?>
                            <a href="<?= esc($fbUrl) ?>" target="_blank" rel="noopener"
                                class="text-[.6rem] font-semibold tracking-[.12em] uppercase text-dark/35 no-underline border border-dark/[.1] px-3 py-1.5 rounded-sm transition-colors duration-200 hover:text-gold hover:border-gold/40 hover:bg-gold/[.05]">Facebook</a>
                            <?php endif; ?>
                            <?php if (! empty($igUrl) && $igUrl !== '#'): ?>
                            <a href="<?= esc($igUrl) ?>" target="_blank" rel="noopener"
                                class="text-[.6rem] font-semibold tracking-[.12em] uppercase text-dark/35 no-underline border border-dark/[.1] px-3 py-1.5 rounded-sm transition-colors duration-200 hover:text-gold hover:border-gold/40 hover:bg-gold/[.05]">Instagram</a>
                            <?php endif; ?>
                            <?php if ((empty($fbUrl) || $fbUrl === '#') && (empty($igUrl) || $igUrl === '#')): ?>
                            <a href="#" class="text-[.6rem] font-semibold tracking-[.12em] uppercase text-dark/35 no-underline border border-dark/[.1] px-3 py-1.5 rounded-sm transition-colors duration-200 hover:text-gold hover:border-gold/40 hover:bg-gold/[.05]">Facebook</a>
                            <a href="#" class="text-[.6rem] font-semibold tracking-[.12em] uppercase text-dark/35 no-underline border border-dark/[.1] px-3 py-1.5 rounded-sm transition-colors duration-200 hover:text-gold hover:border-gold/40 hover:bg-gold/[.05]">Instagram</a>
                            <?php endif; ?>
                        </div>
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