<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

-   **[Vehikl](https://vehikl.com)**
-   **[Tighten Co.](https://tighten.co)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Redberry](https://redberry.international/laravel-development)**
-   **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## Models and usage examples

The repository uses Eloquent models representing database tables and their relationships. Here's a quick example to show how to work with them:

```php
// Create a brand
$brand = \App\Models\Brand::create(['brand_name' => 'Acme', 'brand_img' => '/images/acme.png']);

// Create a category
$category = \App\Models\Category::create(['category_name' => 'Electronics', 'category_img' => '/images/electronics.png']);

// Create a product
$product = \App\Models\Product::create([
	'category_id' => $category->id,
	'brand_id' => $brand->id,
	'title' => 'Smartphone',
	'short_des' => 'A great phone',
	'price' => 399.99,
	'discount' => false,
	'discount_price' => 0,
	'image' => '/images/phone.png',
	'stock' => true,
	'star' => 4.5,
	'remark' => 'popular',
]);

// Add details
$product->details()->create(['img1' => '/images/p1.png', 'img2' => '/images/p2.png', 'img3' => '/images/p3.png', 'img4' => '/images/p4.png', 'des' => 'Full details', 'color' => 'Black', 'size' => '6 inch']);

// Create a user with profile
$user = \App\Models\User::factory()->create(['email' => 'user@example.com']);
$user->profile()->create(['user_id' => $user->id, 'cus_name' => 'John Doe', 'cus_add' => 'Street 1', 'cus_city' => 'City', 'cus_state' => 'State', 'cus_postcode' => '12345', 'cus_country' => 'Country', 'cus_phone' => '12345', 'cus_fax' => '54321', 'ship_name' => 'John Doe', 'ship_add' => 'Street 1', 'ship_city' => 'City', 'ship_state' => 'State', 'ship_postcode' => '12345', 'ship_country' => 'Country', 'ship_phone' => '12345']);

// Add to cart
$user->carts()->create(['product_id' => $product->id, 'price' => 399.99, 'color' => 'Black', 'size' => '6 inch', 'qty' => 1]);

// Create an invoice
$invoice = $user->invoices()->create(['total' => 399.99, 'vat' => 0, 'payable' => 399.99, 'cus_details' => '...', 'ship_details' => '...', 'tran_id' => 'TXN123', 'val_id' => '0', 'delivery_status' => 'Pending', 'payment_status' => 'Unpaid']);

// Attach product to invoice
$invoice->products()->create(['product_id' => $product->id, 'user_id' => $user->id, 'qty' => 1, 'sale_price' => 399.99]);
```

For deeper reference see the migration files under `database/migrations` which outline the table columns and foreign keys.

Note: On case-sensitive filesystems (e.g., Linux), ensure `app/Models/product.php` is renamed to `app/Models/Product.php` to match the class name `Product`.
