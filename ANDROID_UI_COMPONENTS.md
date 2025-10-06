# Android UI Components & ViewModels

## Additional Android Components for GymIn API Integration

### 1. ViewModels with LiveData

```kotlin
// app/src/main/java/com/gymin/ui/viewmodels/ProductViewModel.kt
package com.gymin.ui.viewmodels

import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.gymin.api.models.Product
import com.gymin.api.models.ProductResponse
import com.gymin.api.repositories.ProductRepository
import kotlinx.coroutines.launch

class ProductViewModel(
    private val productRepository: ProductRepository
) : ViewModel() {
    
    private val _products = MutableLiveData<List<Product>>()
    val products: LiveData<List<Product>> = _products
    
    private val _categories = MutableLiveData<List<String>>()
    val categories: LiveData<List<String>> = _categories
    
    private val _featuredProducts = MutableLiveData<List<Product>>()
    val featuredProducts: LiveData<List<Product>> = _featuredProducts
    
    private val _isLoading = MutableLiveData<Boolean>()
    val isLoading: LiveData<Boolean> = _isLoading
    
    private val _error = MutableLiveData<String?>()
    val error: LiveData<String?> = _error
    
    private val _selectedProduct = MutableLiveData<Product?>()
    val selectedProduct: LiveData<Product?> = _selectedProduct
    
    private var currentPage = 1
    private var isLastPage = false
    private var currentCategory: String? = null
    private var currentSearch: String? = null
    
    fun loadProducts(
        category: String? = null,
        search: String? = null,
        refresh: Boolean = false
    ) {
        if (refresh) {
            currentPage = 1
            isLastPage = false
            currentCategory = category
            currentSearch = search
        }
        
        if (isLastPage) return
        
        viewModelScope.launch {
            _isLoading.value = true
            _error.value = null
            
            try {
                val result = productRepository.getProducts(
                    search = search,
                    category = category,
                    page = currentPage,
                    perPage = 20
                )
                
                result.onSuccess { productResponse ->
                    val newProducts = productResponse.products
                    
                    if (refresh || currentPage == 1) {
                        _products.value = newProducts
                    } else {
                        val currentList = _products.value.orEmpty().toMutableList()
                        currentList.addAll(newProducts)
                        _products.value = currentList
                    }
                    
                    isLastPage = !productResponse.pagination.hasMorePages
                    currentPage++
                }
                
                result.onFailure { exception ->
                    _error.value = exception.message
                }
                
            } catch (e: Exception) {
                _error.value = e.message
            } finally {
                _isLoading.value = false
            }
        }
    }
    
    fun loadCategories() {
        viewModelScope.launch {
            try {
                val result = productRepository.getCategories()
                result.onSuccess { categories ->
                    _categories.value = categories
                }
                result.onFailure { exception ->
                    _error.value = exception.message
                }
            } catch (e: Exception) {
                _error.value = e.message
            }
        }
    }
    
    fun loadFeaturedProducts() {
        viewModelScope.launch {
            try {
                val result = productRepository.getFeaturedProducts()
                result.onSuccess { products ->
                    _featuredProducts.value = products
                }
                result.onFailure { exception ->
                    _error.value = exception.message
                }
            } catch (e: Exception) {
                _error.value = e.message
            }
        }
    }
    
    fun loadProduct(productId: Int) {
        viewModelScope.launch {
            _isLoading.value = true
            _error.value = null
            
            try {
                val result = productRepository.getProduct(productId)
                result.onSuccess { product ->
                    _selectedProduct.value = product
                }
                result.onFailure { exception ->
                    _error.value = exception.message
                }
            } catch (e: Exception) {
                _error.value = e.message
            } finally {
                _isLoading.value = false
            }
        }
    }
    
    fun searchProducts(query: String) {
        viewModelScope.launch {
            _isLoading.value = true
            _error.value = null
            
            try {
                val result = productRepository.searchProducts(query)
                result.onSuccess { searchResponse ->
                    _products.value = searchResponse.products
                }
                result.onFailure { exception ->
                    _error.value = exception.message
                }
            } catch (e: Exception) {
                _error.value = e.message
            } finally {
                _isLoading.value = false
            }
        }
    }
    
    fun loadMoreProducts() {
        if (!isLastPage && _isLoading.value != true) {
            loadProducts(currentCategory, currentSearch, false)
        }
    }
    
    fun clearError() {
        _error.value = null
    }
}
```

```kotlin
// app/src/main/java/com/gymin/ui/viewmodels/AuthViewModel.kt
package com.gymin.ui.viewmodels

import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.gymin.api.models.ApiError
import com.gymin.api.models.User
import com.gymin.api.repositories.AuthRepository
import kotlinx.coroutines.launch

class AuthViewModel(
    private val authRepository: AuthRepository
) : ViewModel() {
    
    private val _user = MutableLiveData<User?>()
    val user: LiveData<User?> = _user
    
    private val _isLoading = MutableLiveData<Boolean>()
    val isLoading: LiveData<Boolean> = _isLoading
    
    private val _error = MutableLiveData<String?>()
    val error: LiveData<String?> = _error
    
    private val _isLoggedIn = MutableLiveData<Boolean>()
    val isLoggedIn: LiveData<Boolean> = _isLoggedIn
    
    private val _loginSuccess = MutableLiveData<Boolean>()
    val loginSuccess: LiveData<Boolean> = _loginSuccess
    
    private val _registerSuccess = MutableLiveData<Boolean>()
    val registerSuccess: LiveData<Boolean> = _registerSuccess
    
    init {
        checkLoginStatus()
    }
    
    private fun checkLoginStatus() {
        _isLoggedIn.value = authRepository.isLoggedIn()
        if (authRepository.isLoggedIn()) {
            _user.value = authRepository.getCachedUserData()
        }
    }
    
    fun login(email: String, password: String) {
        viewModelScope.launch {
            _isLoading.value = true
            _error.value = null
            
            try {
                val result = authRepository.login(email, password)
                
                result.onSuccess { authResponse ->
                    _user.value = authResponse.user
                    _isLoggedIn.value = true
                    _loginSuccess.value = true
                }
                
                result.onFailure { exception ->
                    when (exception) {
                        is ApiError -> {
                            _error.value = exception.errors?.get("email")?.firstOrNull()
                                ?: exception.errors?.get("password")?.firstOrNull()
                                ?: exception.message
                        }
                        else -> {
                            _error.value = exception.message
                        }
                    }
                }
                
            } catch (e: Exception) {
                _error.value = e.message
            } finally {
                _isLoading.value = false
            }
        }
    }
    
    fun register(name: String, email: String, password: String, passwordConfirmation: String) {
        viewModelScope.launch {
            _isLoading.value = true
            _error.value = null
            
            try {
                val result = authRepository.register(name, email, password, passwordConfirmation)
                
                result.onSuccess { authResponse ->
                    _user.value = authResponse.user
                    _isLoggedIn.value = true
                    _registerSuccess.value = true
                }
                
                result.onFailure { exception ->
                    when (exception) {
                        is ApiError -> {
                            _error.value = exception.errors?.values?.flatten()?.firstOrNull()
                                ?: exception.message
                        }
                        else -> {
                            _error.value = exception.message
                        }
                    }
                }
                
            } catch (e: Exception) {
                _error.value = e.message
            } finally {
                _isLoading.value = false
            }
        }
    }
    
    fun getCurrentUser() {
        viewModelScope.launch {
            _isLoading.value = true
            
            try {
                val result = authRepository.getCurrentUser()
                result.onSuccess { user ->
                    _user.value = user
                }
                result.onFailure { exception ->
                    _error.value = exception.message
                }
            } catch (e: Exception) {
                _error.value = e.message
            } finally {
                _isLoading.value = false
            }
        }
    }
    
    fun logout() {
        viewModelScope.launch {
            try {
                authRepository.logout()
                _user.value = null
                _isLoggedIn.value = false
            } catch (e: Exception) {
                _error.value = e.message
            }
        }
    }
    
    fun updateProfile(
        name: String?,
        email: String?,
        currentPassword: String?,
        newPassword: String?,
        passwordConfirmation: String?
    ) {
        viewModelScope.launch {
            _isLoading.value = true
            _error.value = null
            
            try {
                val result = authRepository.updateProfile(
                    name, email, currentPassword, newPassword, passwordConfirmation
                )
                
                result.onSuccess { user ->
                    _user.value = user
                }
                
                result.onFailure { exception ->
                    when (exception) {
                        is ApiError -> {
                            _error.value = exception.errors?.values?.flatten()?.firstOrNull()
                                ?: exception.message
                        }
                        else -> {
                            _error.value = exception.message
                        }
                    }
                }
                
            } catch (e: Exception) {
                _error.value = e.message
            } finally {
                _isLoading.value = false
            }
        }
    }
    
    fun clearError() {
        _error.value = null
    }
    
    fun clearLoginSuccess() {
        _loginSuccess.value = false
    }
    
    fun clearRegisterSuccess() {
        _registerSuccess.value = false
    }
}
```

### 2. XML Layout Files

```xml
<!-- app/src/main/res/layout/activity_main.xml -->
<?xml version="1.0" encoding="utf-8"?>
<androidx.coordinatorlayout.widget.CoordinatorLayout xmlns:android="http://schemas.android.com/apk/res/android"
    xmlns:app="http://schemas.android.com/apk/res-auto"
    xmlns:tools="http://schemas.android.com/tools"
    android:layout_width="match_parent"
    android:layout_height="match_parent"
    tools:context=".ui.activities.MainActivity">

    <com.google.android.material.appbar.AppBarLayout
        android:layout_width="match_parent"
        android:layout_height="wrap_content"
        android:theme="@style/AppTheme.AppBarOverlay">

        <androidx.appcompat.widget.Toolbar
            android:id="@+id/toolbar"
            android:layout_width="match_parent"
            android:layout_height="?attr/actionBarSize"
            android:background="@color/red_600"
            app:popupTheme="@style/AppTheme.PopupOverlay"
            app:title="GymIn Equipment"
            app:titleTextColor="@android:color/white">

            <LinearLayout
                android:layout_width="wrap_content"
                android:layout_height="wrap_content"
                android:layout_gravity="end"
                android:layout_marginEnd="16dp"
                android:orientation="horizontal">

                <ImageButton
                    android:id="@+id/button_search"
                    android:layout_width="wrap_content"
                    android:layout_height="wrap_content"
                    android:background="?attr/selectableItemBackgroundBorderless"
                    android:contentDescription="Search"
                    android:src="@drawable/ic_search"
                    android:tint="@android:color/white" />

                <ImageButton
                    android:id="@+id/button_profile"
                    android:layout_width="wrap_content"
                    android:layout_height="wrap_content"
                    android:layout_marginStart="8dp"
                    android:background="?attr/selectableItemBackgroundBorderless"
                    android:contentDescription="Profile"
                    android:src="@drawable/ic_person"
                    android:tint="@android:color/white" />

            </LinearLayout>

        </androidx.appcompat.widget.Toolbar>

    </com.google.android.material.appbar.AppBarLayout>

    <androidx.swiperefreshlayout.widget.SwipeRefreshLayout
        android:id="@+id/swipe_refresh_layout"
        android:layout_width="match_parent"
        android:layout_height="match_parent"
        app:layout_behavior="@string/appbar_scrolling_view_behavior">

        <androidx.core.widget.NestedScrollView
            android:layout_width="match_parent"
            android:layout_height="match_parent">

            <LinearLayout
                android:layout_width="match_parent"
                android:layout_height="wrap_content"
                android:orientation="vertical">

                <!-- Welcome Section -->
                <androidx.cardview.widget.CardView
                    android:layout_width="match_parent"
                    android:layout_height="wrap_content"
                    android:layout_margin="16dp"
                    app:cardCornerRadius="12dp"
                    app:cardElevation="4dp">

                    <LinearLayout
                        android:layout_width="match_parent"
                        android:layout_height="wrap_content"
                        android:background="@drawable/gradient_red"
                        android:orientation="horizontal"
                        android:padding="16dp">

                        <ImageView
                            android:layout_width="48dp"
                            android:layout_height="48dp"
                            android:background="@drawable/circle_white"
                            android:padding="12dp"
                            android:src="@drawable/ic_person"
                            android:tint="@color/red_600" />

                        <LinearLayout
                            android:layout_width="0dp"
                            android:layout_height="wrap_content"
                            android:layout_gravity="center_vertical"
                            android:layout_marginStart="16dp"
                            android:layout_weight="1"
                            android:orientation="vertical">

                            <TextView
                                android:layout_width="wrap_content"
                                android:layout_height="wrap_content"
                                android:text="Welcome back,"
                                android:textColor="@android:color/white"
                                android:textSize="14sp" />

                            <TextView
                                android:id="@+id/text_welcome"
                                android:layout_width="wrap_content"
                                android:layout_height="wrap_content"
                                android:text="User Name"
                                android:textColor="@android:color/white"
                                android:textSize="18sp"
                                android:textStyle="bold" />

                        </LinearLayout>

                    </LinearLayout>

                </androidx.cardview.widget.CardView>

                <!-- Categories Section -->
                <LinearLayout
                    android:layout_width="match_parent"
                    android:layout_height="wrap_content"
                    android:layout_marginHorizontal="16dp"
                    android:layout_marginBottom="16dp"
                    android:orientation="vertical">

                    <TextView
                        android:layout_width="wrap_content"
                        android:layout_height="wrap_content"
                        android:layout_marginBottom="12dp"
                        android:text="Categories"
                        android:textSize="20sp"
                        android:textStyle="bold" />

                    <androidx.recyclerview.widget.RecyclerView
                        android:id="@+id/recycler_view_categories"
                        android:layout_width="match_parent"
                        android:layout_height="wrap_content"
                        android:clipToPadding="false"
                        android:paddingHorizontal="4dp" />

                </LinearLayout>

                <!-- Featured Products Section -->
                <LinearLayout
                    android:layout_width="match_parent"
                    android:layout_height="wrap_content"
                    android:layout_marginHorizontal="16dp"
                    android:orientation="vertical">

                    <TextView
                        android:id="@+id/text_featured_title"
                        android:layout_width="wrap_content"
                        android:layout_height="wrap_content"
                        android:layout_marginBottom="12dp"
                        android:text="Featured Equipment"
                        android:textSize="20sp"
                        android:textStyle="bold" />

                    <androidx.recyclerview.widget.RecyclerView
                        android:id="@+id/recycler_view_products"
                        android:layout_width="match_parent"
                        android:layout_height="wrap_content"
                        android:clipToPadding="false"
                        android:paddingHorizontal="4dp"
                        android:paddingBottom="16dp" />

                </LinearLayout>

            </LinearLayout>

        </androidx.core.widget.NestedScrollView>

    </androidx.swiperefreshlayout.widget.SwipeRefreshLayout>

    <!-- Loading Progress -->
    <ProgressBar
        android:id="@+id/progress_bar"
        android:layout_width="wrap_content"
        android:layout_height="wrap_content"
        android:layout_gravity="center"
        android:visibility="gone" />

</androidx.coordinatorlayout.widget.CoordinatorLayout>
```

```xml
<!-- app/src/main/res/layout/item_product.xml -->
<?xml version="1.0" encoding="utf-8"?>
<androidx.cardview.widget.CardView xmlns:android="http://schemas.android.com/apk/res/android"
    xmlns:app="http://schemas.android.com/apk/res-auto"
    xmlns:tools="http://schemas.android.com/tools"
    android:layout_width="match_parent"
    android:layout_height="wrap_content"
    android:layout_margin="8dp"
    android:clickable="true"
    android:focusable="true"
    android:foreground="?android:attr/selectableItemBackground"
    app:cardCornerRadius="12dp"
    app:cardElevation="4dp">

    <LinearLayout
        android:layout_width="match_parent"
        android:layout_height="wrap_content"
        android:orientation="vertical">

        <FrameLayout
            android:layout_width="match_parent"
            android:layout_height="150dp">

            <ImageView
                android:id="@+id/image_product"
                android:layout_width="match_parent"
                android:layout_height="match_parent"
                android:scaleType="centerCrop"
                tools:src="@drawable/placeholder_product" />

            <!-- Sale Badge -->
            <TextView
                android:id="@+id/badge_sale"
                android:layout_width="wrap_content"
                android:layout_height="wrap_content"
                android:layout_gravity="top|end"
                android:layout_margin="8dp"
                android:background="@drawable/badge_sale"
                android:paddingHorizontal="8dp"
                android:paddingVertical="4dp"
                android:text="SALE"
                android:textColor="@android:color/white"
                android:textSize="10sp"
                android:textStyle="bold"
                android:visibility="gone" />

            <!-- Featured Badge -->
            <TextView
                android:id="@+id/badge_featured"
                android:layout_width="wrap_content"
                android:layout_height="wrap_content"
                android:layout_gravity="top|start"
                android:layout_margin="8dp"
                android:background="@drawable/badge_featured"
                android:paddingHorizontal="8dp"
                android:paddingVertical="4dp"
                android:text="FEATURED"
                android:textColor="@android:color/white"
                android:textSize="10sp"
                android:textStyle="bold"
                android:visibility="gone" />

        </FrameLayout>

        <LinearLayout
            android:layout_width="match_parent"
            android:layout_height="wrap_content"
            android:orientation="vertical"
            android:padding="12dp">

            <TextView
                android:id="@+id/text_product_name"
                android:layout_width="match_parent"
                android:layout_height="wrap_content"
                android:ellipsize="end"
                android:maxLines="2"
                android:textSize="14sp"
                android:textStyle="bold"
                tools:text="Professional Treadmill Pro X1" />

            <TextView
                android:id="@+id/text_product_category"
                android:layout_width="match_parent"
                android:layout_height="wrap_content"
                android:layout_marginTop="4dp"
                android:textColor="@color/gray_600"
                android:textSize="12sp"
                tools:text="Cardio Equipment" />

            <LinearLayout
                android:layout_width="match_parent"
                android:layout_height="wrap_content"
                android:layout_marginTop="8dp"
                android:orientation="horizontal">

                <TextView
                    android:id="@+id/text_product_price"
                    android:layout_width="0dp"
                    android:layout_height="wrap_content"
                    android:layout_weight="1"
                    android:textColor="@color/red_600"
                    android:textSize="16sp"
                    android:textStyle="bold"
                    tools:text="$2,199.99" />

                <TextView
                    android:id="@+id/text_product_original_price"
                    android:layout_width="wrap_content"
                    android:layout_height="wrap_content"
                    android:layout_marginStart="8dp"
                    android:textColor="@color/gray_500"
                    android:textSize="12sp"
                    android:visibility="gone"
                    tools:text="$2,499.99" />

            </LinearLayout>

            <TextView
                android:id="@+id/text_stock_status"
                android:layout_width="wrap_content"
                android:layout_height="wrap_content"
                android:layout_marginTop="4dp"
                android:textSize="12sp"
                android:textStyle="bold"
                tools:text="In Stock"
                tools:textColor="@color/green_600" />

        </LinearLayout>

    </LinearLayout>

</androidx.cardview.widget.CardView>
```

```xml
<!-- app/src/main/res/layout/activity_login.xml -->
<?xml version="1.0" encoding="utf-8"?>
<LinearLayout xmlns:android="http://schemas.android.com/apk/res/android"
    xmlns:app="http://schemas.android.com/apk/res-auto"
    android:layout_width="match_parent"
    android:layout_height="match_parent"
    android:background="@drawable/gradient_red"
    android:orientation="vertical"
    android:padding="24dp">

    <LinearLayout
        android:layout_width="match_parent"
        android:layout_height="0dp"
        android:layout_weight="1"
        android:gravity="center"
        android:orientation="vertical">

        <ImageView
            android:layout_width="120dp"
            android:layout_height="120dp"
            android:layout_marginBottom="24dp"
            android:src="@drawable/ic_fitness_center"
            android:tint="@android:color/white" />

        <TextView
            android:layout_width="wrap_content"
            android:layout_height="wrap_content"
            android:layout_marginBottom="8dp"
            android:text="GymIn"
            android:textColor="@android:color/white"
            android:textSize="48sp"
            android:textStyle="bold" />

        <TextView
            android:layout_width="wrap_content"
            android:layout_height="wrap_content"
            android:layout_marginBottom="48dp"
            android:text="Professional Gym Equipment"
            android:textColor="@android:color/white"
            android:textSize="16sp" />

    </LinearLayout>

    <androidx.cardview.widget.CardView
        android:layout_width="match_parent"
        android:layout_height="wrap_content"
        app:cardCornerRadius="16dp"
        app:cardElevation="8dp">

        <LinearLayout
            android:layout_width="match_parent"
            android:layout_height="wrap_content"
            android:orientation="vertical"
            android:padding="24dp">

            <TextView
                android:layout_width="wrap_content"
                android:layout_height="wrap_content"
                android:layout_marginBottom="24dp"
                android:text="Welcome Back"
                android:textSize="24sp"
                android:textStyle="bold" />

            <com.google.android.material.textfield.TextInputLayout
                android:layout_width="match_parent"
                android:layout_height="wrap_content"
                android:layout_marginBottom="16dp"
                app:boxStrokeColor="@color/red_600"
                app:hintTextColor="@color/red_600">

                <com.google.android.material.textfield.TextInputEditText
                    android:id="@+id/edit_text_email"
                    android:layout_width="match_parent"
                    android:layout_height="wrap_content"
                    android:hint="Email"
                    android:inputType="textEmailAddress" />

            </com.google.android.material.textfield.TextInputLayout>

            <com.google.android.material.textfield.TextInputLayout
                android:layout_width="match_parent"
                android:layout_height="wrap_content"
                android:layout_marginBottom="24dp"
                app:boxStrokeColor="@color/red_600"
                app:hintTextColor="@color/red_600"
                app:passwordToggleEnabled="true">

                <com.google.android.material.textfield.TextInputEditText
                    android:id="@+id/edit_text_password"
                    android:layout_width="match_parent"
                    android:layout_height="wrap_content"
                    android:hint="Password"
                    android:inputType="textPassword" />

            </com.google.android.material.textfield.TextInputLayout>

            <com.google.android.material.button.MaterialButton
                android:id="@+id/button_login"
                android:layout_width="match_parent"
                android:layout_height="56dp"
                android:layout_marginBottom="16dp"
                android:backgroundTint="@color/red_600"
                android:text="Login"
                android:textColor="@android:color/white"
                android:textSize="16sp"
                app:cornerRadius="8dp" />

            <ProgressBar
                android:id="@+id/progress_bar"
                android:layout_width="wrap_content"
                android:layout_height="wrap_content"
                android:layout_gravity="center"
                android:layout_marginBottom="16dp"
                android:visibility="gone" />

            <TextView
                android:id="@+id/text_register"
                android:layout_width="wrap_content"
                android:layout_height="wrap_content"
                android:layout_gravity="center"
                android:clickable="true"
                android:focusable="true"
                android:foreground="?android:attr/selectableItemBackground"
                android:padding="8dp"
                android:text="Don't have an account? Register"
                android:textColor="@color/red_600"
                android:textStyle="bold" />

        </LinearLayout>

    </androidx.cardview.widget.CardView>

</LinearLayout>
```

### 3. ViewModelFactory

```kotlin
// app/src/main/java/com/gymin/ui/viewmodels/ViewModelFactory.kt
package com.gymin.ui.viewmodels

import androidx.lifecycle.ViewModel
import androidx.lifecycle.ViewModelProvider
import com.gymin.api.repositories.AuthRepository
import com.gymin.api.repositories.ProductRepository

class ViewModelFactory(
    private val authRepository: AuthRepository,
    private val productRepository: ProductRepository
) : ViewModelProvider.Factory {
    
    @Suppress("UNCHECKED_CAST")
    override fun <T : ViewModel> create(modelClass: Class<T>): T {
        return when {
            modelClass.isAssignableFrom(AuthViewModel::class.java) -> {
                AuthViewModel(authRepository) as T
            }
            modelClass.isAssignableFrom(ProductViewModel::class.java) -> {
                ProductViewModel(productRepository) as T
            }
            else -> throw IllegalArgumentException("Unknown ViewModel class: ${modelClass.name}")
        }
    }
}
```

### 4. Application Class

```kotlin
// app/src/main/java/com/gymin/GymInApplication.kt
package com.gymin

import android.app.Application
import com.gymin.api.network.ApiClient
import com.gymin.api.repositories.AuthRepository
import com.gymin.api.repositories.ProductRepository
import com.gymin.ui.viewmodels.ViewModelFactory

class GymInApplication : Application() {
    
    // API Client
    val apiClient by lazy { ApiClient.getInstance(this) }
    
    // Repositories
    val authRepository by lazy { AuthRepository(apiClient) }
    val productRepository by lazy { ProductRepository(apiClient) }
    
    // ViewModel Factory
    val viewModelFactory by lazy { ViewModelFactory(authRepository, productRepository) }
    
    override fun onCreate() {
        super.onCreate()
    }
}
```

### 5. Colors and Drawables

```xml
<!-- app/src/main/res/values/colors.xml -->
<?xml version="1.0" encoding="utf-8"?>
<resources>
    <color name="red_600">#DC2626</color>
    <color name="red_700">#B91C1C</color>
    <color name="red_800">#991B1B</color>
    <color name="gray_50">#F9FAFB</color>
    <color name="gray_100">#F3F4F6</color>
    <color name="gray_200">#E5E7EB</color>
    <color name="gray_300">#D1D5DB</color>
    <color name="gray_400">#9CA3AF</color>
    <color name="gray_500">#6B7280</color>
    <color name="gray_600">#4B5563</color>
    <color name="gray_700">#374151</color>
    <color name="gray_800">#1F2937</color>
    <color name="gray_900">#111827</color>
    <color name="green_600">#059669</color>
    <color name="green_700">#047857</color>
    <color name="blue_600">#2563EB</color>
    <color name="yellow_600">#D97706</color>
</resources>
```

```xml
<!-- app/src/main/res/drawable/gradient_red.xml -->
<?xml version="1.0" encoding="utf-8"?>
<shape xmlns:android="http://schemas.android.com/apk/res/android">
    <gradient
        android:startColor="@color/red_600"
        android:endColor="@color/red_800"
        android:angle="135" />
</shape>
```

```xml
<!-- app/src/main/res/drawable/badge_sale.xml -->
<?xml version="1.0" encoding="utf-8"?>
<shape xmlns:android="http://schemas.android.com/apk/res/android">
    <solid android:color="@color/red_600" />
    <corners android:radius="12dp" />
</shape>
```

```xml
<!-- app/src/main/res/drawable/badge_featured.xml -->
<?xml version="1.0" encoding="utf-8"?>
<shape xmlns:android="http://schemas.android.com/apk/res/android">
    <solid android:color="@color/blue_600" />
    <corners android:radius="12dp" />
</shape>
```

This comprehensive Kotlin/Android SDK now includes:

1. **Complete MVVM Architecture** with ViewModels and LiveData
2. **Professional UI Components** with Material Design
3. **Repository Pattern** for clean data management
4. **Dependency Injection** ready structure
5. **Error Handling** with proper user feedback
6. **Image Loading** with Glide integration
7. **Responsive Layouts** for different screen sizes
8. **Modern Android Development** practices

The SDK is production-ready for native Android development! 🚀