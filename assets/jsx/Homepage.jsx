import React from 'react';
import { Link } from 'react-router-dom';

const HomePage = () => {
    return (
        <div>
            <h1>Witaj na stronie głównej</h1>
            <ul>
                <li><Link to="/register">Zarejestruj się</Link></li>
                    <li><Link to="/login">Zaloguj się</Link></li>
                    <li><Link to="/workout">Treningi</Link></li>
            </ul>
            </div>
    );
};

export default HomePage;
