

<?php ($pageTitle = 'Aurelia Travel | Luxury Tourism'); ?>

<?php $__env->startSection('content'); ?>
    <div class="home-page">
        <section class="home-hero">
            <div class="container-fluid px-3 px-lg-4">
                <div class="home-hero__shell reveal" style="background-image:url('<?php echo e(asset('assets/desa.jpg')); ?>')">
                    <div class="home-hero__overlay"></div>

                    <div class="home-hero__content">
                        <form id="heroSearch" class="home-search" autocomplete="off">
                            <div class="home-search__field home-search__field--input">
                                <i class="bi bi-search"></i>
                                <input id="searchInput" type="text" class="form-control" placeholder="Where to?">
                            </div>
                            <div class="home-search__field home-search__field--meta">
                                <i class="bi bi-calendar3"></i>
                                <span>Check in - Check out</span>
                            </div>
                            <div class="home-search__field home-search__field--meta">
                                <i class="bi bi-person"></i>
                                <span>Travelers <strong>2</strong></span>
                            </div>
                            <button type="submit" class="home-search__submit" aria-label="Search destinations">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>

                        <div class="home-stats mt-4">
                            <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="home-stat-card">
                                    <div class="home-stat-value"><?php echo e($stat['value']); ?></div>
                                    <div class="home-stat-label"><?php echo e($stat['label']); ?></div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <div class="home-hero__micro mt-4">
                            <div><i class="bi bi-shield-check me-2"></i>No hidden fees</div>
                            <div><i class="bi bi-award me-2"></i>Best price guarantee</div>
                            <div><i class="bi bi-headset me-2"></i>Fast & easy booking</div>
                        </div>
                    </div>

                    <div class="home-hero__badge">
                        <i class="bi bi-telephone-fill me-2"></i>
                        Concierge 24/7
                    </div>
                </div>
            </div>
        </section>

        <section class="home-section home-section--luxury-destinations">
            <div class="container">
                <div class="luxury-section-head reveal">
                    <div>
                        <div class="section-kicker">Popular destinations</div>
                        <h2 class="home-section__title">Big, calm cards with a luxury feel</h2>
                    </div>
                    <a class="home-link" href="<?php echo e(route('destinations')); ?>">View all destinations <i
                            class="bi bi-arrow-right"></i></a>
                </div>

                <div class="luxury-destination-grid">
                    <?php $__currentLoopData = array_slice($destinations, 0, 5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $destination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <article class="luxury-destination-card reveal"
                            data-search="<?php echo e($destination['name'] . ' ' . $destination['country'] . ' ' . $destination['tag']); ?>"
                            style="background-image:url('<?php echo e($destination['image']); ?>')">
                            <div class="luxury-destination-card__overlay"></div>
                            <div class="luxury-destination-card__ring"></div>
                            <div class="luxury-destination-card__content">
                                <span class="luxury-destination-card__eyebrow"><?php echo e($destination['tag']); ?></span>
                                <h3><?php echo e($destination['name']); ?></h3>
                                <p><?php echo e($destination['country']); ?></p>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <aside class="luxury-offer-card reveal">
                        <div class="luxury-offer-card__top">
                            <div class="luxury-offer-card__eyebrow">Limited Time Offer</div>
                            <div class="luxury-offer-card__sub">Curated luxury escapes</div>
                        </div>

                        <div class="luxury-offer-card__timer">
                            <div><strong>02</strong><span>Days</span></div>
                            <div><strong>18</strong><span>Hrs</span></div>
                            <div><strong>46</strong><span>Mins</span></div>
                            <div><strong>32</strong><span>Secs</span></div>
                        </div>

                        <div class="luxury-offer-card__body">
                            <h3>Up to 35% OFF</h3>
                            <p>Save on selected luxury tours, curated experiences, and premium escape packages.</p>
                        </div>

                        <a class="btn btn-light rounded-pill px-4 fw-semibold luxury-offer-card__cta"
                            href="<?php echo e(route('packages')); ?>">Explore Deals <i class="bi bi-arrow-right ms-1"></i></a>
                    </aside>
                </div>
            </div>
        </section>

        <section class="home-section home-section--featured">
            <div class="container">
                <article class="featured-journey reveal" style="background-image:url('<?php echo e(asset('assets/world.jpg')); ?>')">
                    <div class="featured-journey__overlay"></div>
                    <div class="featured-journey__body">
                        <div class="featured-journey__label">Featured Journey</div>
                        <h2>Swiss Alps Luxury Escape</h2>
                        <p>Breathtaking landscapes, premium stays, and unforgettable experiences.</p>

                        <div class="featured-journey__meta">
                            <span><i class="bi bi-clock me-1"></i>6 Days / 5 Nights</span>
                            <span><i class="bi bi-buildings me-1"></i>Luxury Hotels</span>
                            <span><i class="bi bi-person-check me-1"></i>Private Guide</span>
                            <span><i class="bi bi-ticket-perforated me-1"></i>All Inclusive</span>
                        </div>

                        <div class="featured-journey__price-row">
                            <div>
                                <div class="featured-journey__from">From</div>
                                <div class="featured-journey__price">$2,980 <small>/person</small></div>
                            </div>
                            <a href="<?php echo e(route('booking.create')); ?>"
                                class="btn btn-primary rounded-pill px-4 fw-semibold">Explore Journey <i
                                    class="bi bi-arrow-right ms-1"></i></a>
                        </div>
                    </div>

                    <div class="featured-journey__rating">
                        <div class="featured-journey__avatars">
                            <?php $__currentLoopData = array_slice($testimonials, 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <img src="<?php echo e($item['image']); ?>" alt="<?php echo e($item['name']); ?>">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="featured-journey__stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <div class="featured-journey__score">4.9/5</div>
                        <div class="featured-journey__sub">From 1,248 reviews</div>
                    </div>

                    <button class="featured-journey__play" type="button" aria-label="Watch experience">
                        <i class="bi bi-play-fill"></i>
                    </button>
                </article>
            </div>
        </section>

        <section class="home-section">
            <div class="container">
                <div class="d-flex align-items-end justify-content-between gap-3 mb-4 flex-wrap">
                    <div>
                        <div class="section-kicker reveal">Top experiences</div>
                        <h2 class="home-section__title reveal">Curated luxury experiences just for you</h2>
                    </div>
                    <a class="home-link reveal" href="<?php echo e(route('packages')); ?>">View all packages <i
                            class="bi bi-arrow-right"></i></a>
                </div>

                <div class="experience-grid">
                    <?php $__currentLoopData = array_slice($featuredTours, 0, 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <article class="experience-card reveal"
                            data-search="<?php echo e($tour['title'] . ' ' . $tour['category'] . ' ' . $tour['days']); ?>">
                            <div class="experience-card__image" style="background-image:url('<?php echo e($tour['image']); ?>')">
                                <span class="experience-card__badge"><?php echo e(ucfirst($tour['category'])); ?></span>
                            </div>
                            <div class="experience-card__content">
                                <div class="experience-card__title-row">
                                    <h3><?php echo e($tour['title']); ?></h3>
                                    <span class="experience-card__rating"><i class="bi bi-star-fill"></i>
                                        <?php echo e($tour['rating']); ?></span>
                                </div>
                                <div class="experience-card__meta">
                                    <span><?php echo e($tour['days']); ?></span>
                                    <span><?php echo e($tour['category']); ?> experience</span>
                                </div>
                                <div class="experience-card__price">From <?php echo e($tour['price']); ?> /person</div>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>

        <section class="home-section home-section--cta">
            <div class="container">
                <div class="newsletter-banner reveal">
                    <div>
                        <h2>Get exclusive travel deals & inspiration</h2>
                        <p>Join the newsletter and save up to 30% on your next adventure.</p>
                    </div>
                    <form class="newsletter-banner__form" action="#" method="post" onsubmit="return false;">
                        <input type="email" class="form-control" placeholder="Enter your email">
                        <button class="btn btn-primary rounded-pill px-4 fw-semibold" type="submit">Subscribe Now <i
                                class="bi bi-arrow-right ms-1"></i></button>
                    </form>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\faim\trash\aurelia_laravel\resources\views/home/index.blade.php ENDPATH**/ ?>