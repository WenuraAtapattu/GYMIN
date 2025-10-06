# GymIn API Documentation for Flutter

Base URL: `http://your-domain.com/api/v1`

## Authentication

### 1. Register User
**POST** `/auth/register`

**Body Parameters:**
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

**Response:**
```json
{
  "success": true,
  "message": "User registered successfully",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "is_admin": false,
      "created_at": "2025-10-05T10:30:00.000000Z"
    },
    "token": "1|abcdef123456...",
    "token_type": "Bearer"
  }
}
```

### 2. Login User
**POST** `/auth/login`

**Body Parameters:**
```json
{
  "email": "john@example.com",
  "password": "password123"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Login successful",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "is_admin": false,
      "created_at": "2025-10-05T10:30:00.000000Z"
    },
    "token": "2|abcdef123456...",
    "token_type": "Bearer"
  }
}
```

### 3. Get Current User
**GET** `/auth/user`

**Headers:** `Authorization: Bearer {token}`

**Response:**
```json
{
  "success": true,
  "message": "User retrieved successfully",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "is_admin": false,
      "created_at": "2025-10-05T10:30:00.000000Z",
      "updated_at": "2025-10-05T10:30:00.000000Z"
    }
  }
}
```

### 4. Update Profile
**PUT** `/auth/profile`

**Headers:** `Authorization: Bearer {token}`

**Body Parameters:**
```json
{
  "name": "John Smith",
  "email": "johnsmith@example.com",
  "current_password": "oldpassword123",
  "password": "newpassword123",
  "password_confirmation": "newpassword123"
}
```

### 5. Logout
**POST** `/auth/logout`

**Headers:** `Authorization: Bearer {token}`

**Response:**
```json
{
  "success": true,
  "message": "Logout successful"
}
```

### 6. Refresh Token
**POST** `/auth/refresh`

**Headers:** `Authorization: Bearer {token}`

**Response:**
```json
{
  "success": true,
  "message": "Token refreshed successfully",
  "data": {
    "token": "3|newtoken123456...",
    "token_type": "Bearer"
  }
}
```

## Product API Endpoints

### 1. Get All Products
**GET** `/products`

**Parameters:**
- `search` (optional) - Search by name or description
- `category` (optional) - Filter by category
- `min_price` (optional) - Minimum price filter
- `max_price` (optional) - Maximum price filter
- `in_stock` (optional) - true/false for stock availability
- `sort_by` (optional) - name, price, created_at, stock_quantity
- `sort_order` (optional) - asc, desc
- `per_page` (optional) - Items per page (max 50, default 15)

**Example:**
```
GET /api/v1/products?category=Cardio&in_stock=true&per_page=20
```

**Response:**
```json
{
  "success": true,
  "message": "Products retrieved successfully",
  "data": {
    "products": [
      {
        "id": 1,
        "name": "Treadmill Pro X1",
        "description": "Professional grade treadmill...",
        "price": "2999.00",
        "sale_price": "2499.00",
        "category": "Cardio",
        "stock_quantity": 15,
        "main_image": "products/treadmill.jpg",
        "main_image_url": "http://domain.com/storage/products/treadmill.jpg",
        "images": ["products/treadmill-1.jpg", "products/treadmill-2.jpg"],
        "is_featured": true,
        "created_at": "2025-10-05T10:30:00.000000Z",
        "updated_at": "2025-10-05T10:30:00.000000Z"
      }
    ],
    "pagination": {
      "current_page": 1,
      "last_page": 5,
      "per_page": 15,
      "total": 75,
      "has_more_pages": true
    }
  }
}
```

### 2. Get Single Product
**GET** `/products/{id}`

**Example:**
```
GET /api/v1/products/1
```

**Response:**
```json
{
  "success": true,
  "message": "Product retrieved successfully",
  "data": {
    "id": 1,
    "name": "Treadmill Pro X1",
    "description": "Professional grade treadmill with advanced features...",
    "price": "2999.00",
    "sale_price": "2499.00",
    "category": "Cardio",
    "stock_quantity": 15,
    "main_image": "products/treadmill.jpg",
    "main_image_url": "http://domain.com/storage/products/treadmill.jpg",
    "images": ["products/treadmill-1.jpg", "products/treadmill-2.jpg"],
    "specifications": {
      "weight": "120kg",
      "dimensions": "200x90x150cm",
      "max_speed": "20km/h"
    },
    "is_featured": true,
    "created_at": "2025-10-05T10:30:00.000000Z",
    "updated_at": "2025-10-05T10:30:00.000000Z"
  }
}
```

### 3. Get Product Images
**GET** `/products/{id}/images`

**Example:**
```
GET /api/v1/products/1/images
```

**Response:**
```json
{
  "success": true,
  "message": "Product images retrieved successfully",
  "data": {
    "product_id": 1,
    "product_name": "Treadmill Pro X1",
    "images": [
      {
        "type": "main",
        "url": "http://domain.com/storage/products/treadmill.jpg",
        "path": "products/treadmill.jpg"
      },
      {
        "type": "additional",
        "index": 0,
        "url": "http://domain.com/storage/products/treadmill-1.jpg",
        "path": "products/treadmill-1.jpg"
      },
      {
        "type": "additional",
        "index": 1,
        "url": "http://domain.com/storage/products/treadmill-2.jpg",
        "path": "products/treadmill-2.jpg"
      }
    ],
    "total_images": 3
  }
}
```

### 4. Search Products
**GET** `/products/search?query={search_term}`

**Parameters:**
- `query` (required) - Search term (minimum 2 characters)

**Example:**
```
GET /api/v1/products/search?query=treadmill
```

**Response:**
```json
{
  "success": true,
  "message": "Search results retrieved successfully",
  "data": {
    "query": "treadmill",
    "results_count": 3,
    "products": [...]
  }
}
```

### 5. Get Products by Category
**GET** `/products/category/{category}`

**Example:**
```
GET /api/v1/products/category/Cardio
```

**Response:**
```json
{
  "success": true,
  "message": "Products retrieved successfully",
  "data": {
    "category": "Cardio",
    "products": [...],
    "pagination": {...}
  }
}
```

### 6. Get All Categories
**GET** `/categories`

**Example:**
```
GET /api/v1/categories
```

**Response:**
```json
{
  "success": true,
  "message": "Categories retrieved successfully",
  "data": [
    "Cardio",
    "Strength",
    "Weights",
    "Accessories",
    "Home Gym"
  ]
}
```

### 7. Get Featured Products
**GET** `/featured-products`

**Response:**
```json
{
  "success": true,
  "message": "Featured products retrieved successfully",
  "data": [...]
}
```

### 8. Get Latest Products
**GET** `/latest-products`

**Response:**
```json
{
  "success": true,
  "message": "Latest products retrieved successfully",
  "data": [...]
}
```

### 9. Get Products on Sale
**GET** `/sale-products`

**Response:**
```json
{
  "success": true,
  "message": "Sale products retrieved successfully",
  "data": [...]
}
```

## Error Responses

### Product Not Found (404)
```json
{
  "success": false,
  "message": "Product not found"
}
```

### Validation Error (422)
```json
{
  "success": false,
  "message": "The given data was invalid.",
  "errors": {
    "query": ["The query field is required."]
  }
}
```

### Server Error (500)
```json
{
  "success": false,
  "message": "Internal server error"
}
```

## Flutter Integration Examples

### 1. HTTP Package Setup
```dart
dependencies:
  http: ^0.13.5
```

### 2. API Service Class
```dart
import 'dart:convert';
import 'package:http/http.dart' as http;

class ApiService {
  static const String baseUrl = 'http://your-domain.com/api/v1';
  
  static Future<Map<String, dynamic>> getProducts({
    String? search,
    String? category,
    int page = 1,
    int perPage = 15,
  }) async {
    final queryParams = <String, String>{
      'page': page.toString(),
      'per_page': perPage.toString(),
    };
    
    if (search != null && search.isNotEmpty) {
      queryParams['search'] = search;
    }
    
    if (category != null && category.isNotEmpty) {
      queryParams['category'] = category;
    }
    
    final uri = Uri.parse('$baseUrl/products').replace(queryParameters: queryParams);
    final response = await http.get(uri);
    
    if (response.statusCode == 200) {
      return json.decode(response.body);
    } else {
      throw Exception('Failed to load products');
    }
  }
  
  static Future<Map<String, dynamic>> getProduct(int id) async {
    final response = await http.get(Uri.parse('$baseUrl/products/$id'));
    
    if (response.statusCode == 200) {
      return json.decode(response.body);
    } else {
      throw Exception('Failed to load product');
    }
  }
  
  static Future<Map<String, dynamic>> getCategories() async {
    final response = await http.get(Uri.parse('$baseUrl/categories'));
    
    if (response.statusCode == 200) {
      return json.decode(response.body);
    } else {
      throw Exception('Failed to load categories');
    }
  }
}
```

### 3. Product Model
```dart
class Product {
  final int id;
  final String name;
  final String description;
  final double price;
  final double? salePrice;
  final String category;
  final int stockQuantity;
  final String? mainImageUrl;
  final List<String> images;
  final bool isFeatured;
  final DateTime createdAt;

  Product({
    required this.id,
    required this.name,
    required this.description,
    required this.price,
    this.salePrice,
    required this.category,
    required this.stockQuantity,
    this.mainImageUrl,
    required this.images,
    required this.isFeatured,
    required this.createdAt,
  });

  factory Product.fromJson(Map<String, dynamic> json) {
    return Product(
      id: json['id'],
      name: json['name'],
      description: json['description'],
      price: double.parse(json['price']),
      salePrice: json['sale_price'] != null ? double.parse(json['sale_price']) : null,
      category: json['category'],
      stockQuantity: json['stock_quantity'],
      mainImageUrl: json['main_image_url'],
      images: List<String>.from(json['images'] ?? []),
      isFeatured: json['is_featured'] ?? false,
      createdAt: DateTime.parse(json['created_at']),
    );
  }
}
```

### 4. Usage Example
```dart
class ProductService {
  static Future<List<Product>> fetchProducts() async {
    try {
      final response = await ApiService.getProducts();
      
      if (response['success']) {
        final List<dynamic> productsJson = response['data']['products'];
        return productsJson.map((json) => Product.fromJson(json)).toList();
      } else {
        throw Exception(response['message']);
      }
    } catch (e) {
      throw Exception('Failed to fetch products: $e');
    }
  }
}
```

## Notes
- All responses follow a consistent JSON structure with `success`, `message`, and `data` fields
- Image URLs are absolute URLs ready for direct use in Flutter
- Pagination information is provided for large datasets
- Error handling includes appropriate HTTP status codes
- API supports filtering, searching, and sorting for flexible data retrieval