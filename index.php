<?php require "config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kaser Diafa - Restaurant</title>
<link rel="stylesheet" href="style/main.css">
<script src="https://kit.fontawesome.com/4f5f087331.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include "partials/header.php"; ?>

<!-- HERO SECTION -->
    <section id="hero" style="background: url('hero_photo/hero-image.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; min-height: 80vh; display: flex; align-items: center; justify-content: center; text-align: center; color: white; position: relative; overflow: hidden;">
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.6);"></div>
    <div class="hero-content" style="position: relative; z-index: 2; max-width: 800px; padding: 0 2rem;">
        <h1 style="font-size: 3.5rem; font-weight: 700; margin-bottom: 1.5rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);color: #d97706;">Welcome to Kaser Diafa</h1>
        <p style="font-size: 1.25rem; margin-bottom: 2rem; opacity: 0.9; line-height: 1.6;">Experience the authentic Moroccan and Mediterranean flavors in a warm and luxurious atmosphere.</p>
        <a href="order.php" style="background: white; color: #d97706; padding: 1rem 2rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 1.125rem; display: inline-block; transition: all 0.3s; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">Order Now</a>
    </div>
</section>

<main style="max-width: 1200px; margin: 0 auto; padding: 4rem 2rem;">
    <!-- ABOUT SECTION -->
    <section id="about" style="margin-bottom: 4rem;">
        <h2 style="text-align: center; font-size: 2.5rem; font-weight: 600; color: #e5e5e5; margin-bottom: 3rem;">About Kaser Diafa</h2>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center; margin-bottom: 3rem;">
            <div>
                <h3 style="color: #d97706; font-size: 1.5rem; margin-bottom: 1rem;">Welcome to Our Restaurant</h3>
                <p style="color: #6b7280; line-height: 1.6; margin-bottom: 1.5rem;">Kaser Diafa is a family-owned restaurant that brings the authentic flavors of Moroccan and Mediterranean cuisine to your table. Since 2010, we've been serving delicious meals made with fresh, local ingredients and traditional recipes passed down through generations.</p>
                <h4 style="color: #d97706; font-size: 1.25rem; margin-bottom: 1rem;">Our Story</h4>
                <p style="color: #6b7280; line-height: 1.6;">Founded by the Alami family, Kaser Diafa (meaning "House of Hospitality") was born from a passion for sharing the rich culinary heritage of Morocco. Every dish tells a story of tradition, love, and the warm hospitality that Morocco is famous for.</p>
            </div>
            <div style="background: #1a1a1a; border-radius: 12px; padding: 3rem; text-align: center; border: 2px solid #333;">
                <i class="fas fa-utensils" style="font-size: 4rem; color: #d97706; margin-bottom: 1rem;"></i>
                <h4 style="color: #e5e5e5; margin-bottom: 0.5rem;">Authentic Moroccan Cuisine</h4>
                <p style="color: #6b7280;">Traditional recipes with modern presentation</p>
                </div>
            </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem;">
            <div style="background: #1a1a1a; padding: 2rem; border-radius: 12px; text-align: center; box-shadow: 0 1px 3px rgba(0,0,0,0.3); border: 1px solid #333;">
                <i class="fas fa-leaf" style="font-size: 2.5rem; color: #d97706; margin-bottom: 1rem;"></i>
                <h4 style="color: #e5e5e5; margin-bottom: 0.5rem;">Fresh Ingredients</h4>
                <p style="color: #9ca3af; font-size: 0.875rem;">Locally sourced, daily fresh</p>
            </div>
            <div style="background: #1a1a1a; padding: 2rem; border-radius: 12px; text-align: center; box-shadow: 0 1px 3px rgba(0,0,0,0.3); border: 1px solid #333;">
                <i class="fas fa-heart" style="font-size: 2.5rem; color: #d97706; margin-bottom: 1rem;"></i>
                <h4 style="color: #e5e5e5; margin-bottom: 0.5rem;">Family Recipes</h4>
                <p style="color: #9ca3af; font-size: 0.875rem;">Passed down through generations</p>
            </div>
            <div style="background: #1a1a1a; padding: 2rem; border-radius: 12px; text-align: center; box-shadow: 0 1px 3px rgba(0,0,0,0.3); border: 1px solid #333;">
                <i class="fas fa-star" style="font-size: 2.5rem; color: #d97706; margin-bottom: 1rem;"></i>
                <h4 style="color: #e5e5e5; margin-bottom: 0.5rem;">Quality Service</h4>
                <p style="color: #9ca3af; font-size: 0.875rem;">Exceptional hospitality</p>
        </div>
        </div>
    </section>

    <!-- SERVICES SECTION -->
    <section id="services" style="margin-bottom: 4rem;">
        <h2 style="text-align: center; font-size: 2.5rem; font-weight: 600; color: #e5e5e5; margin-bottom: 3rem;">Our Services</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
            <div style="background: #1a1a1a; padding: 2rem; border-radius: 12px; text-align: center; box-shadow: 0 1px 3px rgba(0,0,0,0.3); border: 1px solid #333; transition: transform 0.3s;">
                <i class="fas fa-utensils" style="font-size: 3rem; color: #d97706; margin-bottom: 1rem;"></i>
                <h3 style="color: #e5e5e5; margin-bottom: 1rem; font-size: 1.25rem;">Dine-In</h3>
                <p style="color: #9ca3af; line-height: 1.6;">Enjoy our warm atmosphere and excellent service in our beautifully decorated restaurant.</p>
            </div>
            <div style="background: #1a1a1a; padding: 2rem; border-radius: 12px; text-align: center; box-shadow: 0 1px 3px rgba(0,0,0,0.3); border: 1px solid #333; transition: transform 0.3s;">
                <i class="fas fa-shopping-bag" style="font-size: 3rem; color: #d97706; margin-bottom: 1rem;"></i>
                <h3 style="color: #e5e5e5; margin-bottom: 1rem; font-size: 1.25rem;">Takeaway</h3>
                <p style="color: #9ca3af; line-height: 1.6;">Quick and convenient takeaway service for your favorite Moroccan dishes.</p>
            </div>
            <div style="background: #1a1a1a; padding: 2rem; border-radius: 12px; text-align: center; box-shadow: 0 1px 3px rgba(0,0,0,0.3); border: 1px solid #333; transition: transform 0.3s;">
                <i class="fas fa-motorcycle" style="font-size: 3rem; color: #d97706; margin-bottom: 1rem;"></i>
                <h3 style="color: #e5e5e5; margin-bottom: 1rem; font-size: 1.25rem;">Delivery</h3>
                <p style="color: #9ca3af; line-height: 1.6;">Fast and reliable delivery service to bring our delicious food right to your doorstep.</p>
            </div>
            <div style="background: #1a1a1a; padding: 2rem; border-radius: 12px; text-align: center; box-shadow: 0 1px 3px rgba(0,0,0,0.3); border: 1px solid #333; transition: transform 0.3s;">
                <i class="fas fa-calendar-alt" style="font-size: 3rem; color: #d97706; margin-bottom: 1rem;"></i>
                <h3 style="color: #e5e5e5; margin-bottom: 1rem; font-size: 1.25rem;">Catering</h3>
                <p style="color: #9ca3af; line-height: 1.6;">Special events and celebrations made memorable with our professional catering services.</p>
            </div>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section id="contact" style="margin-bottom: 4rem;">
        <h2 style="text-align: center; font-size: 2.5rem; font-weight: 600; color: #e5e5e5; margin-bottom: 3rem;">Contact Us</h2>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem;">
            <div>
                <h3 style="color: #d97706; font-size: 1.5rem; margin-bottom: 1rem;">Get in Touch</h3>
                <p style="color: #9ca3af; margin-bottom: 2rem; line-height: 1.6;">Contact us for reservations, questions, or feedback.</p>
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <div style="display: flex; align-items: center; gap: 1rem; background: #1a1a1a; padding: 1.5rem; border-radius: 8px; border: 1px solid #333;">
                        <i class="fas fa-map-marker-alt" style="font-size: 1.5rem; color: #d97706;"></i>
                        <div>
                            <h4 style="color: #e5e5e5; margin-bottom: 0.25rem;">Address</h4>
                            <p style="color: #9ca3af; margin: 0;">123 Restaurant Street<br>Casablanca, Morocco</p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 1rem; background: #1a1a1a; padding: 1.5rem; border-radius: 8px; border: 1px solid #333;">
                        <i class="fas fa-phone" style="font-size: 1.5rem; color: #d97706;"></i>
                        <div>
                            <h4 style="color: #e5e5e5; margin-bottom: 0.25rem;">Phone</h4>
                            <p style="color: #9ca3af; margin: 0;">+212 5 22 123 456</p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 1rem; background: #1a1a1a; padding: 1.5rem; border-radius: 8px; border: 1px solid #333;">
                        <i class="fas fa-envelope" style="font-size: 1.5rem; color: #d97706;"></i>
                        <div>
                            <h4 style="color: #e5e5e5; margin-bottom: 0.25rem;">Email</h4>
                            <p style="color: #9ca3af; margin: 0;">info@kaserdiafa.com</p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 1rem; background: #1a1a1a; padding: 1.5rem; border-radius: 8px; border: 1px solid #333;">
                        <i class="fas fa-clock" style="font-size: 1.5rem; color: #d97706;"></i>
                        <div>
                            <h4 style="color: #e5e5e5; margin-bottom: 0.25rem;">Hours</h4>
                            <p style="color: #9ca3af; margin: 0;">Mon-Sun: 11:00 AM - 11:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>
            <div style="background: #1a1a1a; padding: 2rem; border-radius: 12px; border: 1px solid #333;">
                <h3 style="color: #d97706; font-size: 1.5rem; margin-bottom: 1.5rem; text-align: center;">Send us a Message</h3>
                <form>
                    <div style="margin-bottom: 1rem;">
                        <input type="text" placeholder="Your Name" required style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 6px; font-size: 1rem; background: #2a2a2a; color: #e5e5e5;">
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <input type="email" placeholder="Your Email" required style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 6px; font-size: 1rem; background: #2a2a2a; color: #e5e5e5;">
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <input type="text" placeholder="Subject" style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 6px; font-size: 1rem; background: #2a2a2a; color: #e5e5e5;">
                    </div>
                    <div style="margin-bottom: 1.5rem;">
                        <textarea placeholder="Your Message" rows="5" required style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 6px; font-size: 1rem; resize: vertical; background: #2a2a2a; color: #e5e5e5;"></textarea>
                    </div>
                    <button type="submit" style="width: 100%; background: #d97706; color: #fff; border: none; border-radius: 6px; padding: 0.75rem; font-size: 1rem; font-weight: 600; cursor: pointer; transition: background 0.2s;">Send Message</button>
                </form>
            </div>
        </div>
    </section>
</main>

<style>
/* Responsive Design for Index */
@media (max-width: 768px) {
    #hero h1 {
        font-size: 2.5rem !important;
    }
    
    #hero p {
        font-size: 1rem !important;
    }
    
    main {
        padding: 2rem 1rem !important;
    }
    
    section {
        margin-bottom: 2rem !important;
    }
    
    h2 {
        font-size: 2rem !important;
    }
    
    .about-content {
        grid-template-columns: 1fr !important;
        gap: 2rem !important;
    }
    
    .contact-content {
        grid-template-columns: 1fr !important;
        gap: 2rem !important;
    }
    
    .services-grid {
        grid-template-columns: 1fr !important;
    }
    
    .features-grid {
        grid-template-columns: 1fr !important;
    }
}

/* Hover Effects */
.service-card:hover,
.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important;
}

#hero a:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.3) !important;
}
</style>

<?php include "partials/footer.php"; ?>
</body>
</html>
