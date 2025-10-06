# Kotlin/Android SDK for GymIn API

This is a complete Kotlin SDK for integrating with the GymIn gym equipment ecommerce API in native Android applications.

## Setup

Add these dependencies to your `app/build.gradle`:

```kotlin
dependencies {
    // Networking
    implementation 'com.squareup.retrofit2:retrofit:2.9.0'
    implementation 'com.squareup.retrofit2:converter-gson:2.9.0'
    implementation 'com.squareup.okhttp3:logging-interceptor:4.11.0'
    
    // Coroutines
    implementation 'org.jetbrains.kotlinx:kotlinx-coroutines-android:1.7.1'
    
    // SharedPreferences
    implementation 'androidx.preference:preference-ktx:1.2.1'
    
    // Image Loading
    implementation 'com.github.bumptech.glide:glide:4.15.1'
    
    // JSON
    implementation 'com.google.code.gson:gson:2.10.1'
    
    // ViewBinding/DataBinding
    implementation 'androidx.databinding:databinding-runtime:8.1.2'
}
```

Add internet permission to your `AndroidManifest.xml`:

```xml
<uses-permission android:name="android.permission.INTERNET" />
```

## 1. Data Models

```kotlin
// app/src/main/java/com/gymin/api/models/User.kt
package com.gymin.api.models

import com.google.gson.annotations.SerializedName
import java.util.Date

data class User(
    @SerializedName("id") val id: Int,
    @SerializedName("name") val name: String,
    @SerializedName("email") val email: String,
    @SerializedName("is_admin") val isAdmin: Boolean = false,
    @SerializedName("created_at") val createdAt: Date,
    @SerializedName("updated_at") val updatedAt: Date? = null
)

data class AuthResponse(
    @SerializedName("user") val user: User,
    @SerializedName("token") val token: String,
    @SerializedName("token_type") val tokenType: String
)

data class AuthRequest(
    @SerializedName("name") val name: String? = null,
    @SerializedName("email") val email: String,
    @SerializedName("password") val password: String,
    @SerializedName("password_confirmation") val passwordConfirmation: String? = null
)

data class UpdateProfileRequest(
    @SerializedName("name") val name: String? = null,
    @SerializedName("email") val email: String? = null,
    @SerializedName("current_password") val currentPassword: String? = null,
    @SerializedName("password") val password: String? = null,
    @SerializedName("password_confirmation") val passwordConfirmation: String? = null
)
```

```kotlin
// app/src/main/java/com/gymin/api/models/Product.kt
package com.gymin.api.models

import com.google.gson.annotations.SerializedName
import java.util.Date

data class Product(
    @SerializedName("id") val id: Int,
    @SerializedName("name") val name: String,
    @SerializedName("description") val description: String,
    @SerializedName("price") val price: Double,
    @SerializedName("sale_price") val salePrice: Double? = null,
    @SerializedName("category") val category: String,
    @SerializedName("brand") val brand: String? = null,
    @SerializedName("model") val model: String? = null,
    @SerializedName("images") val images: List<String> = emptyList(),
    @SerializedName("main_image") val mainImage: String,
    @SerializedName("stock_quantity") val stockQuantity: Int,
    @SerializedName("sku") val sku: String,
    @SerializedName("weight") val weight: String? = null,
    @SerializedName("dimensions") val dimensions: String? = null,
    @SerializedName("warranty") val warranty: String? = null,
    @SerializedName("is_featured") val isFeatured: Boolean = false,
    @SerializedName("is_active") val isActive: Boolean = true,
    @SerializedName("rating") val rating: Double = 0.0,
    @SerializedName("review_count") val reviewCount: Int = 0,
    @SerializedName("features") val features: List<String> = emptyList(),
    @SerializedName("condition") val condition: String = "new",
    @SerializedName("created_at") val createdAt: Date,
    @SerializedName("updated_at") val updatedAt: Date
) {
    val finalPrice: Double get() = salePrice ?: price
    val isOnSale: Boolean get() = salePrice != null && salePrice < price
    val isInStock: Boolean get() = stockQuantity > 0
}

data class ProductResponse(
    @SerializedName("products") val products: List<Product>,
    @SerializedName("pagination") val pagination: Pagination
)

data class Pagination(
    @SerializedName("current_page") val currentPage: Int,
    @SerializedName("last_page") val lastPage: Int,
    @SerializedName("per_page") val perPage: Int,
    @SerializedName("total") val total: Int,
    @SerializedName("has_more_pages") val hasMorePages: Boolean
)

data class SearchResponse(
    @SerializedName("query") val query: String,
    @SerializedName("results_count") val resultsCount: Int,
    @SerializedName("products") val products: List<Product>
)

data class ProductImage(
    @SerializedName("type") val type: String,
    @SerializedName("url") val url: String,
    @SerializedName("path") val path: String,
    @SerializedName("index") val index: Int? = null
)

data class ProductImagesResponse(
    @SerializedName("product_id") val productId: Int,
    @SerializedName("product_name") val productName: String,
    @SerializedName("images") val images: List<ProductImage>,
    @SerializedName("total_images") val totalImages: Int
)
```

```kotlin
// app/src/main/java/com/gymin/api/models/ApiResponse.kt
package com.gymin.api.models

import com.google.gson.annotations.SerializedName

data class ApiResponse<T>(
    @SerializedName("success") val success: Boolean,
    @SerializedName("message") val message: String,
    @SerializedName("data") val data: T? = null,
    @SerializedName("errors") val errors: Map<String, List<String>>? = null
)

data class ApiError(
    val statusCode: Int,
    val message: String,
    val errors: Map<String, List<String>>? = null
) : Exception(message)
```

## 2. API Service Interfaces

```kotlin
// app/src/main/java/com/gymin/api/services/AuthApiService.kt
package com.gymin.api.services

import com.gymin.api.models.*
import retrofit2.Response
import retrofit2.http.*

interface AuthApiService {
    @POST("auth/register")
    suspend fun register(@Body request: AuthRequest): Response<ApiResponse<AuthResponse>>
    
    @POST("auth/login")
    suspend fun login(@Body request: AuthRequest): Response<ApiResponse<AuthResponse>>
    
    @GET("auth/user")
    suspend fun getCurrentUser(): Response<ApiResponse<UserData>>
    
    @PUT("auth/profile")
    suspend fun updateProfile(@Body request: UpdateProfileRequest): Response<ApiResponse<UserData>>
    
    @POST("auth/logout")
    suspend fun logout(): Response<ApiResponse<Unit>>
    
    @POST("auth/refresh")
    suspend fun refreshToken(): Response<ApiResponse<TokenData>>
}

data class UserData(
    @SerializedName("user") val user: User
)

data class TokenData(
    @SerializedName("token") val token: String,
    @SerializedName("token_type") val tokenType: String
)
```

```kotlin
// app/src/main/java/com/gymin/api/services/ProductApiService.kt
package com.gymin.api.services

import com.gymin.api.models.*
import retrofit2.Response
import retrofit2.http.*

interface ProductApiService {
    @GET("products")
    suspend fun getProducts(
        @Query("search") search: String? = null,
        @Query("category") category: String? = null,
        @Query("min_price") minPrice: Double? = null,
        @Query("max_price") maxPrice: Double? = null,
        @Query("in_stock") inStock: Boolean? = null,
        @Query("sort_by") sortBy: String = "created_at",
        @Query("sort_order") sortOrder: String = "desc",
        @Query("page") page: Int = 1,
        @Query("per_page") perPage: Int = 15
    ): Response<ApiResponse<ProductResponse>>
    
    @GET("products/{id}")
    suspend fun getProduct(@Path("id") id: Int): Response<ApiResponse<Product>>
    
    @GET("products/{id}/images")
    suspend fun getProductImages(@Path("id") id: Int): Response<ApiResponse<ProductImagesResponse>>
    
    @GET("products/search")
    suspend fun searchProducts(@Query("query") query: String): Response<ApiResponse<SearchResponse>>
    
    @GET("products/category/{category}")
    suspend fun getProductsByCategory(@Path("category") category: String): Response<ApiResponse<ProductResponse>>
    
    @GET("categories")
    suspend fun getCategories(): Response<ApiResponse<List<String>>>
    
    @GET("featured-products")
    suspend fun getFeaturedProducts(): Response<ApiResponse<List<Product>>>
    
    @GET("latest-products")
    suspend fun getLatestProducts(): Response<ApiResponse<List<Product>>>
    
    @GET("sale-products")
    suspend fun getSaleProducts(): Response<ApiResponse<List<Product>>>
}
```

## 3. Network Configuration

```kotlin
// app/src/main/java/com/gymin/api/network/ApiClient.kt
package com.gymin.api.network

import android.content.Context
import com.google.gson.GsonBuilder
import com.gymin.api.services.AuthApiService
import com.gymin.api.services.ProductApiService
import okhttp3.Interceptor
import okhttp3.OkHttpClient
import okhttp3.logging.HttpLoggingInterceptor
import retrofit2.Retrofit
import retrofit2.converter.gson.GsonConverterFactory
import java.util.Date
import java.util.concurrent.TimeUnit

class ApiClient private constructor(private val context: Context) {
    
    companion object {
        private const val BASE_URL = "http://your-domain.com/api/v1/"
        
        @Volatile
        private var INSTANCE: ApiClient? = null
        
        fun getInstance(context: Context): ApiClient {
            return INSTANCE ?: synchronized(this) {
                INSTANCWHYS E ?: ApiClient(context.applicationContext).also { INSTANCE = it }
            }
        }
    }
    
    private val tokenManager = TokenManager(context)
    
    private val authInterceptor = Interceptor { chain ->
        val request = chain.request()
        val token = tokenManager.getToken()
        
        val newRequest = if (token != null) {
            request.newBuilder()
                .addHeader("Authorization", "Bearer $token")
                .build()
        } else {
            request
        }
        
        chain.proceed(newRequest)
    }
    
    private val loggingInterceptor = HttpLoggingInterceptor().apply {
        level = HttpLoggingInterceptor.Level.BODY
    }
    
    private val okHttpClient = OkHttpClient.Builder()
        .addInterceptor(authInterceptor)
        .addInterceptor(loggingInterceptor)
        .connectTimeout(30, TimeUnit.SECONDS)
        .readTimeout(30, TimeUnit.SECONDS)
        .build()
    
    private val gson = GsonBuilder()
        .setDateFormat("yyyy-MM-dd'T'HH:mm:ss.SSSSSS'Z'")
        .create()
    
    private val retrofit = Retrofit.Builder()
        .baseUrl(BASE_URL)
        .client(okHttpClient)
        .addConverterFactory(GsonConverterFactory.create(gson))
        .build()
    
    val authService: AuthApiService = retrofit.create(AuthApiService::class.java)
    val productService: ProductApiService = retrofit.create(ProductApiService::class.java)
    
    fun getTokenManager(): TokenManager = tokenManager
}
```

```kotlin
// app/src/main/java/com/gymin/api/network/TokenManager.kt
package com.gymin.api.network

import android.content.Context
import android.content.SharedPreferences

class TokenManager(context: Context) {
    
    companion object {
        private const val PREF_NAME = "gym_auth_prefs"
        private const val KEY_TOKEN = "auth_token"
        private const val KEY_USER_ID = "user_id"
        private const val KEY_USER_NAME = "user_name"
        private const val KEY_USER_EMAIL = "user_email"
        private const val KEY_IS_ADMIN = "is_admin"
    }
    
    private val sharedPreferences: SharedPreferences = 
        context.getSharedPreferences(PREF_NAME, Context.MODE_PRIVATE)
    
    fun saveToken(token: String) {
        sharedPreferences.edit()
            .putString(KEY_TOKEN, token)
            .apply()
    }
    
    fun getToken(): String? {
        return sharedPreferences.getString(KEY_TOKEN, null)
    }
    
    fun saveUserData(user: com.gymin.api.models.User) {
        sharedPreferences.edit()
            .putInt(KEY_USER_ID, user.id)
            .putString(KEY_USER_NAME, user.name)
            .putString(KEY_USER_EMAIL, user.email)
            .putBoolean(KEY_IS_ADMIN, user.isAdmin)
            .apply()
    }
    
    fun getUserId(): Int {
        return sharedPreferences.getInt(KEY_USER_ID, -1)
    }
    
    fun getUserName(): String? {
        return sharedPreferences.getString(KEY_USER_NAME, null)
    }
    
    fun getUserEmail(): String? {
        return sharedPreferences.getString(KEY_USER_EMAIL, null)
    }
    
    fun isAdmin(): Boolean {
        return sharedPreferences.getBoolean(KEY_IS_ADMIN, false)
    }
    
    fun isLoggedIn(): Boolean {
        return getToken() != null
    }
    
    fun clearAll() {
        sharedPreferences.edit().clear().apply()
    }
}
```

## 4. Repository Classes

```kotlin
// app/src/main/java/com/gymin/api/repositories/AuthRepository.kt
package com.gymin.api.repositories

import com.gymin.api.models.*
import com.gymin.api.network.ApiClient
import com.gymin.api.network.TokenManager
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.withContext

class AuthRepository(private val apiClient: ApiClient) {
    
    private val authService = apiClient.authService
    private val tokenManager = apiClient.getTokenManager()
    
    suspend fun register(
        name: String,
        email: String,
        password: String,
        passwordConfirmation: String
    ): Result<AuthResponse> = withContext(Dispatchers.IO) {
        try {
            val request = AuthRequest(
                name = name,
                email = email,
                password = password,
                passwordConfirmation = passwordConfirmation
            )
            
            val response = authService.register(request)
            
            if (response.isSuccessful && response.body()?.success == true) {
                val authResponse = response.body()!!.data!!
                tokenManager.saveToken(authResponse.token)
                tokenManager.saveUserData(authResponse.user)
                Result.success(authResponse)
            } else {
                val errorBody = response.body()
                Result.failure(
                    ApiError(
                        statusCode = response.code(),
                        message = errorBody?.message ?: "Registration failed",
                        errors = errorBody?.errors
                    )
                )
            }
        } catch (e: Exception) {
            Result.failure(e)
        }
    }
    
    suspend fun login(email: String, password: String): Result<AuthResponse> = withContext(Dispatchers.IO) {
        try {
            val request = AuthRequest(
                email = email,
                password = password
            )
            
            val response = authService.login(request)
            
            if (response.isSuccessful && response.body()?.success == true) {
                val authResponse = response.body()!!.data!!
                tokenManager.saveToken(authResponse.token)
                tokenManager.saveUserData(authResponse.user)
                Result.success(authResponse)
            } else {
                val errorBody = response.body()
                Result.failure(
                    ApiError(
                        statusCode = response.code(),
                        message = errorBody?.message ?: "Login failed",
                        errors = errorBody?.errors
                    )
                )
            }
        } catch (e: Exception) {
            Result.failure(e)
        }
    }
    
    suspend fun getCurrentUser(): Result<User> = withContext(Dispatchers.IO) {
        try {
            val response = authService.getCurrentUser()
            
            if (response.isSuccessful && response.body()?.success == true) {
                val user = response.body()!!.data!!.user
                tokenManager.saveUserData(user)
                Result.success(user)
            } else {
                Result.failure(
                    ApiError(
                        statusCode = response.code(),
                        message = response.body()?.message ?: "Failed to get user"
                    )
                )
            }
        } catch (e: Exception) {
            Result.failure(e)
        }
    }
    
    suspend fun logout(): Result<Unit> = withContext(Dispatchers.IO) {
        try {
            val response = authService.logout()
            tokenManager.clearAll()
            
            if (response.isSuccessful) {
                Result.success(Unit)
            } else {
                Result.failure(
                    ApiError(
                        statusCode = response.code(),
                        message = "Logout failed"
                    )
                )
            }
        } catch (e: Exception) {
            tokenManager.clearAll() // Clear locally even if API call fails
            Result.failure(e)
        }
    }
    
    suspend fun updateProfile(
        name: String? = null,
        email: String? = null,
        currentPassword: String? = null,
        newPassword: String? = null,
        passwordConfirmation: String? = null
    ): Result<User> = withContext(Dispatchers.IO) {
        try {
            val request = UpdateProfileRequest(
                name = name,
                email = email,
                currentPassword = currentPassword,
                password = newPassword,
                passwordConfirmation = passwordConfirmation
            )
            
            val response = authService.updateProfile(request)
            
            if (response.isSuccessful && response.body()?.success == true) {
                val user = response.body()!!.data!!.user
                tokenManager.saveUserData(user)
                Result.success(user)
            } else {
                val errorBody = response.body()
                Result.failure(
                    ApiError(
                        statusCode = response.code(),
                        message = errorBody?.message ?: "Profile update failed",
                        errors = errorBody?.errors
                    )
                )
            }
        } catch (e: Exception) {
            Result.failure(e)
        }
    }
    
    fun isLoggedIn(): Boolean = tokenManager.isLoggedIn()
    
    fun getCachedUserData(): User? {
        val id = tokenManager.getUserId()
        val name = tokenManager.getUserName()
        val email = tokenManager.getUserEmail()
        
        return if (id != -1 && name != null && email != null) {
            User(
                id = id,
                name = name,
                email = email,
                isAdmin = tokenManager.isAdmin(),
                createdAt = java.util.Date(),
                updatedAt = null
            )
        } else {
            null
        }
    }
}
```

```kotlin
// app/src/main/java/com/gymin/api/repositories/ProductRepository.kt
package com.gymin.api.repositories

import com.gymin.api.models.*
import com.gymin.api.network.ApiClient
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.withContext

class ProductRepository(private val apiClient: ApiClient) {
    
    private val productService = apiClient.productService
    
    suspend fun getProducts(
        search: String? = null,
        category: String? = null,
        minPrice: Double? = null,
        maxPrice: Double? = null,
        inStock: Boolean? = null,
        sortBy: String = "created_at",
        sortOrder: String = "desc",
        page: Int = 1,
        perPage: Int = 15
    ): Result<ProductResponse> = withContext(Dispatchers.IO) {
        try {
            val response = productService.getProducts(
                search, category, minPrice, maxPrice, inStock, sortBy, sortOrder, page, perPage
            )
            
            if (response.isSuccessful && response.body()?.success == true) {
                Result.success(response.body()!!.data!!)
            } else {
                Result.failure(
                    ApiError(
                        statusCode = response.code(),
                        message = response.body()?.message ?: "Failed to get products"
                    )
                )
            }
        } catch (e: Exception) {
            Result.failure(e)
        }
    }
    
    suspend fun getProduct(id: Int): Result<Product> = withContext(Dispatchers.IO) {
        try {
            val response = productService.getProduct(id)
            
            if (response.isSuccessful && response.body()?.success == true) {
                Result.success(response.body()!!.data!!)
            } else {
                Result.failure(
                    ApiError(
                        statusCode = response.code(),
                        message = response.body()?.message ?: "Product not found"
                    )
                )
            }
        } catch (e: Exception) {
            Result.failure(e)
        }
    }
    
    suspend fun getProductImages(productId: Int): Result<ProductImagesResponse> = withContext(Dispatchers.IO) {
        try {
            val response = productService.getProductImages(productId)
            
            if (response.isSuccessful && response.body()?.success == true) {
                Result.success(response.body()!!.data!!)
            } else {
                Result.failure(
                    ApiError(
                        statusCode = response.code(),
                        message = response.body()?.message ?: "Failed to get product images"
                    )
                )
            }
        } catch (e: Exception) {
            Result.failure(e)
        }
    }
    
    suspend fun searchProducts(query: String): Result<SearchResponse> = withContext(Dispatchers.IO) {
        try {
            val response = productService.searchProducts(query)
            
            if (response.isSuccessful && response.body()?.success == true) {
                Result.success(response.body()!!.data!!)
            } else {
                Result.failure(
                    ApiError(
                        statusCode = response.code(),
                        message = response.body()?.message ?: "Search failed"
                    )
                )
            }
        } catch (e: Exception) {
            Result.failure(e)
        }
    }
    
    suspend fun getCategories(): Result<List<String>> = withContext(Dispatchers.IO) {
        try {
            val response = productService.getCategories()
            
            if (response.isSuccessful && response.body()?.success == true) {
                Result.success(response.body()!!.data!!)
            } else {
                Result.failure(
                    ApiError(
                        statusCode = response.code(),
                        message = response.body()?.message ?: "Failed to get categories"
                    )
                )
            }
        } catch (e: Exception) {
            Result.failure(e)
        }
    }
    
    suspend fun getFeaturedProducts(): Result<List<Product>> = withContext(Dispatchers.IO) {
        try {
            val response = productService.getFeaturedProducts()
            
            if (response.isSuccessful && response.body()?.success == true) {
                Result.success(response.body()!!.data!!)
            } else {
                Result.failure(
                    ApiError(
                        statusCode = response.code(),
                        message = response.body()?.message ?: "Failed to get featured products"
                    )
                )
            }
        } catch (e: Exception) {
            Result.failure(e)
        }
    }
    
    suspend fun getLatestProducts(): Result<List<Product>> = withContext(Dispatchers.IO) {
        try {
            val response = productService.getLatestProducts()
            
            if (response.isSuccessful && response.body()?.success == true) {
                Result.success(response.body()!!.data!!)
            } else {
                Result.failure(
                    ApiError(
                        statusCode = response.code(),
                        message = response.body()?.message ?: "Failed to get latest products"
                    )
                )
            }
        } catch (e: Exception) {
            Result.failure(e)
        }
    }
    
    suspend fun getSaleProducts(): Result<List<Product>> = withContext(Dispatchers.IO) {
        try {
            val response = productService.getSaleProducts()
            
            if (response.isSuccessful && response.body()?.success == true) {
                Result.success(response.body()!!.data!!)
            } else {
                Result.failure(
                    ApiError(
                        statusCode = response.code(),
                        message = response.body()?.message ?: "Failed to get sale products"
                    )
                )
            }
        } catch (e: Exception) {
            Result.failure(e)
        }
    }
}
```

## 5. Usage Examples

```kotlin
// app/src/main/java/com/gymin/ui/activities/MainActivity.kt
package com.gymin.ui.activities

import android.content.Intent
import android.os.Bundle
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.lifecycle.lifecycleScope
import androidx.recyclerview.widget.GridLayoutManager
import androidx.recyclerview.widget.LinearLayoutManager
import com.gymin.api.models.Product
import com.gymin.api.network.ApiClient
import com.gymin.api.repositories.AuthRepository
import com.gymin.api.repositories.ProductRepository
import com.gymin.databinding.ActivityMainBinding
import com.gymin.ui.adapters.ProductAdapter
import com.gymin.ui.adapters.CategoryAdapter
import kotlinx.coroutines.launch

class MainActivity : AppCompatActivity() {
    
    private lateinit var binding: ActivityMainBinding
    private lateinit var authRepository: AuthRepository
    private lateinit var productRepository: ProductRepository
    private lateinit var productAdapter: ProductAdapter
    private lateinit var categoryAdapter: CategoryAdapter
    
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityMainBinding.inflate(layoutInflater)
        setContentView(binding.root)
        
        initRepositories()
        setupUI()
        checkAuthAndLoadData()
    }
    
    private fun initRepositories() {
        val apiClient = ApiClient.getInstance(this)
        authRepository = AuthRepository(apiClient)
        productRepository = ProductRepository(apiClient)
    }
    
    private fun setupUI() {
        // Setup RecyclerViews
        productAdapter = ProductAdapter { product ->
            openProductDetail(product)
        }
        
        categoryAdapter = CategoryAdapter { category ->
            filterByCategory(category)
        }
        
        binding.recyclerViewProducts.apply {
            layoutManager = GridLayoutManager(this@MainActivity, 2)
            adapter = productAdapter
        }
        
        binding.recyclerViewCategories.apply {
            layoutManager = LinearLayoutManager(this@MainActivity, LinearLayoutManager.HORIZONTAL, false)
            adapter = categoryAdapter
        }
        
        // Setup click listeners
        binding.buttonProfile.setOnClickListener {
            val user = authRepository.getCachedUserData()
            if (user != null) {
                openProfile(user)
            }
        }
        
        binding.buttonSearch.setOnClickListener {
            openSearch()
        }
        
        binding.swipeRefreshLayout.setOnRefreshListener {
            loadData()
        }
    }
    
    private fun checkAuthAndLoadData() {
        if (!authRepository.isLoggedIn()) {
            startActivity(Intent(this, LoginActivity::class.java))
            finish()
            return
        }
        
        val user = authRepository.getCachedUserData()
        if (user != null) {
            binding.textWelcome.text = "Welcome back, ${user.name}!"
        }
        
        loadData()
    }
    
    private fun loadData() {
        lifecycleScope.launch {
            binding.swipeRefreshLayout.isRefreshing = true
            
            try {
                // Load categories
                val categoriesResult = productRepository.getCategories()
                categoriesResult.onSuccess { categories ->
                    categoryAdapter.submitList(categories)
                }
                
                // Load featured products
                val featuredResult = productRepository.getFeaturedProducts()
                featuredResult.onSuccess { products ->
                    binding.textFeaturedTitle.text = "Featured Equipment (${products.size})"
                    productAdapter.submitList(products)
                }
                
                featuredResult.onFailure { error ->
                    Toast.makeText(this@MainActivity, "Error: ${error.message}", Toast.LENGTH_SHORT).show()
                }
                
            } catch (e: Exception) {
                Toast.makeText(this@MainActivity, "Error loading data: ${e.message}", Toast.LENGTH_SHORT).show()
            } finally {
                binding.swipeRefreshLayout.isRefreshing = false
            }
        }
    }
    
    private fun filterByCategory(category: String) {
        lifecycleScope.launch {
            val result = productRepository.getProducts(category = category)
            result.onSuccess { productResponse ->
                productAdapter.submitList(productResponse.products)
                binding.textFeaturedTitle.text = "$category Equipment (${productResponse.products.size})"
            }
            result.onFailure { error ->
                Toast.makeText(this@MainActivity, "Error: ${error.message}", Toast.LENGTH_SHORT).show()
            }
        }
    }
    
    private fun openProductDetail(product: Product) {
        val intent = Intent(this, ProductDetailActivity::class.java).apply {
            putExtra("product_id", product.id)
        }
        startActivity(intent)
    }
    
    private fun openProfile(user: com.gymin.api.models.User) {
        val intent = Intent(this, ProfileActivity::class.java)
        startActivity(intent)
    }
    
    private fun openSearch() {
        val intent = Intent(this, SearchActivity::class.java)
        startActivity(intent)
    }
}
```

```kotlin
// app/src/main/java/com/gymin/ui/activities/LoginActivity.kt
package com.gymin.ui.activities

import android.content.Intent
import android.os.Bundle
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.lifecycle.lifecycleScope
import com.gymin.api.models.ApiError
import com.gymin.api.network.ApiClient
import com.gymin.api.repositories.AuthRepository
import com.gymin.databinding.ActivityLoginBinding
import kotlinx.coroutines.launch

class LoginActivity : AppCompatActivity() {
    
    private lateinit var binding: ActivityLoginBinding
    private lateinit var authRepository: AuthRepository
    
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityLoginBinding.inflate(layoutInflater)
        setContentView(binding.root)
        
        initRepository()
        setupUI()
    }
    
    private fun initRepository() {
        val apiClient = ApiClient.getInstance(this)
        authRepository = AuthRepository(apiClient)
    }
    
    private fun setupUI() {
        binding.buttonLogin.setOnClickListener {
            performLogin()
        }
        
        binding.textRegister.setOnClickListener {
            startActivity(Intent(this, RegisterActivity::class.java))
        }
    }
    
    private fun performLogin() {
        val email = binding.editTextEmail.text.toString().trim()
        val password = binding.editTextPassword.text.toString()
        
        if (email.isEmpty() || password.isEmpty()) {
            Toast.makeText(this, "Please fill all fields", Toast.LENGTH_SHORT).show()
            return
        }
        
        lifecycleScope.launch {
            binding.buttonLogin.isEnabled = false
            binding.progressBar.visibility = android.view.View.VISIBLE
            
            try {
                val result = authRepository.login(email, password)
                
                result.onSuccess { authResponse ->
                    Toast.makeText(this@LoginActivity, "Login successful!", Toast.LENGTH_SHORT).show()
                    startActivity(Intent(this@LoginActivity, MainActivity::class.java))
                    finish()
                }
                
                result.onFailure { error ->
                    when (error) {
                        is ApiError -> {
                            val errorMessage = error.errors?.get("email")?.firstOrNull() 
                                ?: error.errors?.get("password")?.firstOrNull()
                                ?: error.message
                            Toast.makeText(this@LoginActivity, errorMessage, Toast.LENGTH_LONG).show()
                        }
                        else -> {
                            Toast.makeText(this@LoginActivity, "Login failed: ${error.message}", Toast.LENGTH_LONG).show()
                        }
                    }
                }
                
            } catch (e: Exception) {
                Toast.makeText(this@LoginActivity, "Network error: ${e.message}", Toast.LENGTH_LONG).show()
            } finally {
                binding.buttonLogin.isEnabled = true
                binding.progressBar.visibility = android.view.View.GONE
            }
        }
    }
}
```

```kotlin
// app/src/main/java/com/gymin/ui/adapters/ProductAdapter.kt
package com.gymin.ui.adapters

import android.view.LayoutInflater
import android.view.ViewGroup
import androidx.recyclerview.widget.DiffUtil
import androidx.recyclerview.widget.ListAdapter
import androidx.recyclerview.widget.RecyclerView
import com.bumptech.glide.Glide
import com.gymin.R
import com.gymin.api.models.Product
import com.gymin.databinding.ItemProductBinding
import java.text.NumberFormat
import java.util.Locale

class ProductAdapter(
    private val onProductClick: (Product) -> Unit
) : ListAdapter<Product, ProductAdapter.ProductViewHolder>(ProductDiffCallback()) {
    
    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ProductViewHolder {
        val binding = ItemProductBinding.inflate(
            LayoutInflater.from(parent.context), parent, false
        )
        return ProductViewHolder(binding)
    }
    
    override fun onBindViewHolder(holder: ProductViewHolder, position: Int) {
        holder.bind(getItem(position))
    }
    
    inner class ProductViewHolder(
        private val binding: ItemProductBinding
    ) : RecyclerView.ViewHolder(binding.root) {
        
        fun bind(product: Product) {
            binding.apply {
                textProductName.text = product.name
                textProductCategory.text = product.category
                
                // Format price
                val formatter = NumberFormat.getCurrencyInstance(Locale.US)
                if (product.isOnSale) {
                    textProductPrice.text = formatter.format(product.salePrice)
                    textProductOriginalPrice.text = formatter.format(product.price)
                    textProductOriginalPrice.paintFlags = 
                        textProductOriginalPrice.paintFlags or android.graphics.Paint.STRIKE_THRU_TEXT_FLAG
                    textProductOriginalPrice.visibility = android.view.View.VISIBLE
                } else {
                    textProductPrice.text = formatter.format(product.price)
                    textProductOriginalPrice.visibility = android.view.View.GONE
                }
                
                // Stock status
                textStockStatus.text = if (product.isInStock) "In Stock" else "Out of Stock"
                textStockStatus.setTextColor(
                    if (product.isInStock) 
                        binding.root.context.getColor(R.color.green) 
                    else 
                        binding.root.context.getColor(R.color.red)
                )
                
                // Load image
                Glide.with(binding.root.context)
                    .load(product.mainImage)
                    .placeholder(R.drawable.placeholder_product)
                    .error(R.drawable.placeholder_product)
                    .into(imageProduct)
                
                // Sale badge
                badgeSale.visibility = if (product.isOnSale) android.view.View.VISIBLE else android.view.View.GONE
                
                // Featured badge
                badgeFeatured.visibility = if (product.isFeatured) android.view.View.VISIBLE else android.view.View.GONE
                
                root.setOnClickListener {
                    onProductClick(product)
                }
            }
        }
    }
    
    private class ProductDiffCallback : DiffUtil.ItemCallback<Product>() {
        override fun areItemsTheSame(oldItem: Product, newItem: Product): Boolean {
            return oldItem.id == newItem.id
        }
        
        override fun areContentsTheSame(oldItem: Product, newItem: Product): Boolean {
            return oldItem == newItem
        }
    }
}
```

This comprehensive Kotlin/Android SDK provides:

1. **Complete API Integration** - All endpoints with Retrofit
2. **JWT Authentication** - Token management with SharedPreferences
3. **Repository Pattern** - Clean architecture with data repositories
4. **Coroutines Support** - Async operations with proper error handling
5. **Data Models** - Complete Kotlin data classes with Gson serialization
6. **UI Examples** - Sample Activities and RecyclerView adapters
7. **Image Loading** - Glide integration for product images
8. **Error Handling** - Comprehensive error management
9. **Network Configuration** - OkHttp interceptors and logging

The SDK is production-ready and follows Android development best practices!