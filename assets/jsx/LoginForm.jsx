import React, { useState } from 'react';

const LoginForm = () => {
    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');

    const handleSubmit = async (event) => {
        event.preventDefault();

        const response = await fetch('/login_check', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ username, password }),
        });

        if (response.ok) {
            // Przekieruj użytkownika na stronę po zalogowaniu
            window.location.href = '/home';
        } else {
            alert('Nie udało się zalogować');
        }
    };

    return (
        <form onSubmit={handleSubmit}>
            <div>
                <label>
                    Nazwa użytkownika:
                    <input type="text" value={username} onChange={(event) => setUsername(event.target.value)} />
                </label>
            </div>
            <div>
                <label>
                    Hasło:
                    <input type="password" value={password} onChange={(event) => setPassword(event.target.value)} />
                </label>
            </div>
            <button type="submit">Zaloguj</button>
        </form>
    );
};

export default LoginForm;
