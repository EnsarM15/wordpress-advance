# AutoDealer Pro WordPress Theme

A professional WordPress theme designed specifically for car dealerships and automotive sales websites.

## Features

- **Custom Car Post Type**: Dedicated post type for vehicles with detailed specifications
- **Advanced Search & Filtering**: Search by make, model, year, price, mileage, and condition
- **Responsive Design**: Fully responsive layout that works on all devices
- **Car Taxonomies**: Organized by make, model, year, and condition
- **Detailed Car Pages**: Individual pages for each vehicle with specifications, features, and contact forms
- **Professional Styling**: Modern, clean design optimized for automotive sales
- **Contact Integration**: Built-in contact forms and inquiry systems
- **Image Galleries**: Support for multiple car images (extensible)
- **Comparison Feature**: Side-by-side vehicle comparison functionality
- **SEO Optimized**: Clean, semantic HTML structure
- **Customizable**: WordPress Customizer integration for easy modifications

## Installation

1. **Download the theme files** to your computer
2. **Upload to WordPress**:
   - Login to your WordPress admin dashboard
   - Go to Appearance > Themes
   - Click "Add New" then "Upload Theme"
   - Select the theme zip file and click "Install Now"
   - Activate the theme

3. **Alternative Installation**:
   - Upload the theme folder to `/wp-content/themes/` directory
   - Go to Appearance > Themes in WordPress admin
   - Activate "AutoDealer Pro"

## Setup Instructions

### 1. Initial Configuration

After activating the theme:

1. **Set Permalinks**: Go to Settings > Permalinks and choose "Post name" or "Custom Structure"
2. **Create Menus**: Go to Appearance > Menus and create a primary navigation menu
3. **Configure Theme**: Go to Appearance > Customize to set hero text and other options

### 2. Adding Cars

1. **Navigate to Cars**: In your WordPress admin, you'll see a new "Cars" menu item
2. **Add New Car**: Click "Add New Car" to create your first vehicle listing
3. **Fill in Details**:
   - Title: Enter the car name/title
   - Content: Add detailed description
   - Featured Image: Upload the main car image
   - Car Details: Fill in the custom fields (price, mileage, engine, etc.)
   - Taxonomies: Set the make, model, year, and condition

### 3. Organizing Cars

**Car Makes**: Go to Cars > Makes to add car manufacturers (Toyota, Honda, etc.)
**Car Models**: Go to Cars > Models to add specific models (Camry, Civic, etc.)
**Car Years**: Go to Cars > Years to add model years (2020, 2021, etc.)
**Car Conditions**: Go to Cars > Conditions to add conditions (New, Used, Certified Pre-Owned)

### 4. Pages to Create

Create these essential pages:

- **Home**: Use the default homepage or create a custom one
- **Cars**: This is automatically created for the car archive
- **About**: Create an about page for your dealership
- **Contact**: Create a contact page with your information
- **Financing**: Optional page for financing information
- **Compare**: Use the included comparison template

## Customization

### Theme Customizer

Go to Appearance > Customize to modify:

- **Hero Section**: Change the main headline and subtitle
- **Colors**: Adjust theme colors (if implemented)
- **Site Identity**: Upload logo and set site title
- **Menus**: Assign menus to theme locations

### Custom CSS

To add custom styling:

1. Go to Appearance > Customize > Additional CSS
2. Add your custom CSS rules
3. Click "Publish" to save changes

### Child Theme (Recommended)

For major customizations, create a child theme:

1. Create a new folder in `/wp-content/themes/` called `autodealer-child`
2. Create `style.css` with:

```css
/*
Theme Name: AutoDealer Pro Child
Template: autodealer-pro
Version: 1.0
*/

@import url("../autodealer-pro/style.css");

/* Your custom styles here */
```

3. Create `functions.php` with:

```php
<?php
function autodealer_child_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'autodealer_child_enqueue_styles');
?>
```

## File Structure

```
autodealer-pro/
├── style.css                 # Main stylesheet
├── index.php                 # Main template
├── functions.php             # Theme functions
├── header.php                # Header template
├── footer.php                # Footer template
├── single-car.php            # Single car template
├── archive-car.php           # Car archive template
├── page-compare.php          # Car comparison page
├── template-parts/
│   └── car-card.php          # Car card component
├── js/
│   └── script.js             # JavaScript functionality
└── README.md                 # This file
```

## Supported Plugins

This theme works well with:

- **Contact Form 7**: For advanced contact forms
- **Yoast SEO**: For search engine optimization
- **WooCommerce**: For e-commerce functionality (if selling parts/accessories)
- **Advanced Custom Fields**: For additional custom fields
- **WPML**: For multilingual sites

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Internet Explorer 11+

## Technical Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher
- MySQL 5.6 or higher

## Support

For support and customization:

- **Documentation**: Refer to this README file
- **WordPress Codex**: https://codex.wordpress.org/
- **Community Forums**: WordPress support forums

## Customization Services

If you need custom modifications:

1. Hire a WordPress developer
2. Use freelance platforms (Upwork, Fiverr, etc.)
3. Contact local web development agencies

## License

This theme is released under the GPL v2 or later license.

## Credits

- **Developer**: MiniMax Agent
- **Icons**: Unicode emojis
- **Fonts**: System fonts for maximum compatibility
- **Framework**: Built on WordPress standards

## Changelog

### Version 1.0
- Initial release
- Car custom post type
- Search and filtering functionality
- Responsive design
- Car comparison feature
- Professional styling

## Tips for Success

1. **High-Quality Images**: Use professional car photos for best results
2. **Detailed Descriptions**: Provide comprehensive car information
3. **Regular Updates**: Keep car listings current and accurate
4. **SEO**: Optimize car titles and descriptions for search engines
5. **Contact Information**: Make it easy for customers to reach you
6. **Mobile Optimization**: Test on mobile devices regularly

## Troubleshooting

**Cars not showing**: Make sure you've published car posts and they're not in draft status
**Search not working**: Check that permalink structure is set correctly
**Images not displaying**: Verify image uploads and file permissions
**Styling issues**: Clear any caching plugins and check for theme conflicts

---

*Thank you for using AutoDealer Pro! We hope it helps you build a successful automotive website.*