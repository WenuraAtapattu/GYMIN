# GymIn - Professional Gym Equipment E-commerce Platform

![GymIn Logo](https://via.placeholder.com/200x100/DC2626/FFFFFF?text=GymIn)

## 🏋️ About GymIn

GymIn is a comprehensive e-commerce platform designed specifically for gym equipment sales. Built with Laravel, it provides a modern, professional interface for both customers and administrators to manage gym equipment inventory and sales.

## ✨ Features

### 🛍️ Customer Features
- **Product Catalog** - Browse comprehensive gym equipment collections
- **Advanced Search** - Find equipment by category, price, brand
- **Shopping Cart** - Add, update, remove items with real-time updates
- **User Dashboard** - Personal profile, order history, cart management
- **Responsive Design** - Optimized for desktop and mobile devices
- **Product Reviews** - Rate and review equipment purchases

### 👨‍💼 Admin Features
- **Inventory Management** - Add, edit, delete products with image uploads
- **Order Management** - Track and manage customer orders
- **Analytics Dashboard** - Sales statistics and insights
- **User Management** - Customer account oversight
- **Category Management** - Organize products efficiently

### 📱 API Features
- **RESTful API** - Complete API for mobile app integration
- **JWT Authentication** - Secure token-based authentication
- **Flutter SDK** - Ready-to-use Flutter integration
- **Kotlin/Android SDK** - Native Android development support

## 🛠️ Technology Stack

- **Backend**: Laravel 10.x
- **Frontend**: Tailwind CSS, Livewire
- **Database**: MySQL (Primary), MongoDB (Analytics)
- **Authentication**: Laravel Jetstream + Sanctum
- **File Storage**: Laravel Storage (Local/Cloud ready)
- **API**: RESTful with comprehensive documentation

## 📦 Installation

### Prerequisites
- PHP 8.1+
- Composer
- Node.js & NPM
- MySQL 5.7+
- Git

### Local Development Setup

1. **Clone the repository**
```bash
git clone https://github.com/yourusername/gymin-ecommerce.git
cd gymin-ecommerce
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database configuration**
```bash
# Update .env with your database credentials
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gymin_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. **Run migrations and seed data**
```bash
php artisan migrate --seed
```

6. **Create storage link**
```bash
php artisan storage:link
```

7. **Build assets**
```bash
npm run build
```

8. **Start development server**
```bash
php artisan serve
```

## 🚀 Production Deployment (AWS Lightsail)

### Server Requirements
- Ubuntu 20.04+ or Amazon Linux 2
- PHP 8.1+
- Nginx or Apache
- MySQL 8.0+
- SSL Certificate (Let's Encrypt recommended)

### Deployment Steps

1. **Server Setup**
```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install PHP 8.1
sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install php8.1 php8.1-fpm php8.1-mysql php8.1-xml php8.1-mbstring php8.1-curl php8.1-zip php8.1-gd

# Install Nginx
sudo apt install nginx

# Install MySQL
sudo apt install mysql-server
sudo mysql_secure_installation

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt-get install -y nodejs
```

2. **Deploy Application**
```bash
# Clone repository
cd /var/www
sudo git clone https://github.com/yourusername/gymin-ecommerce.git
sudo chown -R www-data:www-data gymin-ecommerce
cd gymin-ecommerce

# Install dependencies
sudo -u www-data composer install --optimize-autoloader --no-dev
sudo -u www-data npm install
sudo -u www-data npm run build

# Set permissions
sudo chmod -R 755 storage bootstrap/cache
sudo chown -R www-data:www-data storage bootstrap/cache
```

3. **Environment Configuration**
```bash
# Copy and configure environment
sudo -u www-data cp .env.example .env
sudo -u www-data php artisan key:generate

# Update .env for production
sudo nano .env
```

4. **Database Setup**
```bash
# Create database
sudo mysql -u root -p
CREATE DATABASE gymin_production;
CREATE USER 'gymin_user'@'localhost' IDENTIFIED BY 'secure_password';
GRANT ALL PRIVILEGES ON gymin_production.* TO 'gymin_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;

# Run migrations
sudo -u www-data php artisan migrate --force
sudo -u www-data php artisan db:seed --force
```

5. **Nginx Configuration**
```nginx
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/gymin-ecommerce/public;
    
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    
    index index.php;
    
    charset utf-8;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }
    
    error_page 404 /index.php;
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

6. **SSL Setup with Let's Encrypt**
```bash
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
```

## 📱 Mobile SDKs

### Flutter Integration
```dart
// Add to pubspec.yaml
dependencies:
  http: ^0.13.5
  shared_preferences: ^2.2.2

// Use the provided Flutter SDK
import 'package:gymin_app/services/api_service.dart';
```

### Android/Kotlin Integration
```kotlin
// Add to build.gradle
implementation 'com.squareup.retrofit2:retrofit:2.9.0'
implementation 'com.squareup.retrofit2:converter-gson:2.9.0'

// Use the provided Kotlin SDK
val apiClient = ApiClient.getInstance(context)
```

## 🔧 Configuration

### Environment Variables
```env
APP_NAME=GymIn
APP_ENV=production
APP_KEY=your_generated_key
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gymin_production
DB_USERNAME=gymin_user
DB_PASSWORD=secure_password

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
```

## 📊 API Documentation

### Base URL
```
https://yourdomain.com/api/v1
```

### Authentication
```http
POST /api/v1/auth/login
POST /api/v1/auth/register
GET /api/v1/auth/user
```

### Products
```http
GET /api/v1/products
GET /api/v1/products/{id}
GET /api/v1/categories
GET /api/v1/featured-products
```

Full API documentation available at: `/docs` (when deployed)

## 👥 Default Credentials

### Admin Access
- **Email**: admin@gymin.com
- **Password**: admin123

### Test User
- **Email**: test@example.com
- **Password**: password

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙋‍♂️ Support

For support and questions:
- Create an issue on GitHub
- Email: support@gymin.com
- Documentation: Available in the `/docs` folder

## 🎯 Roadmap

- [ ] Payment gateway integration (Stripe, PayPal)
- [ ] Real-time chat support
- [ ] Advanced analytics dashboard
- [ ] Multi-language support
- [ ] Progressive Web App (PWA)
- [ ] Social media integration

---

**Built with ❤️ for the fitness community**
