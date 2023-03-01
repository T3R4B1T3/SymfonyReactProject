import React from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Homepage from '../jsx/Homepage';
import RegisterForm from '../jsx/RegisterForm';
import LoginForm from "../jsx/LoginForm";
import ExerciseForm from "../jsx/ExerciseForm";

createRoot(document.getElementById('root')).render(
    <BrowserRouter>
        <Routes>
            <Route path="/" element={<Homepage />} />
            <Route path="/register" element={<RegisterForm />} />
            <Route path="/login" element={<LoginForm />} />
            <Route path="/workout" element={<ExerciseForm />} />
        </Routes>
    </BrowserRouter>
);
