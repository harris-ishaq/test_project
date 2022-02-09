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
            'code_book' => 'S1684155584',
            'isbn' => '1684155584',
            'title' => 'Something is Killing the Children, Vol. 1',
            'author' => 'James Tynion IV',
            'publisher' => 'Indie',
            'year' => '2020',
            'qty' => '3',
            'entry_date' => '2022-02-02',
        ],[
            'code_book' => 'S1684156491',
            'isbn' => '1684156491',
            'title' => 'Something is Killing the Children, Vol. 2',
            'author' => 'James Tynion IV',
            'publisher' => 'Indie',
            'year' => '2020',
            'qty' => '2',
            'entry_date' => '2022-02-01',
        ],[
            'code_book' => 'I1250760437',
            'isbn' => '1250760437',
            'title' => 'I Will Not Die Alone',
            'author' => 'Dera White',
            'publisher' => 'Indie',
            'year' => '2021',
            'qty' => '2',
            'entry_date' => '2022-01-02',
        ]);
        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
