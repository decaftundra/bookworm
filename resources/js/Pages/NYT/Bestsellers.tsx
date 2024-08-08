import React, { useState, useEffect } from 'react';
import { Link, usePage, router } from '@inertiajs/react';

interface Book {
    isbn13: string;
    title: string;
    author: string;
    price: number;
    rating: number;
}



const Bestsellers: React.FC= () => {

    const { props } = usePage();
    const initialBooks = props.books as Book[];

    const [searchQuery, setSearchQuery] = useState('');
    const [books, setBooks] = useState<Book[]>(initialBooks);

    const handleSearch = () => {
        router.get('/nyt/search', { q: searchQuery });

    };

    const handleLike = (book: Book) => {
        console.log('Liked book:', book);
    }


    return (
        <div>
            <h1>Search Books</h1>
            <input
                type="text"
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                placeholder="Search by title"
            />
            <button onClick={handleSearch} className="flex justify-between items-center">Search</button>
            <ul>
                {books.map((book) => (
                    <li key={book.isbn13}>
                        {book.title} by {book.author}
                        <button onClick={() => handleLike(book)} className="bg-green-500 text-white p-2 rounded">Like</button>
                    </li>
                ))}
            </ul>
        </div>
    );
}

export default Bestsellers;
