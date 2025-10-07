<?php get_header(); ?>

<section id="hero">
  <h1>Welcome to Our Business</h1>
  <p>Your success is our priority. We deliver top-quality services.</p>
  <button class="cta" onclick="window.location.href='#contact'">Contact Us</button>
</section>

<section id="about">
  <h2>About Us</h2>
  <p>We are a dedicated team of professionals committed to providing excellent service in your industry.</p>
</section>

<section id="services">
  <h2>Our Services</h2>
  <ul>
    <li>Consulting & Strategy</li>
    <li>Marketing Solutions</li>
    <li>Product Development</li>
    <li>Customer Support</li>
  </ul>
</section>

<section id="recent-posts">
  <h2>Recent Blog Posts</h2>
  <ul>
    <?php
    $recent_posts = wp_get_recent_posts([
      'numberposts' => 5,
      'post_status' => 'publish'
    ]);
    foreach($recent_posts as $post) : ?>
      <li>
        <a href="<?php echo get_permalink($post['ID']); ?>">
          <?php echo esc_html($post['post_title']); ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</section>

<section id="contact">
  <h2>Contact Us</h2>
  <form method="post" action="">
    <label for="name">Name</label><br>
    <input id="name" name="name" required><br><br>

    <label for="email">Email</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="message">Message</label><br>
    <textarea id="message" name="message" rows="5" required></textarea><br><br>

    <button type="submit" class="cta">Send</button>
  </form>
</section>

<?php get_footer(); ?>