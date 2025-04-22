# 📝 ExaMPS: Online Examination System with MPS Recording

**ExaMPS** is an online examination system developed for **Famy National Integrated High School** to streamline test-taking, enhance accuracy in scoring, and support Mean Percentage Score (MPS) tracking. It includes features for both teachers and students, with a focus on fairness, transparency, and performance insights.

---

## ⚙️ Features

- 👩‍🏫 Teacher account management
- 🧑‍🎓 Student exam entry via unique Exam ID
- 📋 Exam creation with customizable questions and choices
- 🎯 Auto-grading with MPS (Mean Percentage Score) computation
- 📊 Result tracking by class, item analysis, and overall performance
- ⏰ Exam duration timer with tab-switching restrictions
- 🚫 Refresh protection with warning and re-authentication

---

## 🖥️ Tech Stack

- **PHP** – Backend logic  
- **MySQL** – Database (phpMyAdmin for management)  
- **HTML5 & CSS3** – Structure and styling  
- **JavaScript** – Interactivity, exam restrictions, and UI handling  

---

## 📚 Database Structure

Includes the following tables:

- `users` – Teacher and student accounts
- `exams` – Exam info (ID, name, duration, user)
- `questions` – Questions with exam linkage
- `choices` – Multiple choices with correct answer flag
- `exam_submissions` – Tracks scores, responses, and submission times
- `user_answers` – Records each student's selected answers
- `classes` – *(If implemented)* Class grouping for student submissions

---

## 🚀 How to Run Locally

1. Clone this repository:
   ```bash
   git clone https://github.com/your-username/examps.git
   cd examps
