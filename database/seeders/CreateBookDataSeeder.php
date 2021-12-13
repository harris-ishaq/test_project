<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class CreateBookDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = array([
            'code_book' => '1684155584',
            'title' => 'Something is Killing the Children, Vol. 1',
            'author' => 'James Tynion IV',
            'publisher' => 'Indie',
            'qty' => '3',
        ],[
            'code_book' => '1684156491',
            'title' => 'Something is Killing the Children, Vol. 2',
            'author' => 'James Tynion IV',
            'publisher' => 'Indie',
            'qty' => '2',
        ],[
            'code_book' => '1250760437',
            'title' => 'I Will Not Die Alone',
            'author' => 'Dera White',
            'publisher' => 'Indie',
            'qty' => '2',
        ]);
        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
