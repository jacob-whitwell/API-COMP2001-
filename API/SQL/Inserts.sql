INSERT INTO cw2.Programmes
VALUES  (6893, 'BSc (Hons) Computing and Software Development', 'Enabling students to learn and progress in software development practices and methodologies.'),
(3429, 'BSc (Hons) Computer Science', 'Technology has revolutionised the way we live, build, work, shop, learn and even access medical  care. On this forward-looking degree, you’ll get hands-on skills across a range of topics including coding.'),
(6894, 'BSc (Hons) Cyber Security', 'Cyber security is an ever-increasing demand within every organisation across the world. This course explores the biggest threats to our data from hackers, malicious coders and social engineers to crackers, viruses.'),
(6895, 'BSc (Hons) Games Development Technologies', 'Create your own apps, games, virtual and mixed reality solutions to build your profile as a versatile developer.')


insert into cw2.StudentProgramme
values (1, 6893),
(2, 6893),
(3, 6894),
(4, 6894),
(5, 3429),
(6, 6895)

insert into cw2.Projects (Title, [Description], Year)
values 
('COMP2000', 'This is a module where students learn about Java mobile application development, though the students wished they learned Kotlin', 2021),
('COMP2001', 'In this module, students will learn the basics of creating an ASP.NET MVC WEB API. Yes, that is a lot of capital letters.', 2021),
('COMP2002', 'This module provides students with an introduction to the principles of artificial intelligence and the methods used in that field.', 2021),
('COMP2003', 'A Group project where nobody knows what they are doing', 2021),
('COMP2004', 'Students learn about embedded microcontrollers, working with different processor architectures via a simulator, and develop embedded software', 2021),
('COMP2005', 'This module explores the current state of the art in testing tools, including static and dynamic analysis tools.', 2021),
('COMP2006', 'The ability to design secure systems is critical to the successful operation of any system. This module will develop the knowledge and understanding of security architectures and design principles', 2021),
('COMP2007', 'This module provides a series of workshops in interactive systems for game developers with a core lecture series resulting in a substantial individual student project.', 2021)


insert into cw2.StudentProjects
values (1, 2),
(1, 5),
(1, 4),
(2, 3),
(3, 1),
(4, 1),
(4, 2),
(5, 4),
(5, 5),
(6, 6)



insert into cw2.programmeprojects
values (3429, 1),
(3429, 2),
(3429, 4),
(3429, 6),
(6893, 5),
(6893, 6),
(6893, 7),
(6893, 9),
(6893, 8),
(6894, 5),
(6894, 6),
(6894, 7),
(6894, 9),
(6894, 10),
(6895, 5),
(6895, 6),
(6895, 7),
(6895, 9),
(6895, 12)