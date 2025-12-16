<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book; // Nhớ dòng này để gọi Model Book

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'Nhà Giả Kim',
                'author' => 'Paulo Coelho',
                'description' => 'Tất cả những người hùng kiệt xuất trong kinh thánh đều bắt đầu hành trình của mình bằng việc đi xa.',
                'quantity' => 10,
                'cover_image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1348033285i/1054350.jpg',
            ],
            [
                'title' => 'Đắc Nhân Tâm',
                'author' => 'Dale Carnegie',
                'description' => 'Nghệ thuật thu phục lòng người, cuốn sách bán chạy nhất mọi thời đại.',
                'quantity' => 15,
                'cover_image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1482800532i/4994266.jpg',
            ],
            [
                'title' => 'Dế Mèn Phiêu Lưu Ký',
                'author' => 'Tô Hoài',
                'description' => 'Câu chuyện về cuộc phiêu lưu của chú Dế Mèn qua thế giới loài vật.',
                'quantity' => 20,
                'cover_image' => 'https://upload.wikimedia.org/wikipedia/vi/9/91/De_men_phieu_luu_ky_bia.jpg',
            ],
            [
                'title' => 'Mắt Biếc',
                'author' => 'Nguyễn Nhật Ánh',
                'description' => 'Một câu chuyện tình yêu buồn man mác của Ngạn và Hà Lan.',
                'quantity' => 5,
                'cover_image' => 'https://upload.wikimedia.org/wikipedia/vi/a/a2/Mat_biec.jpg',
            ],
            [
                'title' => 'Tuổi Trẻ Đáng Giá Bao Nhiêu',
                'author' => 'Rosie Nguyễn',
                'description' => 'Cuốn sách truyền cảm hứng cho người trẻ tìm kiếm đam mê.',
                'quantity' => 12,
                'cover_image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1476694632i/32616213.jpg',
            ],
            [
                'title' => 'Hoàng Tử Bé',
                'author' => 'Antoine de Saint-Exupéry',
                'description' => 'Những bài học sâu sắc về cuộc sống qua con mắt trẻ thơ.',
                'quantity' => 8,
                'cover_image' => 'https://upload.wikimedia.org/wikipedia/vi/8/87/Le_Petit_Prince_cover_tieng_Viet.jpg',
            ],
            [
                'title' => 'Rừng Na Uy',
                'author' => 'Haruki Murakami',
                'description' => 'Một tiểu thuyết đầy ám ảnh về tuổi trẻ, tình yêu và sự mất mát.',
                'quantity' => 6,
                'cover_image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1386923485i/11297.jpg',
            ],
            [
                'title' => 'Harry Potter và Hòn Đá Phù Thủy',
                'author' => 'J.K. Rowling',
                'description' => 'Khởi đầu chuyến hành trình của cậu bé phù thủy Harry Potter.',
                'quantity' => 10,
                'cover_image' => 'https://upload.wikimedia.org/wikipedia/vi/d/d0/Harry_Potter_v%C3%A0_H%C3%B2n_%C4%91%C3%A1_Ph%C3%B9_th%E1%BB%A7y.jpg',
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}