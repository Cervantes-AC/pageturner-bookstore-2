<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing data
        User::query()->delete();
        Category::query()->delete();
        Book::query()->delete();

        /*
        |--------------------------------------------------------------------------
        | Admin User
        |--------------------------------------------------------------------------
        */
        User::create([
            'name' => 'Admin User',
            'email' => 'aaronclydeccervantes@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Sample Customer
        |--------------------------------------------------------------------------
        */
        User::create([
            'name' => 'AC Cervantes',
            'email' => 'customer@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role' => 'customer'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */
        $categories = [
            ['name' => 'Fiction', 'description' => 'Fictional stories and novels'],
            ['name' => 'Non-Fiction', 'description' => 'Real-world topics and biographies'],
            ['name' => 'Science Fiction', 'description' => 'Futuristic and speculative fiction'],
            ['name' => 'Fantasy', 'description' => 'Magical and mythical adventures'],
            ['name' => 'Mystery', 'description' => 'Detective and thriller stories'],
            ['name' => 'Romance', 'description' => 'Love stories and relationships'],
            ['name' => 'Business', 'description' => 'Business and entrepreneurship'],
            ['name' => 'Self-Help', 'description' => 'Personal development and motivation'],
            ['name' => 'Technology', 'description' => 'Tech and programming books'],
            ['name' => 'History', 'description' => 'Historical events and biographies'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        /*
        |--------------------------------------------------------------------------
        | 100 Books with Realistic Data
        |--------------------------------------------------------------------------
        */
        $books = [
            // Fiction (10 books)
            ['category_id' => 1, 'title' => 'To Kill a Mockingbird', 'author' => 'Harper Lee', 'price' => 299, 'stock' => 45, 'year' => 1960],
            ['category_id' => 1, 'title' => '1984', 'author' => 'George Orwell', 'price' => 349, 'stock' => 38, 'year' => 1949],
            ['category_id' => 1, 'title' => 'Pride and Prejudice', 'author' => 'Jane Austen', 'price' => 279, 'stock' => 52, 'year' => 1813],
            ['category_id' => 1, 'title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald', 'price' => 289, 'stock' => 41, 'year' => 1925],
            ['category_id' => 1, 'title' => 'The Catcher in the Rye', 'author' => 'J.D. Salinger', 'price' => 319, 'stock' => 33, 'year' => 1951],
            ['category_id' => 1, 'title' => 'Brave New World', 'author' => 'Aldous Huxley', 'price' => 329, 'stock' => 29, 'year' => 1932],
            ['category_id' => 1, 'title' => 'The Lord of the Flies', 'author' => 'William Golding', 'price' => 299, 'stock' => 36, 'year' => 1954],
            ['category_id' => 1, 'title' => 'Animal Farm', 'author' => 'George Orwell', 'price' => 259, 'stock' => 48, 'year' => 1945],
            ['category_id' => 1, 'title' => 'The Grapes of Wrath', 'author' => 'John Steinbeck', 'price' => 359, 'stock' => 27, 'year' => 1939],
            ['category_id' => 1, 'title' => 'Wuthering Heights', 'author' => 'Emily Brontë', 'price' => 309, 'stock' => 31, 'year' => 1847],

            // Non-Fiction (10 books)
            ['category_id' => 2, 'title' => 'Sapiens', 'author' => 'Yuval Noah Harari', 'price' => 599, 'stock' => 55, 'year' => 2011],
            ['category_id' => 2, 'title' => 'Educated', 'author' => 'Tara Westover', 'price' => 549, 'stock' => 42, 'year' => 2018],
            ['category_id' => 2, 'title' => 'Becoming', 'author' => 'Michelle Obama', 'price' => 649, 'stock' => 38, 'year' => 2018],
            ['category_id' => 2, 'title' => 'The Immortal Life of Henrietta Lacks', 'author' => 'Rebecca Skloot', 'price' => 499, 'stock' => 33, 'year' => 2010],
            ['category_id' => 2, 'title' => 'Thinking, Fast and Slow', 'author' => 'Daniel Kahneman', 'price' => 579, 'stock' => 29, 'year' => 2011],
            ['category_id' => 2, 'title' => 'The Wright Brothers', 'author' => 'David McCullough', 'price' => 529, 'stock' => 25, 'year' => 2015],
            ['category_id' => 2, 'title' => 'Born a Crime', 'author' => 'Trevor Noah', 'price' => 489, 'stock' => 44, 'year' => 2016],
            ['category_id' => 2, 'title' => 'The Glass Castle', 'author' => 'Jeannette Walls', 'price' => 459, 'stock' => 37, 'year' => 2005],
            ['category_id' => 2, 'title' => 'Into the Wild', 'author' => 'Jon Krakauer', 'price' => 469, 'stock' => 31, 'year' => 1996],
            ['category_id' => 2, 'title' => 'Unbroken', 'author' => 'Laura Hillenbrand', 'price' => 539, 'stock' => 28, 'year' => 2010],

            // Science Fiction (10 books)
            ['category_id' => 3, 'title' => 'Dune', 'author' => 'Frank Herbert', 'price' => 449, 'stock' => 50, 'year' => 1965],
            ['category_id' => 3, 'title' => 'Foundation', 'author' => 'Isaac Asimov', 'price' => 399, 'stock' => 43, 'year' => 1951],
            ['category_id' => 3, 'title' => 'Ender\'s Game', 'author' => 'Orson Scott Card', 'price' => 429, 'stock' => 39, 'year' => 1985],
            ['category_id' => 3, 'title' => 'The Hitchhiker\'s Guide to the Galaxy', 'author' => 'Douglas Adams', 'price' => 379, 'stock' => 47, 'year' => 1979],
            ['category_id' => 3, 'title' => 'Neuromancer', 'author' => 'William Gibson', 'price' => 419, 'stock' => 34, 'year' => 1984],
            ['category_id' => 3, 'title' => 'Snow Crash', 'author' => 'Neal Stephenson', 'price' => 439, 'stock' => 30, 'year' => 1992],
            ['category_id' => 3, 'title' => 'The Left Hand of Darkness', 'author' => 'Ursula K. Le Guin', 'price' => 389, 'stock' => 26, 'year' => 1969],
            ['category_id' => 3, 'title' => 'Hyperion', 'author' => 'Dan Simmons', 'price' => 459, 'stock' => 32, 'year' => 1989],
            ['category_id' => 3, 'title' => 'The Martian', 'author' => 'Andy Weir', 'price' => 469, 'stock' => 51, 'year' => 2011],
            ['category_id' => 3, 'title' => 'Ready Player One', 'author' => 'Ernest Cline', 'price' => 449, 'stock' => 45, 'year' => 2011],

            // Fantasy (10 books)
            ['category_id' => 4, 'title' => 'The Hobbit', 'author' => 'J.R.R. Tolkien', 'price' => 399, 'stock' => 60, 'year' => 1937],
            ['category_id' => 4, 'title' => 'Harry Potter and the Sorcerer\'s Stone', 'author' => 'J.K. Rowling', 'price' => 429, 'stock' => 75, 'year' => 1997],
            ['category_id' => 4, 'title' => 'The Name of the Wind', 'author' => 'Patrick Rothfuss', 'price' => 479, 'stock' => 42, 'year' => 2007],
            ['category_id' => 4, 'title' => 'A Game of Thrones', 'author' => 'George R.R. Martin', 'price' => 499, 'stock' => 53, 'year' => 1996],
            ['category_id' => 4, 'title' => 'The Way of Kings', 'author' => 'Brandon Sanderson', 'price' => 549, 'stock' => 38, 'year' => 2010],
            ['category_id' => 4, 'title' => 'The Chronicles of Narnia', 'author' => 'C.S. Lewis', 'price' => 459, 'stock' => 47, 'year' => 1950],
            ['category_id' => 4, 'title' => 'Mistborn', 'author' => 'Brandon Sanderson', 'price' => 489, 'stock' => 41, 'year' => 2006],
            ['category_id' => 4, 'title' => 'The Lies of Locke Lamora', 'author' => 'Scott Lynch', 'price' => 469, 'stock' => 35, 'year' => 2006],
            ['category_id' => 4, 'title' => 'American Gods', 'author' => 'Neil Gaiman', 'price' => 509, 'stock' => 39, 'year' => 2001],
            ['category_id' => 4, 'title' => 'The Wheel of Time', 'author' => 'Robert Jordan', 'price' => 529, 'stock' => 33, 'year' => 1990],

            // Mystery (10 books)
            ['category_id' => 5, 'title' => 'The Girl with the Dragon Tattoo', 'author' => 'Stieg Larsson', 'price' => 449, 'stock' => 48, 'year' => 2005],
            ['category_id' => 5, 'title' => 'Gone Girl', 'author' => 'Gillian Flynn', 'price' => 429, 'stock' => 52, 'year' => 2012],
            ['category_id' => 5, 'title' => 'The Da Vinci Code', 'author' => 'Dan Brown', 'price' => 439, 'stock' => 44, 'year' => 2003],
            ['category_id' => 5, 'title' => 'Big Little Lies', 'author' => 'Liane Moriarty', 'price' => 409, 'stock' => 37, 'year' => 2014],
            ['category_id' => 5, 'title' => 'The Silent Patient', 'author' => 'Alex Michaelides', 'price' => 459, 'stock' => 41, 'year' => 2019],
            ['category_id' => 5, 'title' => 'And Then There Were None', 'author' => 'Agatha Christie', 'price' => 349, 'stock' => 55, 'year' => 1939],
            ['category_id' => 5, 'title' => 'The Woman in the Window', 'author' => 'A.J. Finn', 'price' => 419, 'stock' => 33, 'year' => 2018],
            ['category_id' => 5, 'title' => 'Sharp Objects', 'author' => 'Gillian Flynn', 'price' => 399, 'stock' => 29, 'year' => 2006],
            ['category_id' => 5, 'title' => 'The Cuckoo\'s Calling', 'author' => 'Robert Galbraith', 'price' => 429, 'stock' => 36, 'year' => 2013],
            ['category_id' => 5, 'title' => 'In the Woods', 'author' => 'Tana French', 'price' => 439, 'stock' => 31, 'year' => 2007],

            // Romance (10 books)
            ['category_id' => 6, 'title' => 'The Notebook', 'author' => 'Nicholas Sparks', 'price' => 359, 'stock' => 58, 'year' => 1996],
            ['category_id' => 6, 'title' => 'Me Before You', 'author' => 'Jojo Moyes', 'price' => 389, 'stock' => 49, 'year' => 2012],
            ['category_id' => 6, 'title' => 'The Fault in Our Stars', 'author' => 'John Green', 'price' => 369, 'stock' => 62, 'year' => 2012],
            ['category_id' => 6, 'title' => 'Outlander', 'author' => 'Diana Gabaldon', 'price' => 449, 'stock' => 43, 'year' => 1991],
            ['category_id' => 6, 'title' => 'The Time Traveler\'s Wife', 'author' => 'Audrey Niffenegger', 'price' => 399, 'stock' => 38, 'year' => 2003],
            ['category_id' => 6, 'title' => 'Eleanor & Park', 'author' => 'Rainbow Rowell', 'price' => 349, 'stock' => 45, 'year' => 2013],
            ['category_id' => 6, 'title' => 'The Rosie Project', 'author' => 'Graeme Simsion', 'price' => 379, 'stock' => 34, 'year' => 2013],
            ['category_id' => 6, 'title' => 'Red, White & Royal Blue', 'author' => 'Casey McQuiston', 'price' => 419, 'stock' => 51, 'year' => 2019],
            ['category_id' => 6, 'title' => 'Beach Read', 'author' => 'Emily Henry', 'price' => 399, 'stock' => 47, 'year' => 2020],
            ['category_id' => 6, 'title' => 'People We Meet on Vacation', 'author' => 'Emily Henry', 'price' => 409, 'stock' => 42, 'year' => 2021],

            // Business (10 books)
            ['category_id' => 7, 'title' => 'Think and Grow Rich', 'author' => 'Napoleon Hill', 'price' => 449, 'stock' => 65, 'year' => 1937],
            ['category_id' => 7, 'title' => 'The Lean Startup', 'author' => 'Eric Ries', 'price' => 529, 'stock' => 48, 'year' => 2011],
            ['category_id' => 7, 'title' => 'Good to Great', 'author' => 'Jim Collins', 'price' => 559, 'stock' => 42, 'year' => 2001],
            ['category_id' => 7, 'title' => 'Zero to One', 'author' => 'Peter Thiel', 'price' => 499, 'stock' => 51, 'year' => 2014],
            ['category_id' => 7, 'title' => 'The 4-Hour Workweek', 'author' => 'Tim Ferriss', 'price' => 479, 'stock' => 44, 'year' => 2007],
            ['category_id' => 7, 'title' => 'Rich Dad Poor Dad', 'author' => 'Robert Kiyosaki', 'price' => 429, 'stock' => 72, 'year' => 1997],
            ['category_id' => 7, 'title' => 'The E-Myth Revisited', 'author' => 'Michael E. Gerber', 'price' => 469, 'stock' => 37, 'year' => 1995],
            ['category_id' => 7, 'title' => 'Start with Why', 'author' => 'Simon Sinek', 'price' => 509, 'stock' => 53, 'year' => 2009],
            ['category_id' => 7, 'title' => 'The Hard Thing About Hard Things', 'author' => 'Ben Horowitz', 'price' => 549, 'stock' => 39, 'year' => 2014],
            ['category_id' => 7, 'title' => 'Shoe Dog', 'author' => 'Phil Knight', 'price' => 519, 'stock' => 46, 'year' => 2016],

            // Self-Help (10 books)
            ['category_id' => 8, 'title' => 'Atomic Habits', 'author' => 'James Clear', 'price' => 549, 'stock' => 88, 'year' => 2018],
            ['category_id' => 8, 'title' => 'The 7 Habits of Highly Effective People', 'author' => 'Stephen Covey', 'price' => 499, 'stock' => 67, 'year' => 1989],
            ['category_id' => 8, 'title' => 'How to Win Friends and Influence People', 'author' => 'Dale Carnegie', 'price' => 429, 'stock' => 73, 'year' => 1936],
            ['category_id' => 8, 'title' => 'The Power of Now', 'author' => 'Eckhart Tolle', 'price' => 469, 'stock' => 54, 'year' => 1997],
            ['category_id' => 8, 'title' => 'You Are a Badass', 'author' => 'Jen Sincero', 'price' => 439, 'stock' => 61, 'year' => 2013],
            ['category_id' => 8, 'title' => 'The Subtle Art of Not Giving a F*ck', 'author' => 'Mark Manson', 'price' => 459, 'stock' => 79, 'year' => 2016],
            ['category_id' => 8, 'title' => 'Mindset', 'author' => 'Carol S. Dweck', 'price' => 489, 'stock' => 52, 'year' => 2006],
            ['category_id' => 8, 'title' => 'Daring Greatly', 'author' => 'Brené Brown', 'price' => 479, 'stock' => 48, 'year' => 2012],
            ['category_id' => 8, 'title' => 'The Alchemist', 'author' => 'Paulo Coelho', 'price' => 399, 'stock' => 85, 'year' => 1988],
            ['category_id' => 8, 'title' => 'Man\'s Search for Meaning', 'author' => 'Viktor E. Frankl', 'price' => 419, 'stock' => 58, 'year' => 1946],

            // Technology (10 books)
            ['category_id' => 9, 'title' => 'Clean Code', 'author' => 'Robert C. Martin', 'price' => 649, 'stock' => 45, 'year' => 2008],
            ['category_id' => 9, 'title' => 'The Pragmatic Programmer', 'author' => 'Andrew Hunt', 'price' => 679, 'stock' => 38, 'year' => 1999],
            ['category_id' => 9, 'title' => 'Design Patterns', 'author' => 'Gang of Four', 'price' => 699, 'stock' => 32, 'year' => 1994],
            ['category_id' => 9, 'title' => 'You Don\'t Know JS', 'author' => 'Kyle Simpson', 'price' => 529, 'stock' => 51, 'year' => 2014],
            ['category_id' => 9, 'title' => 'Eloquent JavaScript', 'author' => 'Marijn Haverbeke', 'price' => 549, 'stock' => 43, 'year' => 2011],
            ['category_id' => 9, 'title' => 'The Phoenix Project', 'author' => 'Gene Kim', 'price' => 589, 'stock' => 47, 'year' => 2013],
            ['category_id' => 9, 'title' => 'Cracking the Coding Interview', 'author' => 'Gayle Laakmann McDowell', 'price' => 729, 'stock' => 56, 'year' => 2015],
            ['category_id' => 9, 'title' => 'Introduction to Algorithms', 'author' => 'Thomas H. Cormen', 'price' => 899, 'stock' => 28, 'year' => 1990],
            ['category_id' => 9, 'title' => 'Code Complete', 'author' => 'Steve McConnell', 'price' => 749, 'stock' => 34, 'year' => 1993],
            ['category_id' => 9, 'title' => 'The Mythical Man-Month', 'author' => 'Frederick P. Brooks Jr.', 'price' => 569, 'stock' => 29, 'year' => 1975],

            // History (10 books)
            ['category_id' => 10, 'title' => 'A People\'s History of the United States', 'author' => 'Howard Zinn', 'price' => 579, 'stock' => 41, 'year' => 1980],
            ['category_id' => 10, 'title' => 'Guns, Germs, and Steel', 'author' => 'Jared Diamond', 'price' => 599, 'stock' => 38, 'year' => 1997],
            ['category_id' => 10, 'title' => 'The Diary of a Young Girl', 'author' => 'Anne Frank', 'price' => 349, 'stock' => 67, 'year' => 1947],
            ['category_id' => 10, 'title' => 'Team of Rivals', 'author' => 'Doris Kearns Goodwin', 'price' => 629, 'stock' => 33, 'year' => 2005],
            ['category_id' => 10, 'title' => 'The Silk Roads', 'author' => 'Peter Frankopan', 'price' => 649, 'stock' => 36, 'year' => 2015],
            ['category_id' => 10, 'title' => '1776', 'author' => 'David McCullough', 'price' => 559, 'stock' => 42, 'year' => 2005],
            ['category_id' => 10, 'title' => 'The Rise and Fall of the Third Reich', 'author' => 'William L. Shirer', 'price' => 799, 'stock' => 24, 'year' => 1960],
            ['category_id' => 10, 'title' => 'SPQR', 'author' => 'Mary Beard', 'price' => 619, 'stock' => 31, 'year' => 2015],
            ['category_id' => 10, 'title' => 'The Warmth of Other Suns', 'author' => 'Isabel Wilkerson', 'price' => 589, 'stock' => 28, 'year' => 2010],
            ['category_id' => 10, 'title' => 'The Guns of August', 'author' => 'Barbara W. Tuchman', 'price' => 569, 'stock' => 35, 'year' => 1962],
        ];

        foreach ($books as $book) {
            Book::create([
                'category_id' => $book['category_id'],
                'title' => $book['title'],
                'author' => $book['author'],
                'isbn' => $this->generateISBN(),
                'price' => $book['price'],
                'stock_quantity' => $book['stock'],
                'publication_year' => $book['year'],
                'description' => 'A compelling read that has captivated readers worldwide. ' . $book['title'] . ' by ' . $book['author'] . ' is a must-have for any book collection.',
            ]);
        }

        $this->command->info('✓ Seeded 100 books across 10 categories');
        $this->command->info('✓ Admin: admin@pageturner.com / password');
        $this->command->info('✓ Customer: customer@pageturner.com / password');
    }

    private function generateISBN()
    {
        return '978-' . rand(0, 9) . '-' . 
               str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT) . '-' . 
               str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT) . '-' . 
               rand(0, 9);
    }
}
