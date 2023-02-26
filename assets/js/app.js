import React from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Homepage from '../jsx/Homepage';
import RegisterForm from '../jsx/RegisterForm';
import LoginForm from "../jsx/LoginForm";

createRoot(document.getElementById('root')).render(
    <BrowserRouter>
        <Routes>
            <Route path="/home" element={<Homepage />} />
            <Route path="/register" element={<RegisterForm />} />
            <Route path="/login" element={<LoginForm />} />
        </Routes>
    </BrowserRouter>
);
