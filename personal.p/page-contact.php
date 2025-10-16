<?php
/*
Template Name: Contact Page
*/

get_header(); ?>

<main id="primary" class="site-main">
    
    <!-- Page Header -->
    <section style="background: linear-gradient(135deg, #333 0%, #555 100%); color: white; padding: 3rem 0; text-align: center;">
        <div class="container">
            <h1 style="font-size: 3rem; margin-bottom: 1rem;">Contact Us</h1>
            <p style="font-size: 1.2rem;">Get in touch with our automotive experts</p>
        </div>
    </section>

    <!-- Contact Content -->
    <section style="padding: 4rem 0;">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; margin-bottom: 4rem;">
                
                <!-- Contact Form -->
                <div>
                    <h2 style="margin-bottom: 2rem; color: #333;">Send us a Message</h2>
                    
                    <form class="contact-form" style="display: flex; flex-direction: column; gap: 1.5rem;">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <input type="text" name="first_name" placeholder="First Name" required 
                                   style="padding: 1rem; border: 2px solid #ddd; border-radius: 5px; font-size: 1rem;">
                            <input type="text" name="last_name" placeholder="Last Name" required 
                                   style="padding: 1rem; border: 2px solid #ddd; border-radius: 5px; font-size: 1rem;">
                        </div>
                        
                        <input type="email" name="email" placeholder="Email Address" required 
                               style="padding: 1rem; border: 2px solid #ddd; border-radius: 5px; font-size: 1rem;">
                        
                        <input type="tel" name="phone" placeholder="Phone Number" 
                               style="padding: 1rem; border: 2px solid #ddd; border-radius: 5px; font-size: 1rem;">
                        
                        <select name="inquiry_type" 
                                style="padding: 1rem; border: 2px solid #ddd; border-radius: 5px; font-size: 1rem;">
                            <option value="">Select Inquiry Type</option>
                            <option value="general">General Information</option>
                            <option value="specific_car">Specific Vehicle Inquiry</option>
                            <option value="financing">Financing Options</option>
                            <option value="trade_in">Trade-In Evaluation</option>
                            <option value="service">Service & Maintenance</option>
                            <option value="other">Other</option>
                        </select>
                        
                        <select name="preferred_contact" 
                                style="padding: 1rem; border: 2px solid #ddd; border-radius: 5px; font-size: 1rem;">
                            <option value="">Preferred Contact Method</option>
                            <option value="email">Email</option>
                            <option value="phone">Phone Call</option>
                            <option value="text">Text Message</option>
                        </select>
                        
                        <textarea name="message" placeholder="Your Message" rows="6" required 
                                  style="padding: 1rem; border: 2px solid #ddd; border-radius: 5px; font-size: 1rem; resize: vertical;"></textarea>
                        
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <input type="checkbox" id="consent" name="consent" required>
                            <label for="consent" style="font-size: 0.9rem; color: #666;">
                                I agree to receive communications from this dealership regarding my inquiry.
                            </label>
                        </div>
                        
                        <button type="submit" 
                                style="background: #ff6b35; color: white; border: none; padding: 1rem 2rem; border-radius: 5px; font-size: 1.1rem; font-weight: bold; cursor: pointer; transition: background 0.3s ease;">
                            Send Message
                        </button>
                    </form>
                </div>
                
                <!-- Contact Information -->
                <div>
                    <h2 style="margin-bottom: 2rem; color: #333;">Get in Touch</h2>
                    
                    <div style="display: flex; flex-direction: column; gap: 2rem;">
                        
                        <!-- Address -->
                        <div style="display: flex; gap: 1rem; align-items: flex-start;">
                            <div style="background: #ff6b35; color: white; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0;">
                                📍
                            </div>
                            <div>
                                <h4 style="margin-bottom: 0.5rem; color: #333;">Visit Our Showroom</h4>
                                <p style="color: #666; margin: 0; line-height: 1.6;">
                                    123 Auto Dealer Street<br>
                                    Car City, CC 12345<br>
                                    United States
                                </p>
                            </div>
                        </div>
                        
                        <!-- Phone -->
                        <div style="display: flex; gap: 1rem; align-items: flex-start;">
                            <div style="background: #ff6b35; color: white; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0;">
                                📞
                            </div>
                            <div>
                                <h4 style="margin-bottom: 0.5rem; color: #333;">Call Us</h4>
                                <p style="color: #666; margin: 0; line-height: 1.6;">
                                    Sales: <a href="tel:+15551234567" style="color: #ff6b35; text-decoration: none;">(555) 123-4567</a><br>
                                    Service: <a href="tel:+15551234568" style="color: #ff6b35; text-decoration: none;">(555) 123-4568</a><br>
                                    Parts: <a href="tel:+15551234569" style="color: #ff6b35; text-decoration: none;">(555) 123-4569</a>
                                </p>
                            </div>
                        </div>
                        
                        <!-- Email -->
                        <div style="display: flex; gap: 1rem; align-items: flex-start;">
                            <div style="background: #ff6b35; color: white; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0;">
                                ✉️
                            </div>
                            <div>
                                <h4 style="margin-bottom: 0.5rem; color: #333;">Email Us</h4>
                                <p style="color: #666; margin: 0; line-height: 1.6;">
                                    Sales: <a href="mailto:sales@autodealer.com" style="color: #ff6b35; text-decoration: none;">sales@autodealer.com</a><br>
                                    Service: <a href="mailto:service@autodealer.com" style="color: #ff6b35; text-decoration: none;">service@autodealer.com</a><br>
                                    General: <a href="mailto:info@autodealer.com" style="color: #ff6b35; text-decoration: none;">info@autodealer.com</a>
                                </p>
                            </div>
                        </div>
                        
                        <!-- Hours -->
                        <div style="display: flex; gap: 1rem; align-items: flex-start;">
                            <div style="background: #ff6b35; color: white; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0;">
                                🕒
                            </div>
                            <div>
                                <h4 style="margin-bottom: 0.5rem; color: #333;">Business Hours</h4>
                                <p style="color: #666; margin: 0; line-height: 1.6;">
                                    Monday - Friday: 9:00 AM - 7:00 PM<br>
                                    Saturday: 9:00 AM - 6:00 PM<br>
                                    Sunday: 11:00 AM - 5:00 PM
                                </p>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!-- Social Media -->
                    <div style="margin-top: 3rem;">
                        <h3 style="margin-bottom: 1rem; color: #333;">Follow Us</h3>
                        <div style="display: flex; gap: 1rem;">
                            <a href="#" style="display: inline-block; background: #3b5998; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                                f
                            </a>
                            <a href="#" style="display: inline-block; background: #1da1f2; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                                t
                            </a>
                            <a href="#" style="display: inline-block; background: #e4405f; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                                i
                            </a>
                            <a href="#" style="display: inline-block; background: #0077b5; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                                in
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Map Section -->
            <div style="background: #f8f9fa; padding: 2rem; border-radius: 10px; text-align: center;">
                <h3 style="margin-bottom: 1rem; color: #333;">Find Our Location</h3>
                <p style="color: #666; margin-bottom: 2rem;">Visit our showroom to see our vehicles in person</p>
                
                <!-- Map Placeholder -->
                <div style="width: 100%; height: 400px; background: linear-gradient(45deg, #ddd, #eee); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #666; font-size: 1.2rem;">
                    🗺️ Interactive Map (Google Maps Integration)
                </div>
                
                <p style="margin-top: 1rem; color: #666; font-size: 0.9rem;">
                    <a href="https://maps.google.com" target="_blank" style="color: #ff6b35; text-decoration: none;">
                        Get Directions on Google Maps
                    </a>
                </p>
            </div>
            
            <!-- Emergency Contact -->
            <div style="background: #333; color: white; padding: 2rem; border-radius: 10px; text-align: center; margin-top: 2rem;">
                <h3 style="color: #ff6b35; margin-bottom: 1rem;">24/7 Roadside Assistance</h3>
                <p style="margin-bottom: 1rem;">For emergencies and roadside assistance, call our 24/7 hotline:</p>
                <a href="tel:+15551234999" style="color: #ff6b35; font-size: 1.5rem; font-weight: bold; text-decoration: none;">
                    (555) 123-4999
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>