import React, { useState } from 'react';
import './RegisterForm.css';

function RegistrationForm() {
    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');
    const [errorMessage, setErrorMessage] = useState('');

    const handleUsernameChange = (event) => {
        setUsername(event.target.value);
    };

    const handlePasswordChange = (event) => {
        setPassword(event.target.value);
    };

    const handleSubmit = async (event) => {
        event.preventDefault();

        try {
            const response = await fetch('/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ username, password })
            });

            if (response.ok) {
                // Użytkownik został zarejestrowany, przekieruj go na inną stronę
                window.location.href = '/login';
            } else {
                const data = await response.json();
                setErrorMessage(data.message);
            }
        } catch (error) {
            console.error(error);
            setErrorMessage('Wystąpił błąd podczas rejestracji użytkownika');
        }
    };

    return (
        <form onSubmit={handleSubmit}>
            <div>
                <label htmlFor="username">Nazwa użytkownika:</label>
                <input type="text" id="username" value={username} onChange={handleUsernameChange} />
                <br/>
                <label htmlFor="password">Hasło:</label>
                <input type="password" id="password" value={password} onChange={handlePasswordChange} />
            </div>
            {errorMessage && <div>{errorMessage}</div>}
            <button type="submit">Zarejestruj się</button>
        </form>
    );
}

export default RegistrationForm;
