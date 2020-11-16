# Online Exam

## Abstract

This is a simple web application for taking exam in online. In the app, there are two type of users, **Admin** and **Students**, where admins' can Create/Read/Update/Delete **Subjects/Qestions/Exam Papers** but students are not allowed for all of these except viewing only the set of an exam paper he has been assigned by an admin and viewing subjects. Admin can assign multiple students with a set for each exam paper. Students can see the set no and submit answers. Answers will be sent to the admin(who has assigned the paper) email.

## Technology Used

- Laravel (for backend)
- jQuery (for frontend)
- Bootstrap 4
- REST API (for showing questions only)


## Description

### Login/Register

Simple registration for admin/students where these two role has seperate permissions built in the system. 

### Subjects

All the subjects created by admin, will be shown to the 'subjects' route. It's just a simple CRUD operation where one can direct enter to **Exam Papers/Question** (Question is not allowed for students) related to each subject.

### Questions

This operation is for Admins only. It's also a simple CRUD operation but here questions is shown using REST API selecting individual subjects as there will be no questions to be shown initially. At the first column, there has a checkbox for each row. After checking seleted question click on **Create Exam Paper** button and it will create an exam paper with 4 sets where there will **shuffling questions as well as shuffling multiple choices** for each sets.

### Exam Papers

Initally there will be exam papers until the subject has been chosen from the select options. This portion will be shown for both admin and students

#### Admin
- Admin can see all the 4 sets and can enter to any set clicking the **Set No** button. And assign multiple students for the set. But one student can be assigned once with one exam paper.

#### Student
- Student can see only the set he has been assigned. He can enter to the set and choose answers for each questions. After that he can submit answers and the submiited documnet  will be sent to the valid email of the admin who has assigned the set. After that if he/she visits the same set, he will see this score on that set.


## Security

Students can never enter to the Admin's permitted links/routes as well as Admin can't submit answer for sets.

