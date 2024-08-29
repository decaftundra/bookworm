import React, {useId, useState} from 'react';
import {Head, router, usePage} from '@inertiajs/react';

interface Book {
    isbn13: string;
    title: string;
    author: string;
    price: number;
    rating: number;
}


const Bestsellers: React.FC = () => {

    const {props} = usePage();
    const initialBooks = props.books as Book[];

    const [searchQuery, setSearchQuery] = useState('');
    const [books, setBooks] = useState<Book[]>(initialBooks);

    const handleSearch = () => {
        router.get('/nyt/search', {q: searchQuery});

    };

    const handleAddFavourite = (book: Book) => {
        console.log('Liked book:', book);
        router.post('/nyt/like', {
            title: book.title,
            author: book.author,
            price: book.price,
        }, {
            preserveScroll: true,
            preserveState: true,
        });
    }


    return (

        <div>
            <Head title="NYT Bestsellers"/>
            <h1>Search Books</h1>
            <input
                type="text"
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                placeholder="Search by title"
            />
            <button onClick={handleSearch} className="flex justify-between items-center">Search</button>
            <ul>
                {books.map((book) => {
                    const bookId = useId();
                    return (
                        <li key={bookId}>
                            {book.title} by {book.author}
                            <button onClick={() => handleAddFavourite(book)}
                                    className="bg-blue-400 text-white p-2 rounded">Like
                            </button>
                        </li>
                    );
                })}
            </ul>
        </div>
    );
}

export default Bestsellers;
