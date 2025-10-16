<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3><?php bloginfo('name'); ?></h3>
                <p><?php bloginfo('description'); ?></p>
                <p>Your trusted partner in finding the perfect vehicle. We pride ourselves on quality, service, and customer satisfaction.</p>
            </div>
            
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="<?php echo home_url(); ?>">Home</a></li>
                    <li><a href="<?php echo get_post_type_archive_link('car'); ?>">Browse Cars</a></li>
                    <li><a href="<?php echo home_url('/financing'); ?>">Financing</a></li>
                    <li><a href="<?php echo home_url('/about'); ?>">About Us</a></li>
                    <li><a href="<?php echo home_url('/contact'); ?>">Contact</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Services</h3>
                <ul>
                    <li><a href="#">Vehicle Sales</a></li>
                    <li><a href="#">Trade-In Evaluation</a></li>
                    <li><a href="#">Financing Options</a></li>
                    <li><a href="#">Extended Warranties</a></li>
                    <li><a href="#">Vehicle History Reports</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Contact Info</h3>
                <p>📍 123 Auto Dealer Street<br>Car City, CC 12345</p>
                <p>📞 (555) 123-4567</p>
                <p>✉️ info@autodealer.com</p>
                <p>🕒 Mon-Sat: 9AM-7PM<br>Sunday: 11AM-5PM</p>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved. | Designed by MiniMax Agent</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>