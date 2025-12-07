<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PageController extends Controller
{
    public function home()
    {
        $data = [
            'hero' => [
                'title' => 'Welcome to MyWebsite',
                'subtitle' => 'Building amazing experiences for everyone',
                'cta_primary' => 'Learn More',
                'cta_secondary' => 'Get Started'
            ],
            'features' => [
                [
                    'icon' => 'lightning',
                    'title' => 'Fast Performance',
                    'description' => 'Lightning-fast load times and optimal performance',
                    'color' => 'blue'
                ],
                [
                    'icon' => 'lock',
                    'title' => 'Secure & Reliable',
                    'description' => 'Top-notch security measures to protect your data',
                    'color' => 'purple'
                ],
                [
                    'icon' => 'thumb',
                    'title' => 'User Friendly',
                    'description' => 'Intuitive design that everyone can use easily',
                    'color' => 'green'
                ]
            ],
            'cta' => [
                'title' => 'Ready to Get Started?',
                'description' => 'Join thousands of satisfied users today',
                'button_text' => 'Contact Us Now'
            ]
        ];

        return view('home', $data);
    }

    public function about()
    {
        $data = [
            'story' => [
                'title' => 'Our Great Story',
                'paragraphs' => [
                    'Founded in 2025, MyWebsite has been dedicated to providing exceptional web solutions for businesses and individuals around the world. Our journey started with a simple idea: make the web accessible and beautiful for everyone.',
                    'Over the years, we\'ve grown from a small team of passionate developers to a full-service digital agency. We\'ve helped hundreds of clients achieve their online goals and continue to push the boundaries of what\'s possible on the web.',
                    'Today, we\'re proud to be a trusted partner for businesses of all sizes, offering cutting-edge solutions that drive results and create lasting impact.'
                ]
            ],
            'values' => [
                [
                    'icon' => '💡',
                    'title' => 'Innovation',
                    'description' => 'We constantly explore new technologies and approaches to deliver cutting-edge solutions.',
                    'color' => 'blue'
                ],
                [
                    'icon' => '🤝',
                    'title' => 'Integrity',
                    'description' => 'We build trust through transparency, honesty, and ethical business practices.',
                    'color' => 'purple'
                ],
                [
                    'icon' => '🎯',
                    'title' => 'Excellence',
                    'description' => 'We strive for perfection in everything we do, delivering quality that exceeds expectations.',
                    'color' => 'green'
                ]
            ],
            'team' => [
                [
                    'name' => 'John Doe',
                    'position' => 'CEO & Founder',
                    'icon' => '👨‍💼',
                    'color' => 'blue'
                ],
                [
                    'name' => 'Jane Smith',
                    'position' => 'Lead Developer',
                    'icon' => '👩‍💻',
                    'color' => 'purple'
                ],
                [
                    'name' => 'Mike Johnson',
                    'position' => 'Creative Director',
                    'icon' => '👨‍🎨',
                    'color' => 'green'
                ],
                [
                    'name' => 'Sarah Williams',
                    'position' => 'Marketing Manager',
                    'icon' => '👩‍💼',
                    'color' => 'pink'
                ]
            ]
        ];

        return view('about', $data);
    }

    public function testimonials()
    {
        $data = [
            'testimonials' => [
                [
                    'name' => 'Alex Turner',
                    'position' => 'CEO, TechCorp',
                    'icon' => '👨',
                    'rating' => 5,
                    'review' => 'Working with this team has been an absolute pleasure. They delivered our project on time and exceeded all expectations. Highly recommended!',
                    'color' => 'blue'
                ],
                [
                    'name' => 'Sarah Martinez',
                    'position' => 'Founder, Creative Studio',
                    'icon' => '👩',
                    'rating' => 5,
                    'review' => 'The attention to detail and professional approach made all the difference. Our website looks amazing and performs flawlessly!',
                    'color' => 'purple'
                ],
                [
                    'name' => 'David Chen',
                    'position' => 'Director, StartupHub',
                    'icon' => '👨',
                    'rating' => 5,
                    'review' => 'Outstanding service! They understood our vision and brought it to life better than we imagined. Will definitely work with them again.',
                    'color' => 'green'
                ],
                [
                    'name' => 'Emma Wilson',
                    'position' => 'Marketing Lead, BrandCo',
                    'icon' => '👩',
                    'rating' => 5,
                    'review' => 'Professional, responsive, and creative. They transformed our online presence and helped us connect with our audience in new ways.',
                    'color' => 'pink'
                ],
                [
                    'name' => 'James Brown',
                    'position' => 'Owner, Local Biz',
                    'icon' => '👨',
                    'rating' => 5,
                    'review' => 'From concept to launch, the process was smooth and efficient. Our sales have increased significantly since the new website went live!',
                    'color' => 'indigo'
                ],
                [
                    'name' => 'Lisa Anderson',
                    'position' => 'Manager, E-commerce Plus',
                    'icon' => '👩',
                    'rating' => 5,
                    'review' => 'Incredible team to work with! They\'re knowledgeable, patient, and always available to answer questions. 5 stars all the way!',
                    'color' => 'orange'
                ]
            ],
            'stats' => [
                ['number' => '500+', 'label' => 'Happy Clients'],
                ['number' => '1000+', 'label' => 'Projects Completed'],
                ['number' => '98%', 'label' => 'Satisfaction Rate'],
                ['number' => '5★', 'label' => 'Average Rating']
            ]
        ];

        return view('testimonials', $data);
    }

    public function contact()
    {
        $data = [
            'contact_info' => [
                [
                    'type' => 'address',
                    'icon' => 'location',
                    'title' => 'Address',
                    'details' => ['123 Business Street', 'Suite 100', 'New York, NY 10001'],
                    'color' => 'blue'
                ],
                [
                    'type' => 'phone',
                    'icon' => 'phone',
                    'title' => 'Phone',
                    'details' => ['+1 (555) 123-4567', '+1 (555) 987-6543'],
                    'color' => 'purple'
                ],
                [
                    'type' => 'email',
                    'icon' => 'mail',
                    'title' => 'Email',
                    'details' => ['info@mywebsite.com', 'support@mywebsite.com'],
                    'color' => 'green'
                ],
                [
                    'type' => 'hours',
                    'icon' => 'clock',
                    'title' => 'Business Hours',
                    'details' => ['Monday - Friday: 9:00 AM - 6:00 PM', 'Saturday: 10:00 AM - 4:00 PM', 'Sunday: Closed'],
                    'color' => 'orange'
                ]
            ]
        ];

        return view('contact', $data);
    }

    public function services()
    {
        $data = [
            'services' => [
                ['title' => 'Web Design', 'desc' => 'Modern, responsive UIs'],
                ['title' => 'API Development', 'desc' => 'Robust REST/GraphQL backends'],
                ['title' => 'DevOps', 'desc' => 'CI/CD, observability, cloud infra'],
            ],
        ];

        return view('services', $data);
    }

    public function posts()
    {
        $posts = $this->loadPosts();

        return view('posts', [
            'posts' => $posts,
            'usingDatabase' => $this->usingDatabaseDriver(),
        ]);
    }

    private function loadPosts()
    {
        if ($this->usingDatabaseDriver()) {
            try {
                return Post::query()->latest()->get(['id', 'title', 'body', 'created_at']);
            } catch (\Throwable $e) {
                // fall through to static sample data
            }
        }

        return collect([
            [
                'id' => 1,
                'title' => 'Laravel basics without a DB',
                'body' => 'This environment lacks the SQLite driver, so we render static sample posts as a fallback.',
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'title' => 'Switch to a real database',
                'body' => 'Install the sqlite3 PHP extension, run migrations and seeders, and the page will pull from the posts table.',
                'created_at' => now(),
            ],
            [
                'id' => 3,
                'title' => 'Same Blade, different data',
                'body' => 'The view template does not care whether data came from Eloquent or a static array.',
                'created_at' => now(),
            ],
        ]);
    }

    private function usingDatabaseDriver(): bool
    {
        return extension_loaded('pdo_sqlite');
    }
}
