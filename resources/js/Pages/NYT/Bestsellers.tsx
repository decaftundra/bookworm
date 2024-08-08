import React, { useState } from 'react';
import { Link, usePage, router } from '@inertiajs/react';

interface Book {
    isbn13: string;
    title: string;
    author: string;
    price: number;
    rating: number;
}

interface Props {
    books: Book[];
    query: string;
}

const TestNYT: React.FC<Props> = ({ books, query }) => {

    const [searchQuery, setSearchQuery] = useState(query);

    const handleSearch = () => {
        router.get('/nyt/bestsellers', { q: searchQuery });
    };

    return (
        <div>
            <h1>Search Books</h1>
            <input
                type="text"
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                placeholder="Search by title"
            />
            <button onClick={handleSearch}>Search</button>
            <ul>
                {books.map((book) => (
                    <li key={book.isbn13}>
                        {book.title} by {book.author}
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default TestNYT;
