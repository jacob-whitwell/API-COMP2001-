CREATE VIEW CW2.StudentRegistrations 
AS
SELECT CW2.Students.StudentID, FName, LName, ProgrammeCode, Title, [Description]
FROM CW2.Students, CW2.Programmes
WHERE EXISTS (SELECT StudentID FROM CW2.StudentProgramme WHERE CW2.StudentProgramme.StudentID = CW2.Students.StudentID AND CW2.StudentProgramme.ProgrammeCode = CW2.Programmes.ProgrammeCode)
