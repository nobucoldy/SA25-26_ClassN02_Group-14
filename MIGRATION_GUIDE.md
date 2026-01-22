# 🎬 Hướng Dẫn Sử Dụng Dữ Liệu Directors, Actors, Genres

## ✅ Những gì đã được sửa

### 1. **Model Updates**
- ✅ `Movie.php` - Thêm relationships: `director()`, `actors()`, `genres()`
- ✅ `Genre.php` - Thêm `HasFactory` trait
- ✅ Loại bỏ `genre` string field từ `fillable` của Movie

### 2. **Controllers**
- ✅ `MovieController@show()` - Eager load: `director`, `actors`, `genres`
- ✅ `BookingController@create()` - Eager load: `director`, `actors`, `genres`

### 3. **Views**
- ✅ `show.blade.php` - Hiển thị Directors, Actors, Genres chi tiết
- ✅ `booking/create.blade.php` - Thêm Director, Genres, Cast info vào header

---

## 📋 Yêu Cầu Migration Database

Nếu chưa chạy migration, hãy thực hiện:

```bash
php artisan migrate
```

Điều này sẽ tạo các bảng:
- `directors` - Danh sách đạo diễn
- `actors` - Danh sách diễn viên  
- `genres` - Danh sách thể loại
- `actor_movie` - Liên kết giữa actors và movies (Many-to-Many)
- `genre_movie` - Liên kết giữa genres và movies (Many-to-Many)
- `movies` - Cập nhật thêm `director_id` foreign key

---

## 🌱 Seeding Data (Tùy chọn)

### Tạo Factory files (nếu chưa có):

```bash
php artisan make:factory DirectorFactory --model=Director
php artisan make:factory ActorFactory --model=Actor
php artisan make:factory GenreFactory --model=Genre
```

### Chạy Seeder để thêm dữ liệu mẫu:

```bash
php artisan db:seed
```

---

## 🔍 Kiểm Tra Dữ Liệu

### Sử dụng Tinker:

```bash
php artisan tinker
```

```php
// Kiểm tra phim với director và actors
$movie = Movie::with('director', 'actors', 'genres')->first();

// Xem director
echo $movie->director->name;

// Xem danh sách actors
$movie->actors->each(fn($a) => echo $a->name . "\n");

// Xem danh sách genres
$movie->genres->each(fn($g) => echo $g->name . "\n");
```

---

## 📝 Cách Tạo/Cập Nhật Dữ Liệu

### 1. **Tạo phim với Director**
```php
$director = Director::create(['name' => 'Christopher Nolan']);

$movie = Movie::create([
    'title' => 'Inception',
    'description' => '...',
    'duration' => 148,
    'director_id' => $director->id,
    'status' => 'showing',
    ...
]);
```

### 2. **Gán Actors cho Phim**
```php
$actor1 = Actor::create(['name' => 'Leonardo DiCaprio']);
$actor2 = Actor::create(['name' => 'Marion Cotillard']);

// Gán actors (Many-to-Many)
$movie->actors()->attach([$actor1->id, $actor2->id]);

// Hay
$movie->actors()->sync([$actor1->id, $actor2->id]);
```

### 3. **Gán Genres cho Phim**
```php
$scifi = Genre::create(['name' => 'Science Fiction']);
$thriller = Genre::create(['name' => 'Thriller']);

$movie->genres()->sync([$scifi->id, $thriller->id]);
```

---

## 🎯 Hiển Thị Data trong Views

### Trang Chi Tiết Phim (`show.blade.php`)
```blade
<!-- Director -->
@if($movie->director)
    <p>Director: {{ $movie->director->name }}</p>
@endif

<!-- Genres -->
@forelse($movie->genres as $genre)
    <span>{{ $genre->name }}</span>
@empty
    <span>N/A</span>
@endforelse

<!-- Actors -->
@forelse($movie->actors as $actor)
    <span>{{ $actor->name }}</span>
@empty
    <span>N/A</span>
@endforelse
```

### Trang Booking (`booking/create.blade.php`)
```blade
<!-- Đã thêm vào header -->
<strong>Director:</strong> {{ $showtime->movie->director->name }}
<strong>Genre:</strong> {{ $showtime->movie->genres->pluck('name')->join(', ') }}
<strong>Cast:</strong> {{ $showtime->movie->actors->pluck('name')->join(', ') }}
```

---

## 🚀 Next Steps

1. **Chạy migration**: `php artisan migrate`
2. **Thêm dữ liệu**: Dùng Admin Panel hoặc Seeder
3. **Test**: Truy cập trang chi tiết phim để xem dữ liệu
4. **Sửa lỗi**: Nếu có lỗi, kiểm tra Database constraints

---

## ⚠️ Lưu Ý Quan Trọng

1. **Foreign Key**: `movies.director_id` phải tồn tại trong bảng `directors`
2. **Pivot Tables**: Dùng `sync()` hoặc `attach()` để quản lý many-to-many
3. **Null values**: Director và Genres có thể nullable, nhưng nên có ít nhất một actor

---

## 📞 Troubleshooting

### Lỗi: "No query results for model"
→ Kiểm tra database có dữ liệu chưa

### Lỗi: "Call to undefined method"
→ Chắc chắn đã chạy migration và khai báo relationships

### Dữ liệu không hiển thị
→ Kiểm tra `eager load` trong Controller có khớp không

---

**Happy Coding! 🎉**
