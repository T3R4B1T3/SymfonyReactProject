import React, { useState } from 'react';
import axios from 'axios';

const ExerciseForm = () => {
    const [muscleGroup, setMuscleGroup] = useState('');
    const [exerciseName, setExerciseName] = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault();
        const exerciseData = { muscleGroup, exerciseName };
        try {
            await axios.post('/add-exercise', exerciseData);
            alert('Exercise added successfully!');
        } catch (error) {
            console.error(error);
            alert('Error adding exercise');
        }
    };

    return (
        <form onSubmit={handleSubmit}>
            <label>
                Muscle Group:
                <input type="text" value={muscleGroup} onChange={(e) => setMuscleGroup(e.target.value)} />
            </label>
            <label>
                Exercise Name:
                <input type="text" value={exerciseName} onChange={(e) => setExerciseName(e.target.value)} />
            </label>
            <button type="submit">Add Exercise</button>
        </form>
    );
};

export default ExerciseForm;
