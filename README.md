# Laravel Templates

A simple Laravel website with dynamic content management, perfect for learning Laravel basics.

## Features

- 🏠 **Home Page** - Hero section with features and call-to-action
- ℹ️ **About Page** - Company story, mission, values, and team members
- ⭐ **Testimonials Page** - Customer reviews and statistics
- 📧 **Contact Page** - Contact form and business information
- 🎨 **Responsive Design** - Built with Tailwind CSS
- 🔄 **Dynamic Content** - All content managed through controllers

## Pages

### Home (`/`)
- Hero section with customizable title and CTAs
- Features showcase
- Call-to-action section

### About (`/about`)
- Company story with multiple paragraphs
- Mission and values
- Team member profiles

### Testimonials (`/testimonials`)
- Customer testimonials with ratings
- Statistics dashboard

### Contact (`/contact`)
- Contact form
- Business information (address, phone, email, hours)

## Tech Stack

- **Framework:** Laravel 11.x
- **Styling:** Tailwind CSS (CDN)
- **PHP:** 8.2+

## Installation

1. Clone the repository
```bash
git clone https://github.com/yusufdupsc1/Laravel-templates.git
cd Laravel-templates
```

2. Install dependencies
```bash
composer install
```

3. Create environment file
```bash
cp .env.example .env
```

4. Generate application key
```bash
php artisan key:generate
```

5. Start the development server
```bash
php artisan serve
```

6. Visit `http://127.0.0.1:8000` in your browser

## Project Structure

```
├── app/
│   └── Http/
│       └── Controllers/
│           └── PageController.php    # Main controller with dynamic content
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php        # Main layout with navigation & footer
│       ├── home.blade.php           # Home page
│       ├── about.blade.php          # About page
│       ├── testimonials.blade.php   # Testimonials page
│       └── contact.blade.php        # Contact page
└── routes/
    └── web.php                       # Route definitions
```

## Customization

### Updating Content

All content is managed in `app/Http/Controllers/PageController.php`. Simply update the arrays in each method:

- `home()` - Hero, features, and CTA content
- `about()` - Story, values, and team members
- `testimonials()` - Customer reviews and stats
- `contact()` - Contact information

### Example: Adding a New Team Member

```php
public function about()
{
    $data = [
        'team' => [
            [
                'name' => 'New Member',
                'position' => 'Role',
                'icon' => '👨‍💼',
                'color' => 'blue'
            ]
        ]
    ];
}
```

## Routes

- `GET /` - Home page
- `GET /about` - About page
- `GET /testimonials` - Testimonials page
- `GET /contact` - Contact page

## Learning Resources

This project demonstrates:
- Laravel routing
- Blade templating
- Controller usage
- Passing data to views
- Layout inheritance
- Responsive design with Tailwind CSS

## Contributing

Feel free to fork this repository and submit pull requests for improvements!

## License

This project is open-source and available for learning purposes.

## Support

For questions or issues, please open an issue on GitHub.

---

**Perfect for Laravel beginners!** 🚀
