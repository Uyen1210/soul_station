<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Book;
use App\Models\Author;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Hậu',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'test@gmail.com',
            'password' => '00000000',
            'role' => 'admin',
            'status' => 'active',
        ]);

        User::factory()->create([
            'name' => 'User Test',
            'email' => 'user@gmail.com',
            'password' => '12345678',
            'role' => 'user',
            'status' => 'active',
        ]);

        User::factory(10)->create([
            'role' => 'user',
            'status' => 'active',
        ]);

        $categoriesData = [
            ['name' => 'Kinh dị'],
            ['name' => 'Trinh thám'],
            ['name' => 'Văn học nước ngoài'],
            ['name' => 'Văn học Việt Nam'],
            ['name' => 'Kỹ năng sống'],
            ['name' => 'Tâm lý học'],
            ['name' => 'Khoa học viễn tưởng'],
            ['name' => 'Lịch sử & Địa lý'],
            ['name' => 'Sách Ngoại ngữ'],
            ['name' => 'Truyện tranh & Manga'],
        ];
        Category::insert($categoriesData);

        $authorsData = [
            ['name' => 'J.K. Rowling'],
            ['name' => 'Dale Carnegie'],
            ['name' => 'Paulo Coelho'],
            ['name' => 'Robert C. Martin'],
            ['name' => 'Yuval Noah Harari'],
            ['name' => 'F. Scott Fitzgerald'],
            ['name' => 'James Clear'],
            ['name' => 'Fujiko F. Fujio'],
            ['name' => 'Daniel Kahneman'],
            ['name' => 'Jane Austen'],
        ];
        Author::insert($authorsData);

        $categoryIds = Category::pluck('id')->toArray();
        $authorIds = Author::pluck('id')->toArray();

        Book::create([
            'title' => 'Harry Potter và Hòn Đá Phù Thủy',
            'cover_image' => 'https://via.placeholder.com/200x300?text=Harry+Potter',
            'description' => 'Cuốn sách đầu tiên trong series Harry Potter.',
            'category_id' => $categoryIds[array_rand($categoryIds)],
            'author_id' => $authorIds[array_rand($authorIds)],
            'quantity' => 5,
        ]);

        Book::create([
            'title' => 'Harry Potter và Phòng Chứa Bí Mật',
            'cover_image' => 'https://via.placeholder.com/200x300?text=Harry+Potter+2',
            'description' => 'Cuốn sách thứ hai trong series Harry Potter.',
            'category_id' => $categoryIds[array_rand($categoryIds)],
            'author_id' => $authorIds[array_rand($authorIds)],
            'quantity' => 10,
        ]);

        Book::create([
            'title' => 'Nhà Giả Kim',
            'cover_image' => 'https://via.placeholder.com/200x300?text=Nha+Gia+Kim',
            'description' => 'Câu chuyện về hành trình theo đuổi giấc mơ.',
            'category_id' => $categoryIds[array_rand($categoryIds)],
            'author_id' => $authorIds[array_rand($authorIds)],
            'quantity' => 8,
        ]);

        Book::create([
            'title' => 'Clean Code',
            'cover_image' => 'https://via.placeholder.com/200x300?text=Clean+Code',
            'description' => 'Hướng dẫn viết code sạch cho lập trình viên.',
            'category_id' => $categoryIds[array_rand($categoryIds)],
            'author_id' => $authorIds[array_rand($authorIds)],
            'quantity' => 15,
        ]);

        Book::create([
            'title' => 'Sapiens: Lược Sử Loài Người',
            'cover_image' => 'https://via.placeholder.com/200x300?text=Sapiens',
            'description' => 'Lịch sử loài người từ thời tiền sử.',
            'category_id' => $categoryIds[array_rand($categoryIds)],
            'author_id' => $authorIds[array_rand($authorIds)],
            'quantity' => 7,
        ]);

        Book::create([
            'title' => 'The Great Gatsby',
            'cover_image' => 'https://via.placeholder.com/200x300?text=Great+Gatsby',
            'description' => 'Tiểu thuyết kinh điển về giấc mơ Mỹ.',
            'category_id' => $categoryIds[array_rand($categoryIds)],
            'author_id' => $authorIds[array_rand($authorIds)],
            'quantity' => 6,
        ]);

        Book::create([
            'title' => 'Atomic Habits',
            'cover_image' => 'https://via.placeholder.com/200x300?text=Atomic+Habits',
            'description' => 'Xây dựng thói quen tốt để thay đổi cuộc đời.',
            'category_id' => $categoryIds[array_rand($categoryIds)],
            'author_id' => $authorIds[array_rand($authorIds)],
            'quantity' => 12,
        ]);

        Book::create([
            'title' => 'Doraemon Tập 1',
            'cover_image' => 'https://via.placeholder.com/200x300?text=Doraemon',
            'description' => 'Truyện tranh thiếu nhi nổi tiếng.',
            'category_id' => $categoryIds[array_rand($categoryIds)],
            'author_id' => $authorIds[array_rand($authorIds)],
            'quantity' => 20,
        ]);

        Book::create([
            'title' => 'Thinking, Fast and Slow',
            'cover_image' => 'https://via.placeholder.com/200x300?text=Thinking+Fast',
            'description' => 'Tâm lý học về tư duy nhanh và chậm.',
            'category_id' => $categoryIds[array_rand($categoryIds)],
            'author_id' => $authorIds[array_rand($authorIds)],
            'quantity' => 9,
        ]);

        Book::create([
            'title' => 'Pride and Prejudice',
            'cover_image' => 'https://via.placeholder.com/200x300?text=Pride+Prejudice',
            'description' => 'Tiểu thuyết lãng mạn cổ điển.',
            'category_id' => $categoryIds[array_rand($categoryIds)],
            'author_id' => $authorIds[array_rand($authorIds)],
            'quantity' => 4,
        ]);
    }
}