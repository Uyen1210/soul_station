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
            ['name' => 'Châu Sa Đáy Mắt'],
            ['name' => 'Adam Khoo'],
            ['name' => 'Nguyễn Đoàn Minh Thư'],
            ['name' => 'José Mauro de Vasconcelos'],
            ['name' => 'James Clear'],
            ['name' => 'Fujiko F. Fujio'],
            ['name' => 'Kim Soyeong'],
            ['name' => 'Jane Austen'],
        ];
        Author::insert($authorsData);

        $categoryIds = Category::pluck('id')->toArray();
        $authorIds = Author::pluck('id')->toArray();

        Book::create([
            'title' => 'Harry Potter và Hòn Đá Phù Thủy',
            'cover_image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1474154022i/3.jpg',
            'description' => 'Cuốn sách đầu tiên trong series Harry Potter.',
            'category_id' => $categoryIds[array_rand($categoryIds)],
            'author_id' => $authorIds[array_rand($authorIds)],
            'quantity' => 5,
        ]);

        Book::create([
            'title' => 'Harry Potter và tên tù nhân ngục Azkaban',
            'cover_image' => 'https://cdn1.fahasa.com/media/catalog/product/8/9/8934974179658_1.jpg',
            'description' => 'Cuốn sách thứ hai trong series Harry Potter.',
            'category_id' => $categoryIds[array_rand($categoryIds)],
            'author_id' => $authorIds[array_rand($authorIds)],
            'quantity' => 10,
        ]);

        Book::create([
            'title' => 'Hành tinh của một kẻ nghĩ nhiều',
            'cover_image' => 'https://www.netabooks.vn/Data/Sites/1/Product/47457/hanh-tinh-cua-mot-ke-nghi-nhieu.jpg',
            'description' => 'Cuốn sách "Hành tinh của một kẻ nghĩ nhiều" là một hành trình khám phá sâu sắc về thế giới nội tâm của những người trẻ, những người thường xuyên phải đối mặt với những lo âu, trăn trở và những cuộc chiến nội tâm. ',
            'category_id' => $categoryIds[array_rand($categoryIds)],
            'author_id' => $authorIds[array_rand($authorIds)],
            'quantity' => 8,
        ]);

        Book::create([
            'title' => 'Big Step 1',
            'cover_image' => 'https://nhasachdaruma.com/wp-content/uploads/2021/08/1.jpg',
            'description' => 'Từ trình độ sơ cấp với mục tiêu (TOEIC 400 đến 550). ',
            'category_id' => $categoryIds[array_rand($categoryIds)],
            'author_id' => $authorIds[array_rand($authorIds)],
            'quantity' => 15,
        ]);

        Book::create([
            'title' => 'Sapiens: Lược Sử Loài Người',
            'cover_image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1630680029i/37549506.jpg',
            'description' => 'Lịch sử loài người từ thời tiền sử.',
            'category_id' => $categoryIds[array_rand($categoryIds)],
            'author_id' => $authorIds[array_rand($authorIds)],
            'quantity' => 7,
        ]);

        Book::create([
            'title' => 'Đám trẻ ở đại dương đen',
            'cover_image' => 'https://www.netabooks.vn/Data/Sites/1/Product/53347/dam-tre-o-dai-duong-den-5.jpg',
            'description' => 'Cuốn sách "Đám trẻ ở đại dương đen" của tác giả Châu Sa Đáy Mắt là một tác phẩm đầy cảm xúc, kể về hành trình của những đứa trẻ phải đối mặt với những góc tối của tâm hồn, những nỗi đau và tổn thương mà chúng phải gánh chịu từ khi còn rất nhỏ. Thông qua những câu chuyện đầy sức mạnh, tác giả đã khéo léo dẫn dắt người đọc bước vào thế giới nội tâm phức tạp của những đứa trẻ ấy.',
            'category_id' => $categoryIds[array_rand($categoryIds)],
            'author_id' => $authorIds[array_rand($authorIds)],
            'quantity' => 6,
        ]);

        Book::create([
            'title' => 'Tôi Tài Giỏi, Bạn Cũng Thế',
            'cover_image' => 'https://salt.tikicdn.com/cache/w1200/ts/product/76/c0/1e/0ff7ee76ba4d2529b177c7891132abac.jpg',
            'description' => 'Cuốn sách "Tôi Tài Giỏi, Bạn Cũng Thế" của tác giả Adam Khoo truyền tải thông điệp rằng mỗi người đều có khả năng thành công nếu họ áp dụng đúng phương pháp học tập và phát triển bản thân.',
            'category_id' => $categoryIds[array_rand($categoryIds)],
            'author_id' => $authorIds[array_rand($authorIds)],
            'quantity' => 12,
        ]);

        Book::create([
            'title' => 'Big Step 2',
            'cover_image' => 'https://nhasachdaruma.com/wp-content/uploads/2021/08/2-1.jpg',
            'description' => 'Dành cho những người trình độ Trung cấp với mục tiêu TOEIC 500 – 750. Đây cuốn thứ hai sau cuốn Big Step 1. Kiến thức trong cuốn sách được nâng cao hơn cả từ vựng và ngữ pháp cũng như dạng câu hỏi sẽ khó và sát theo đề thi TOEIC để nâng trình độ của người học. ',
            'category_id' => $categoryIds[array_rand($categoryIds)],
            'author_id' => $authorIds[array_rand($authorIds)],
            'quantity' => 20,
        ]);

        Book::create([
            'title' => 'Cây Cam Ngọt Của Tôi',
            'cover_image' => 'https://dimibook.com/wp-content/uploads/2024/07/cay-cam-ngot-cua-toi-lay-cau-chuyen-cua-tre-con-de-giao-duc-nguoi-lon.jpg',
            'description' => 'Câu chuyện xoay quanh nhân vật chính là Zezé, một cậu bé 5 tuổi sống trong một gia đình đông con và nghèo khó ở Bangu, Rio de Janeiro. Cuộc sống của Zezé đầy khó khăn, với cha thất nghiệp và mẹ phải làm việc cật lực để nuôi sống gia đình. Cậu thường xuyên bị hiểu lầm và chịu đựng những trận đòn roi từ cha mẹ.Zezé tìm thấy một người bạn đặc biệt - cây cam ngọt mà cậu đặt tên là Minguinho (hay Pinkie). Cây cam trở thành nơi cậu chia sẻ mọi nỗi buồn và niềm vui của mình.',
            'category_id' => $categoryIds[array_rand($categoryIds)],
            'author_id' => $authorIds[array_rand($authorIds)],
            'quantity' => 9,
        ]);

        Book::create([
            'title' => 'Giáo Trình Lịch Sử Đảng Cộng Sản Việt Nam 2021',
            'cover_image' => 'https://salt.tikicdn.com/cache/w1200/ts/product/41/11/3a/6c870f4d70da003b599141f1f9be6203.jpg',
            'description' => 'Sách lịch sử Đảng Cộng sản Việt Nam 2021 là tài liệu quan trọng cho bậc đại học hệ không chuyên lý luận chính trị. ',
            'category_id' => $categoryIds[array_rand($categoryIds)],
            'author_id' => $authorIds[array_rand($authorIds)],
            'quantity' => 4,
        ]);

        Book::create([
            'title' => 'Harry Potter và Hoàng Tử Lai',
            'cover_image' => 'https://cdn0.fahasa.com/media/flashmagazine/images/page_images/hp_06_harry_potter_va_hoang_tu_lai_tb_2022/2022_08_26_14_06_03_1-390x510.jpg',
            'description' => 'Harry Potter và Hoàng Tử Lai là một phần quan trọng trong bộ truyện Harry Potter, tiếp tục cuộc hành trình của Harry Potter tại trường Hogwarts. Cuốn sách này không chỉ là một phần tiếp theo của cuộc chiến chống lại Chúa tể hắc ám Voldemort mà còn là một hành trình khám phá sâu sắc vào quá khứ của Chúa tể Hắc ám và những bí mật ẩn giấu trong thế giới phù thủy. ',
            'category_id' => $categoryIds[array_rand($categoryIds)],
            'author_id' => $authorIds[array_rand($authorIds)],
            'quantity' => 01,
        ]);
    }
}